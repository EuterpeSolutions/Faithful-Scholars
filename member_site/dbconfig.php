<?php

$tbl_name="members"; // Table name
function db_connect(){
  global $host, $username, $password, $db_name;
  $host_name="127.0.0.1"; // Host name
  $user_name="root"; // Mysql username
  $password="newpassword"; // Mysql password
  $database="FaithfulScholars"; // Database name
  $tbl_name="members"; // Table name

$con = mysqli_connect($host_name, $user_name, $password, $database);

if (mysqli_connect_errno()) {
    die('<p>Failed to connect to MySQL: '.mysqli_connect_error().'</p>');
}
  return $con;
}

function isAdmin($username) {
  $con = db_connect();

  $result = mysqli_query($con, "CALL checkAdmin('$username')") or die("Query fail: " . mysqli_error());

  while($row = mysqli_fetch_array($result)){
    if($row['count'] > 0){
      return true;
    }else{
      return false;
    }
  }
  return false;
}

//Retrieve user data
function db_user_query($selection,$myemail,$myusername)
{
  $con = db_connect();

  $result = mysqli_query($con, "CALL userQuery('$myemail','$myusername')") or die("Query fail: " . mysqli_error);
  while($row = mysqli_fetch_array($result)){
    $id = $row['id'];
    $p = $row['password'];
    $username = $row['username'];
    $p_salt = $row['psalt'];
    $email = $row['email'];
    $approved = $row['approved'];
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
    case 'approved':
      return $approved;
      break;
    default:
      echo 'Did not select a category';
      break;
  }

}

function checkSalt ($psalt) {
  $con = db_connect();

  $result = mysqli_query($con, "CALL checkSalt('$psalt')") or die("Query error: " . mysqli_error());

  while( $row = mysqli_fetch_array($result)){
    if($row['count'] != 1){
      return false;
    }
    return true;
  }
}

function checkLogin($userid){
  $con = db_connect();
  $sql = "SELECT approved FROM members WHERE family_id = " . $userid . ";";
  if($stmt = $con->prepare($sql))
  {
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($count);
    while($stmt->fetch()){
      $approved_value = $approved;
    }
  }
  // Check if a user is logged in
  if($approved_value = 1 && isset($_SESSION['userid']) && isset($_SESSION['pwd'])){
    // If they are logged in then run the template / function files to fill out the app
    return 1;
  } else {
    // If not logged in then render the login file
    return 0;
  }
}
?>
