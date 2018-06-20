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

$id = db_user_query('id', '', $myusername);
$p = db_user_query('password', '', $myusername);
$p_salt = db_user_query('salt', '', $myusername);
$site_salt="faithfulscholarsalt";
$salted_hash = hash('sha256',$mypassword.$site_salt.$p_salt);

//If pwds match
if($p==$salted_hash){
$p = "";
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
