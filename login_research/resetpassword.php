<?php
require 'dbconfig.php';
ob_start();
$host="localhost"; // Host name
$username="root"; // Mysql username
$password=""; // Mysql password
$db_name="mysql"; // Database name
$tbl_name="members"; // Table name
$myemail=$_POST['myemail'];
$mypassword=$_POST['mypassword'];
// Connect to server and select databse.
$con = db_connect();

//find this user
$sql="SELECT id,password,username,psalt,email FROM $tbl_name WHERE email='$myemail'";
$result=mysqli_query($con, $sql);
//get the salt
if($result->num_rows != 0){
  while($row = mysqli_fetch_assoc($result)) {
      $p_salt = $row["psalt"];
  }
}
//Create new pwd hash
$site_salt="faithfulscholarsalt";
$salted_hash = hash('sha256',$mypassword.$site_salt.$p_salt);
//Submit new pwd
$sql="UPDATE members SET password = '$salted_hash' WHERE email = '$myemail'";
$retval = mysqli_query( $sql, $conn );

            if(! $retval ) {
               die('Could not update data: ' . mysqli_error());
            }
            echo "Updated data successfully\n";
ob_end_flush();
 ?>
