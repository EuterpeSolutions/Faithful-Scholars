<?php
require 'dbconfig.php';
ob_start();

//$host="127.0.0.1"; // Host name
//$username="root"; // Mysql username
//$password=""; // Mysql password
//$db_name="FaithfulScholars"; // Database name
//$tbl_name="members"; // Table name

// Connect to server and select databse.
$con = db_connect();
// Define $myusername and $mypassword
$myusername=$_POST['myusername'];
$mypassword=$_POST['mypassword'];

// To protect MySQL injection
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysqli_real_escape_string($con, $myusername);
$mypassword = mysqli_real_escape_string($con, $mypassword);
$id = 0;

$sql="SELECT id,password,username,psalt FROM $tbl_name WHERE username='$myusername'";

if($stmt = $con->prepare($sql))
{
  $stmt->execute();
  $stmt->store_result();
  $stmt->bind_result($col1, $col2, $col3, $col4);
  while($stmt->fetch())
  {
    $id = $col1;
    $p = $col2;
    $p_salt = $col4;
  }
}

else {
  echo "The username or password was incorrect";
}

$site_salt="faithfulscholarsalt";
$salted_hash = hash('sha256',$mypassword.$site_salt.$p_salt);

//If pwds match
if($p==$salted_hash){

require 'config.php';
require 'functions.php';
session_start();
$_SESSION['pwd'] = $salted_hash;
$_SESSION['uname'] = $myusername;
$_SESSION['userid'] = $id;
run();

}
else {
  echo "The username or password was incorrect";
}

ob_end_flush();
?>
