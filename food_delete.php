<?php
include_once('config.php');

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if (isset($_GET['bid'])) {

        $bid = $_GET['bid'];
     
        $sql = "DELETE FROM `twfood` WHERE `twfood`.`bid` = ".$bid;
  
        $sth = $conn->prepare($sql);
  
        $sth->execute();
        $bookcover = 'images/cover/p'.$bid.'.jpg';
        if (file_exists($bookcover)) {
            unlink($bookcover);
            // $msg .= "刪除圖片且";
        }
  
        
  
        // echo "$bid 資料刪除成功!";
        header("Location:food_list.php");
  
    } else {
  
        echo "必要要有主鍵才能刪除!";
  
    }

} catch(PDOException $e) {
    echo "無法連線Connection failed: " . $e->getMessage();
  }
  
  $conn = null;
  ?>
  