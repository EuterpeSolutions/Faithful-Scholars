<?php
$host="localhost"; // Host name
$username="root"; // Mysql username
$password="newpassword"; // Mysql password
$db_name="mysql"; // Database name
$tbl_name="members"; // Table name

function db_connect(){
  global $host, $username, $password, $db_name;
  $con = mysqli_connect("$host", "$username", "$password", $db_name);
  if(!$con)
  {
    die("cannot connect" . mysqli_connect_error());
  }
  return $con;
}
 ?>
