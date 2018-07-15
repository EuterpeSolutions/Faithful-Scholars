<?php

$tbl_name="members"; // Table name
function db_connect(){
  global $host, $username, $password, $db_name;
  $host_name = 'db743020317.db.1and1.com';
$database = 'db743020317';
$user_name = 'dbo743020317';
$password = 'dkamsmdd9';
$con = mysqli_connect($host_name, $user_name, $password, $database);

if (mysqli_connect_errno()) {
    die('<p>Failed to connect to MySQL: '.mysqli_connect_error().'</p>');
}
  return $con;
}

function isAdmin($username) {
  $con = db_connect();
  $sql = "SELECT COUNT(id) as count FROM members WHERE admin = 1 AND username LIKE '%$username%'";
  if($stmt = $con->prepare($sql))
  {
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($count);
    while($stmt->fetch()){
      if($count > 0){
        return true;
      } else {
        return false;
      }
    }
  }
  return false;
}

//Retrieve user data
function db_user_query($selection,$myemail,$myusername)
{
  $con = db_connect();
  global $tbl_name;
  if($myemail != '')
    $sql="SELECT id,password,username,psalt,email FROM $tbl_name WHERE email='$myemail'";
  else if($myusername != '')
    $sql="SELECT id,password,username,psalt,email FROM $tbl_name WHERE username='$myusername'";
  else {
    echo 'No key input';
    return '';
  }
  if($stmt = $con->prepare($sql))
  {
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($col1, $col2, $col3, $col4, $col5);
    while($stmt->fetch())
    {
      $id = $col1;
      $p = $col2;
      $username = $col3;
      $p_salt = $col4;
      $email = $col5;
    }
  }
  else {
    echo 'db connection errror';
  }
  switch ($selection) {
    case 'id':
      return $id;
      break;
    case 'password':
      return $p;
      break;
    case 'username':
      return $username;
      break;
    case 'salt':
      return $p_salt;
      break;
    case 'email':
      return $email;
      break;
    default:
      echo 'Did not select a category';
      break;
  }

}

function checkSalt ($psalt) {
  $con = db_connect();
  $sql = "SELECT COUNT(id) FROM members WHERE psalt = '$psalt';";
  if($stmt = $con->prepare($sql)){
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($count);
    while($stmt->fetch())
    {
      if($count != 1){
	return false;
      }
      return true;
    }
  }
}








 ?>
