<?php
require '../dbconfig.php';
ob_start();
$myemail=$_POST['myemail'];
// Connect to server and select databse.
$con = db_connect();
//Find user email
$email = db_user_query('email',$myemail, '');
//Generate reset link
if($email == $myemail){
  $uniqidStr = md5(uniqid(mt_rand()));;
  $resetPassLink = 'LINK TO RESET FORM SHOULD GO TO RESETPASWORD_FORM'.$uniqidStr;

  //setting up Email
  $to = $myemail;
  $from    = "katie@faithfulscholars.com";
  $subject = "Password Reset Request";
  $mailContent = 'Hello, <br/> Recently a request was submitted to reset a password for your account. If this was a mistake, just ignore this email and nothing will happen.
                <br/>To reset your password, visit the following link: <a href="'.$resetPassLink.'">'.$resetPassLink.'</a> <br/><br/>Regards,<br/>Faithful Scholars';
                //set content-type header for sending HTML email
                $headers = "From: $from \r\n";
                $headers .= "Reply-To: $from \r\n";
                $headers .= "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                //additional headers
                //send email
                mail($to,$subject,$mailContent,$headers);
                header("location:email_success.php");
  }
  else {
    echo "There is no user with this email";
  };
ob_end_flush();
 ?>
