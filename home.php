

<!DOCTYPE html>
<?php
session_start();
  #  $_SESSION['name']='';
 #   $_SESSION['acc']='';
   # echo $_SESSION['name'];  
?>



<head>

	<title>HOME</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<style>
body {
	background: #D05A6E;
	display: flex;
	justify-content: center;
	align-items: center;
	height: 100vh;
	flex-direction: column;
}
</style>
<body>
     <h1>Hello,Welcome <?php echo $_SESSION['name'];?></h1>
     <a href="food_add.php">FOOD</a>
</body>
</html>

<?php 

   
 ?>