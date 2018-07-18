<?php
require_once 'dbconfig.php';
ob_start();
// Connect to server and select databse.
$con = db_connect();
$myemail=$_POST['myemail'];
$mypassword=$_POST['mypassword'];
// Connect to server and select databse.
$con = db_connect();
//Create new pwd hash
$site_salt="faithfulscholarsalt";
$p_salt = db_user_query('salt',$myemail, '');
$salted_hash = hash('sha256',$mypassword.$site_salt.$p_salt);
//Submit new pwd
$sql="UPDATE members SET password = '$salted_hash' WHERE email = '$myemail'";

$con->query($sql);
header("Location: /member_site");
ob_end_flush();
 ?>
