<?php
include_once('config.php');


if (isset($_POST['submit'])) { 
  // update database

 
  $bid       = $_POST['bid'];
  $foodname  = $_POST['foodname'];
  $area      = $_POST['area'];
  $date      = $_POST['date'];
  $address   = $_POST['address'];
  $price     = $_POST['price'];
  $time      = $_POST['time'];
  $phone     = $_POST['phone'];
  $intro     = $_POST['intro'];

  try {

    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
    $sql = "UPDATE `twfood` SET 
    `foodname` = '$foodname',
    `area`     = '$area',
    `date`     = '$date',
    `address`  = '$address',
    `price`    = '$price',
    `time`     = '$time',
    `phone`    = '$phone',
    `intro`   = '$intro'
    WHERE `twfood`.`bid` = '$bid';";

    $sth = $conn->prepare($sql);
    $sth->execute();

    $msg = "資料更新完成!";

    if(isset($_FILES['cover'])) {
    
        $errors= array();
        $file_name = $_FILES['cover']['name'];
        $file_size = $_FILES['cover']['size'];
        $file_tmp  = $_FILES['cover']['tmp_name'];
        $file_type = $_FILES['cover']['type'];
    
        $extname  = explode('.',$_FILES['cover']['name']);
        $file_ext = strtolower(end($extname));
        
        // 可接受的檔案格式
        $extensions = array("jpeg","jpg","png");
        
        $msg .= " ok here";
    
        if (in_array($file_ext, $extensions)=== false) {
           $msg = "extension not allowed, please choose a JPEG or PNG file.";
        }
        
        if ($file_size > 2097152) {
           $msg = 'File size must be excately 2 MB';
        }
        
        if(empty($errors)==true){
    
           move_uploaded_file($file_tmp, "images/cover/p".$bid.".".$file_ext);
           $msg .= " and cover upload Success";
           
        }else{
           $msg .= " but Error upload image";
        }
      }

  } catch(PDOException $e) {
    
    echo "無法連線 Connection failed: " . $e->getMessage();
  
  }

}

// 判斷是否有指定bid
if (isset($_GET['bid']) && $_GET['bid']!='') {

    $bid = $_GET['bid'];
    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
      
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
      $sql = "SELECT * FROM `twfood` WHERE `twfood`.`bid`=".$bid;
      $sth = $conn->prepare($sql);
      $sth->execute();
      $ds = $sth->fetchAll(PDO::FETCH_ASSOC);
      $d = $ds[0];

     
    
    } catch(PDOException $e) {
    
      echo "無法連線 Connection failed: " . $e->getMessage();
    
    }
    
    $conn = null;

} else {

  header("Location: food_list.php");

}
?>
<?php include('header.html'); ?>
<style>
    header {

        background-color: rgb(243, 174, 197);

    }
    footer {
        color:white;
    }
    footer nav {
        margin-top: 50px;
    }
    #main {
        margin-bottom: 100px;
    }
   
body {
	background: #8E354A;
	
}
</style>
<div class="container py-5 " style="background-color: rgb(238, 164, 174);">
<h6 class="display-4 text-center">美食餐廳資料修改<i class="bi bi-vector-pen"></i></h6>

        <?php
           if (isset($msg)) {
               echo '<p class="alert alert-success">'.$msg."</p>";
           }
        ?>

        <form action="" method="post">
            <div class="mb-3">
            <b><label for="foodname" class="form-label"style="font-size:20px">美食餐廳名稱</label></b>
                <input type="text" class="form-control" id="foodname" name="foodname" value="<?php echo $d['foodname'];?>" required>
                <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
         

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="area" id="inlineRadio1" value="1"
                <?php if ($d['area']=='1') echo 'checked';?>>
                <b><label class="form-check-label" for="inlineRadio1">北部</label></b>
            </div>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="area" id="inlineRadio2" value="2"
                <?php if ($d['area']=='2') echo 'checked';?>>
                <b><label class="form-check-label" for="inlineRadio2">中部</label></b>
            </div>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="area" id="inlineRadio3" value="3"
                <?php if ($d['area']=='3') echo 'checked';?>>
                <b><label class="form-check-label" for="inlineRadio3">南部</label></b>
            </div>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="area" id="inlineRadio4" value="4"
                <?php if ($d['area']=='4') echo 'checked';?>>
                <b><label class="form-check-label" for="inlineRadio4">東部</label></b>
            </div>
            </div>


            <div class="mb-3">
               <b> <label for="pubdate" class="form-label"style="font-size:20px">拍攝日期</label></b>
                <input type="date" class="form-control" id="date" name="date" value="<?php echo $d['date']; ?>" required>
            </div>

            <div class="input-group mb-3">
                <label class="input-group-text" for="cover">上傳封面</label>
                <input type="file" class="form-control" id="cover" name="cover" name="cover" accept="image/*" onchange="preview_image(event)">
            </div>

            <div>
                
                <?php
                    $bookcover = 'images/cover/p'.$d['bid'].'.jpg';
                    if (file_exists($bookcover)) {
                        echo '<img id="output_image" src="'.$bookcover.'" alt="" />';
                    } else {
                        echo '<img id="output_image"  />';
                    }
                ?>
            </div>
            

            <div class="mb-3">
               <b> <label for="address" class="form-label"style="font-size:20px">店家地址</label></b>
                <input type="text" class="form-control" id="address" name="address" value="<?php echo $d['address'];?>" required>

            </div>
        
        <div class="row">
            <div class="col">
            <div class="mb-3">
               <b> <label for="time" class="form-label"style="font-size:20px">營業時間</label></b>
                <input type="text" class="form-control" id="time" name="time" value="<?php echo $d['time'];?>" required>
                
            </div>
            </div>
            <div class="col">
            <div class="mb-3">
               <b> <label for="time" class="form-label"style="font-size:20px">電話</label></b>
                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $d['phone'];?>" >
            </div>
            </div>
        </div>
        

        <div class="mb-3"> 
               <b> <label for="price" class="form-label"style="font-size:20px">價格</label> </b>
               
               <textarea class="form-control" name="price" id="price" cols="80" rows="10"><?php echo $d['price'];?></textarea>
        </div>
          
        
          

        <div class="mb-3">
               <b> <label for="intro" class="form-label"style="font-size:20px">簡介</label></b>
                <textarea class="form-control ckeditor" name="intro" id="intro" cols="80" rows="10"><?php echo $d['intro'];?></textarea>
            </div>

            
            <input type="hidden" name="bid" value="<?php echo $d['bid']; ?>">
            <button type="submit" class="btn btn-primary" name="submit">送出</button>
        </form>
    </div>

  </div>
  <?php include('footer.html'); ?>
  
  
</body>
</html>