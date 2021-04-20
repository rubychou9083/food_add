<?php
include_once('config.php');


try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = "SELECT * FROM `twfood`";

 $sth = $conn->prepare($sql);

 $sth->execute();

 $ds = $sth->fetchAll(PDO::FETCH_ASSOC); 

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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="ckeditor/ckeditor.js"></script>

    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>


<style>
  
    footer {
        color:white;
    }
    footer nav {
        margin-top: 50px;
    }
    #main {
        margin-bottom: 100px;
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
   
<table class="table">
      <tr>
          <th>區域</th>
          <th>美食餐廳名稱</th>

          <th>店家地址</th>
         
          <th>營業時間</th>
          <th>電話</th>
          
          <th><a href="food_add.php" target="_blank">新增</a></th>

      
      </tr>

 




<?php
    $btype = array('1'=>"北部", '2'=>"中部",'3'=>"南部",'4'=>"東部");

     foreach ($ds as $d){
      echo "<tr >";
      echo "<td >". $d['area'] . "</td>";

          $bookcover = 'images/cover/p'.$d['bid'].'.jpg';
          if (file_exists($bookcover)) {
            echo '<img src="'.$bookcover.'" alt="" height="30">';
          }
      echo '<td><a href="food_show.php?bid='. $d['bid'] . '">';
      echo  $d['foodname'] . "</a></td>";
      echo "<td>".$d['address'] . "</td>";
    
      echo "<td>".$d['time'] . "</td>";
      echo "<td>".$d['phone'] . "</td>";
      echo "<td>";
      echo '<a href="food_edit.php?bid='. $d['bid'].'">修改 </a>';
      echo '<a href="food_delete.php?bid='. $d['bid'].'"onclick="return confirm(\'確定刪除這筆資料嗎\');">刪除</a>';
      echo "</td>";
      echo "</tr>";
    } 
    
  ?>



      </table>
     </div>
  </div>


  
     
</body>