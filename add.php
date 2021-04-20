<?php
include_once('config.php');


if(isset($_POST["submit"])){
    $acc = $_POST['acc'];
    $pass = $_POST['pass'];
    $name = $_POST['name'];
    $addr = $_POST['addr'];
   
   
    
   
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
        $sql = "INSERT INTO `members` (`bid`,`acc`,`pass`,`name`,`addr`) VALUES (NULL, '$acc', '$pass', '$name', '$addr')";
      
        $sth = $conn->prepare($sql);
      
       $sth->execute();
       $msg="資料新增成功，請登入!";
      
       //$ds = $sth->fetchAll(PDO::FETCH_ASSOC); 
      
      
      
       
      } catch(PDOException $e) {
        echo "無法新增資料Connection failed: " . $e->getMessage();
      }
      
      $conn = null;




}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>會員新增資料</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
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
	background: #E87A90;
	
}

    h6
    {
        color:white; 
        text-align: center;
	    margin-bottom: 40px;
    }

    b{
        color:white;
    }

    input {
	
	
	padding: 10px;
	

}
</style>




<body>
    <nav class="navbar navbar-light bg-light">
        <div class="container">
          <a class="navbar-brand" href="index.php" >Welcome !</a>
          <button><h4><a href="index.php">Login</a></h4></button> 

        </div>
      </nav>

    <div class="container py-5 ">
    <h6 class="display-4 text-center">會員資料新增<i class="bi bi-vector-pen"></i></h6>
    <?php
if(isset($msg)){
    echo'<p class="alert alert-success">'.$msg."</p>";
}
?>
    <form action="" method="post">

        <div class="container py-5 ">

            <div class="mb-3">
                <b><label for="acc" class="form-label"style="font-size:20px">帳號:</label></b>
                <input type="text" class="form-control" id="acc" name="acc" placeholder="請輸入..."required>
            </div>

            <div class="mb-3">
                <b><label for="foodname" class="form-label"style="font-size:20px">密碼:</label></b>
                <input type="text" class="form-control" id="pass" name="pass" placeholder="請輸入..."required>
            </div>


            <div class="mb-3">
                <b><label for="foodname" class="form-label"style="font-size:20px">英文姓名:</label></b>
                <input type="text" class="form-control" id="name" name="name" placeholder="請輸入英文姓名..."required>
            </div>


            <div class="mb-3">
                <b><label for="mail" class="form-label"style="font-size:20px">信箱:</label></b>
                <input type="email" class="form-control" id="email" name="addr" placeholder="請輸入..." required>
            </div>

          
               
          
            <button type="submit" class="btn btn-primary my-8 " name="submit" style="float:right" >資料送出</button>

            <button type="reset" class="btn btn-primary my-8 " name="reset" style="float:laft" > 重設</button>
           
        </div>
</div>
    </form>




    <?php include('footer.html'); ?>