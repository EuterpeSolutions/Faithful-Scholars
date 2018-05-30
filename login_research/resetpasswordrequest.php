<?php
ob_start();
$host="localhost"; // Host name
$username="root"; // Mysql username
$password=""; // Mysql password
$db_name="mysql"; // Database name
$tbl_name="members"; // Table name
$myemail=$_POST['myemail'];
// Connect to server and select databse.
$con = mysqli_connect("$host", "$username", "$password", $db_name);
if(!$con)
{
  die("cannot connect" . mysqli_connect_error());
}

$sql="SELECT id,password,username,psalt,email FROM $tbl_name WHERE email='$myemail'";
$result=mysqli_query($con, $sql);
if($result->num_rows != 0){
  $uniqidStr = md5(uniqid(mt_rand()));;
  $resetPassLink = 'LINK TO RESET FORM'.$uniqidStr;

  //setting up Email
  $to = $myemail;
  $subject = "Password Reset Request";
  $mailContent = 'Hello, <br/> Recently a request was submitted to reset a password for your account. If this was a mistake, just ignore this email and nothing will happen.
                <br/>To reset your password, visit the following link: <a href="'.$resetPassLink.'">'.$resetPassLink.'</a> <br/><br/>Regards,<br/>Faithful Scholars';
                //set content-type header for sending HTML email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                //additional headers
                $headers .= 'From: LOCAL MAIL SERVER' . "\r\n";
                //send email
                mail($to,$subject,$mailContent,$headers);
                header("location:email_success.php");
  }
  else {
    echo "There is no user with this email";
  };
ob_end_flush();
 ?>
