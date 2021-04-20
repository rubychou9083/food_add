<?php
include_once('config.php');


if (isset($_GET['bid'])){

    $bid = $_GET['bid'];


try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = "SELECT * FROM `twfood` WHERE `twfood`.`bid`=".$bid;

 $sth = $conn->prepare($sql);

 $sth->execute();

 $ds = $sth->fetchAll(PDO::FETCH_ASSOC); 
 $d =$ds[0];

//print_r($ds);
//foreach ($ds as $d){
  //echo "書名:" . $d['bookname'];
  //echo "作者:" . $d['author'];
  //echo "<hr>";
    //}




 
} catch(PDOException $e) {
  echo "無法連線Connection failed: " . $e->getMessage();
}

$conn = null;

} else{

    header("Location:food_list.php");
}

?>

<?php include('header.html'); ?>

  <div class="container" id="main">
  <h1 class="text-center my-3">food details</h1>
  <table class="table">
    <tr><th nowrap>美食餐廳名稱</th><td><?php echo $d['foodname'];?></td></tr>
    <tr><th>區域</th><td><?php echo $d['area'];?></td>   </tr>
    <tr><th>拍攝日期</th><td><?php echo $d['date'];?></td></tr>
    <tr><th>店家地址</th><td><?php echo $d['address'];?></td></tr>
    <tr><th>價格</th><td><?php echo nl2br( $d['price']);?></td></tr>
    <tr><th>營業時間</th><td><?php echo $d['time'];?></td></tr>
    <tr><th>電話</th><td><?php echo $d['phone'];?></td></tr>
    <tr><th>簡介</th><td><?php echo nl2br($d['intro']);?></td></tr>
    </tr>
<?php
         $btype = array('1'=>"北部", '2'=>"中部",'3'=>"南部",'4'=>"東部");


?>    
  </table>
  <?php
    $bookcover = 'images/cover/p'.$d['bid'].'.jpg';
    if (file_exists($bookcover)) {
      echo '<p>封面</p>';
      echo '<img src="'.$bookcover.'" alt="">';
    }
  ?>

  </div>
  <?php include('footer.html'); ?>


