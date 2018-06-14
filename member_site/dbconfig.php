<?php
$host="localhost"; // Host name
$username="root"; // Mysql username
$password=""; // Mysql password
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
 ?>
