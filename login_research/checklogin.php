<?php

ob_start();
$host="localhost"; // Host name
$username="root"; // Mysql username
$password=""; // Mysql password
$db_name="mysql"; // Database name
$tbl_name="members"; // Table name

// Connect to server and select databse.
$con = mysqli_connect("$host", "$username", "$password", $db_name);
if(!$con)
{
  die("cannot connect" . mysqli_connect_error());
}
//mysqli_select_db($con, "$db_name")or die("cannot select DB");

// Define $myusername and $mypassword
$myusername=$_POST['myusername'];
$mypassword=$_POST['mypassword'];

// To protect MySQL injection (more detail about MySQL injection)
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

$site_salt="faithfulscholarsalt";
$salted_hash = hash('sha256',$password.$site_salt.$p_salt);


// Mysql_num_row is counting table row
//$count=mysqli_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row

//if($count==1){
if($p==$salted_hash){

// Register $myusername, $mypassword and redirect to file "login_success.php"
//session_register("myusername");
//session_register("mypassword");
header("location:login_success.php");
}
else {
echo "Wrong Username or Password \n";
echo $p;
echo "<<<>>>";
echo $salted_hash;
}

ob_end_flush();
?>
