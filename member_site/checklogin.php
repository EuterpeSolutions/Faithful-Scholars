<?php
<<<<<<< HEAD
require 'dbconfig.php';
=======
>>>>>>> 263468f1d210049e8aba9c69695430c489b02464
ob_start();

$host="127.0.0.1"; // Host name
$username="root"; // Mysql username
$password="newpassword"; // Mysql password
$db_name="FaithfulScholars"; // Database name
$tbl_name="members"; // Table name

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

$sql="SELECT id,password,username,psalt FROM $tbl_name WHERE username='$myusername'";
$result=mysqli_query($con, $sql);
if($result->num_rows != 0){
  while($row = mysqli_fetch_assoc($result)) {
      $p_salt = $row["psalt"];
      $p = $row["password"];
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
run();

}
else {
  echo "The username or password was incorrect";
}

ob_end_flush();
?>
