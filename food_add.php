<?php
include_once('config.php');


if(isset($_POST["submit"])){
    $foodname = $_POST['foodname'];
    $area = $_POST['area'];
    $date = $_POST['date'];
    $address = $_POST['address'];
    $price = $_POST['price'];
    $time = $_POST['time'];
    $phone = $_POST['phone'];
    $intro = $_POST['intro'];
    

   
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
        $sql = "INSERT INTO `twfood` (`bid`, `foodname`, `area`, `date`, `address`,  `price`, `time`, `phone`, `intro`) VALUES (NULL, '$foodname', '$area', '$date', '$address', ' $price', ' $time', ' $phone', ' $intro')";
      
       $sth = $conn->prepare($sql);
      
       $sth->execute();
       $msg="資料新增成功";
      

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
        
        $msg .= "ok here";
    
        if (in_array($file_ext, $extensions)=== false) {
           $msg = "extension not allowed, please choose a JPEG or PNG file.";
        }
        
        if ($file_size > 2097152) {
           $msg = 'File size must be excately 2 MB';
        }
        
        if(empty($errors)==true){
    
           move_uploaded_file($file_tmp, "images/cover/p".$nid.".".$file_ext);
           $msg .= " and cover upload Success";
           
        }else{
           $msg = "Error upload image";
        }
      }
    
    } catch(PDOException $e) {
    
      $msg = "無法新增資料 Connection failed: " . $e->getMessage();
    
    }
    
    $conn = null;
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>美食餐廳資料</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    
    <script src="ckeditor/ckeditor.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>


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
<script type='text/javascript'>
  function preview_image(event) {
      var reader = new FileReader();
      reader.onload = function () {
          var output = document.getElementById('output_image');
          output.src = reader.result;
      }
      reader.readAsDataURL(event.target.files[0]);
  }
</script>   





<body>
    <nav class="navbar navbar-light bg-light">
        <div class="container">
          <a class="navbar-brand" href="food_list.php">Food</a>
          <button><h4><a href="logout.php">Logout</a></h4></button> 
        </div>
        </div>
      </nav>


  <!--  <header id="header " class=" align-items-center container py-4 ">
        <div class="container ">
           
            <div class="col-md-6">
<form>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label" name="bookname">信箱</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label" name="bookname">密碼</label>
    <input type="password" class="form-control" id="exampleInputPassword1">
  </div>
  <label for="exampleInputPassword1" class="form-label" name="bookname">縣市</label>
  <select class="mb-3 form-select" aria-label="Default select example">
      
      
  <option selected>縣市</option>
  <option value="1">高雄</option>
  <option value="2">台北</option>
  <option value="3">台中</option>
</select>
<div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>

  
  
</form>     
 </div>
           
    </header>
    </div>
-->  

    <div class="container py-5 " style="background-color:#F596AA;">
    <h6 class="display-4 text-center">美食餐廳資料新增<i class="bi bi-vector-pen"></i></h6>
    <?php
if(isset($msg)){
    echo'<p class="alert alert-success">'.$msg."</p>";
}
?>
    <form action="" method="post">

        <div class="container py-5 ">

            <div class="mb-3">
                <b><label for="foodname" class="form-label"style="font-size:20px">美食餐廳名稱</label></b>
                <input type="text" class="form-control" id="foodname" name="foodname" placeholder="請輸入...">

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="area" id="area" value="1">
                    <b><label class="form-check-label" for="inlineRadio1">北部</label></b>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="area" id="area" value="2">
                   <b> <label class="form-check-label" for="inlineRadio2">中部</label>
                </b></div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="area" id="area" value="3">
                    <b><label class="form-check-label" for="inlineRadio2">南部</label>
                </b></div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="area" id="area" value="4">
                    <b> <label class="form-check-label" for="inlineRadio2">東部</label></b>
                </div>

            </div>


            <!--<div class="mb-3">
                <label for="author" class="form-label">作者</label>
                <input type="text" class="form-control" id="author" name="author" placeholder="請輸入作者">
                
            </div>


           -->

            <div class="mb-3">
                <b><label for="date" class="form-label" style="font-size:20px">拍攝日期</label></b>
                <input type="date" class="form-control" id="date" name="date" value="<?php echo date('Y-m-d'); ?>" required>
            </div>

            <div class="input-group mb-3">
                <label class="input-group-text" for="cover">上傳封面</label>
                <input type="file" class="form-control" id="cover" name="cover" accept="image/*" onchange="preview_image(event)">
            </div>
            <div>
                <img id="output_image" />
            </div>

            <div class="mb-3">
               <b> <label for="address" class="form-label"style="font-size:20px">店家地址</label></b>
                <input type="text" class="form-control" id="address" name="address" placeholder="請輸入...">

            </div>
            
          

        
        <div class="row">
            <div class="col">
            <div class="mb-3">
               <b> <label for="time" class="form-label"style="font-size:20px">營業時間</label></b>
                <input type="text" class="form-control" id="time" name="time" placeholder="請輸入...">
                
            </div>
            </div>
            <div class="col">
            <div class="mb-3">
               <b> <label for="time" class="form-label"style="font-size:20px">電話</label></b>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="請輸入...">   
            </div>
            </div>
        </div>
        


            <div class="mb-3"> 
               <b> <label for="price" class="form-label"style="font-size:20px">價格</label> </b>
                <textarea name="price" rows="2" cols="50"class="form-control"id="price" name="price" placeholder="請輸入..."></textarea>   
            </div>
           

               







                <!--<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="in" id="inlineCheckbox1" value="低價位">
  <label class="form-check-label" for="inlineCheckbox1">低價位</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="in"  id="inlineCheckbox2" value="中價位">
  <label class="form-check-label" for="inlineCheckbox2">中價位</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="in" id="inlineCheckbox2" value="高價位">
  <label class="form-check-label" for="inlineCheckbox2">高價位</label>
</div>

            </div>-->

            <div class="mb-3">
               <b> <label for="intro" class="form-label"style="font-size:20px">簡介</label></b>
                <textarea class="form-control ckeditor" name="intro" id="intro" class="80" rows="10"></textarea>
               
            
            </div>


            <!--  <div class="form-check">
                <input type="checkbox" class="form-check-input" id="pubyn" name="pubyn">
              <label class="form-check-label" for="pubyn">是否公布</label></div>-->


            
            
            <button type="submit" class="btn btn-primary my-8 " name="submit" style="float:right" >資料送出</button>
            
        </div>
</div>
    </form>




<?php include('footer.html'); ?>

  


