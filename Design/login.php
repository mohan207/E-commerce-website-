<?php

$uname = $_POST['uname'];
$upswd = $_POST['upswd'];




if (!empty($uname) || !empty($upswd) )
{

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "veganaze";



// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}
else{
  $SELECT = "SELECT email From login Where email = ? Limit 1";
  $INSERT = "INSERT Into login (uname , upswd )values(?,?,?,?)";

//Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $uname);
     $stmt->execute();
     $stmt->bind_result($uname);
     $stmt->store_result();
     $rnum = $stmt->num_rows;

     //checking username
      if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ssss", $uname,$upswd);
      $stmt->execute();
      echo "<script> window.location.assign('index.html'); </script>";
     } else {
      echo "Someone already logged in with this username";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>