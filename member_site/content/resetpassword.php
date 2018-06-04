<?php
ob_start();
require 'db_config.php';
$myemail=$_POST['myemail'];
$mypassword=$_POST['mypassword'];
// Connect to server and select databse.
$con = mysqli_connect("$host", "$username", "$password", $db_name);
if(!$con)
{
  die("cannot connect" . mysqli_connect_error());
}

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
