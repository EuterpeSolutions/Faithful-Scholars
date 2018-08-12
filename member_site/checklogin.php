<?php
require_once 'dbconfig.php';
ob_start();

// Connect to server and select databse.
$con = db_connect();
// Define $myusername and $mypassword
$myusername=$_POST['username'];
$mypassword=$_POST['password'];

// To protect MySQL injection
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysqli_real_escape_string($con, $myusername);
$mypassword = mysqli_real_escape_string($con, $mypassword);
$id = 0;

$id = db_user_query('id', '', $myusername);
$p = db_user_query('password', '', $myusername);
$p_salt = db_user_query('salt', '', $myusername);
$approved = db_user_query('approved', '', $myusername);
$site_salt="faithfulscholarsalt";
$salted_hash = hash('sha256',$mypassword.$site_salt.$p_salt);

//If pwds match
if($p==$salted_hash){
  $p = "";
  require 'config.php';
  require 'functions.php';
  session_start();
  if($approved == 0){
    $_SESSION['approved'] = 1;
    runUnApproved();
  }else {
    $_SESSION['pwd'] = $salted_hash;
    $_SESSION['uname'] = $myusername;
    $_SESSION['userid'] = $id;
    $_SESSION['adminproxyid'] = -1;
    run();
  }
}
else {
  echo "The username or password was incorrect";
}

ob_end_flush();
?>
