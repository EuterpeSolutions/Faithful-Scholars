<?
$highschool_diploma=$_POST["highschool_diploma"];
$days=$_POST["days"];
$plan_book=$_POST["plan_book"];
$portfolio=$_POST["portfolio"];
$semi_annual=$_POST["semi_annual"];
$end_of_year=$_POST["end_of_year"];
$taught_all=$_POST["taught_all"];
$full_name=$_POST["full_name"];
$email=$_POST["email"];
$phone=$_POST["phone"];
$hs_sent=$_POST["hs_sent"];
$hs_not=$_POST["hs_not"];
$renewal=$_POST["renewal"];
$dual_enrollment=$_POST["dual_enrollment"];
$traditional_school_name=$_POST["traditional_school_name"];

$message = "<html><head><link rel='stylesheet' type='text/css' href='http://www.faithfulscholars.com/stylesheet.css'>
<body><p> Faithful Scholars Online Compliance Form for $full_name, $email<br /><br /><br /> $highschool_diploma  -  I, the primary parent/guardian-instructor hold at least a high school diploma or GED.<br /><br /> $days  - Student(s) has/have attended a minimum of 180 days of school which are recorded in an attendance record.<br /><br />  $plan_book  - I have maintained a plan book, journal or diary and <br /><br /> $portfolio -  maintained a portfolio of academic work for each student.<br /><br /> $semi_annual  - I have completed, and have on file, a semi-annual progress report, <br /><br />  $end_of_year  -  I have completed, and have on file, an end-of-year progress report,<br /><br /> $taught_all  -  I have taught reading, writing, math, science and social studies, including composition and literature in grades 7 through 12, to my students. <br /><br /> For High Schoolers Only:  <br /><br /> Submitted high school student's grades: <br />$hs_not � <br /> Dual Enrollment: $dual_enrollment<br /><br />        By initialing the above statements and entering your full name and member number below, you are attesting to having all required records in a personal file, prepared for viewing upon request by either Faithful Scholars and or the State Board of Education.<br /><br /> Full Name: $full_name <br />  Email: $email <br /> Phone: $phone<br /><br />  Plans for next year:  $renewal   $traditional_school_name<br /></p></body></html> ";
// set the to and from for the e-mail
	$to      = "katie@faithfulscholars.com, forms@faithfulscholars.com";

	$from    = "katie@faithfulscholars.com";

	$subject = "End of Year Compliance Form for $full_name, $membership";
$headers = "From: $from \r\n";
$headers .= "Reply-To: $from \r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$ok = @mail($to, $subject, $message, $headers);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Faithful Scholars - SC Accountability Association</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="stylesheet.css" type="text/css" />
</head>

<body>

<div id="container">
	<div id="header">
	 <p align="center">&nbsp;</p>
	 \</div><div id="content">
    <h2>Thank you! </h2>
    <p> <? echo $full_name?>,  <? echo $membership?>
    <p>Thank you for submitting your end-of-year compliance form online! We hope you have enjoyed your year of educating at home.  We have enjoyed serving you. Please consider renewing your membership today. </p>
  	      <?
		if ($renewal == "Renewing_Now")
{
echo "<p ><b><a href=\"renewal.html\"> Renew your Faithful Scholars membership online now! </a></b></p>";
}
		?>
      <p>Blessings,	      </p>
      <p>Darrell and Kate Bach </p>
      <div id="footer">    </div>
  </div>
  </div>
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-2104275-2";
urchinTracker();
</script>
</body>
</html>
