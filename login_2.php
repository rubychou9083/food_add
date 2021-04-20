<?php
session_start();
echo $_POST['uname'];
echo $_POST['password'];
#echo $_SESSION['name'];

#require_once 'source/session.php';
#equire_once 'source/db_connect.php';
$con=mysqli_connect("localhost","root","");
mysqli_select_db($con,"food");

#$data=mysqli_query($con,"select * from members");
$data=mysqli_fetch_array(mysqli_query($con,"select * from members where acc='$_POST[uname]' and  pass='$_POST[password]'  "));
  
if ($data['acc']!=''){ 
  #$_SESSION['uname'] = $_POST['uname'];
  $_SESSION['name'] = $data['name'];
  echo $data['name'];

    header('location: home.php');
    
  }else{
    
    echo "Error: Invalid username or password";
  }
/*
if(isset($_POST['login-btn'])) {

    $user = $_POST['uname'];
    $password = $_POST['password'];

    try {
      $SQLQuery = "SELECT * FROM member WHERE username = 'test' ";
      $statement = $conn->prepare($SQLQuery);
      $statement->execute(array(':username' => $user));

      while($row = $statement->fetch()) {
        $id = $row['id'];
        $hashed_password = $row['password'];
        $username = $row['username'];

        if(password_verify($password, $hashed_password)) {
          $_SESSION['id'] = $id;
          $_SESSION['username'] = $username;
          header('location: food_add.php');
        }
        else {
          echo "Error: Invalid username or password";
        }
      }
    }
    catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }

}
*/
?>