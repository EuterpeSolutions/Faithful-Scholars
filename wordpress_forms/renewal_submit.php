<?
$last_name=$_POST["last_name"];
$spouse=$_POST["spouse"];
$first_name=$_POST["first_name"];
$county=$_POST["county"];
$address=$_POST["address"];
$city=$_POST["city"];
$zip=$_POST["zip"];
$district=$_POST["district"];
$email=$_POST["email"];
$phone=$_POST["phone"];
$child1=$_POST["child1"];
$grade1=$_POST["grade1"];
$birthdate1=$_POST["birthdate1"];
$child2=$_POST["child2"];
$grade2=$_POST["grade2"];
$birthdate2=$_POST["birthdate2"];
$child3=$_POST["child3"];
$grade3=$_POST["grade3"];
$birthdate3=$_POST["birthdate3"];
$child4=$_POST["child4"];
$grade4=$_POST["grade4"];
$birthdate4=$_POST["birthdate4"];
$child5=$_POST["child5"];
$grade5=$_POST["grade5"];
$birthdate5=$_POST["birthdate5"];
$child6=$_POST["child6"];
$grade6=$_POST["grade6"];
$birthdate6=$_POST["birthdate6"];
$child7=$_POST["child7"];
$grade7=$_POST["grade7"];
$birthdate7=$_POST["birthdate7"];
$child8=$_POST["child8"];
$grade8=$_POST["grade8"];
$birthdate8=$_POST["birthdate8"];
$child9=$_POST["child9"];
$grade9=$_POST["grade9"];
$birthdate9=$_POST["birthdate9"];

$curriculum=$_POST["curriculum"];
$changes=$_POST["changes"];
$type=$_POST["type"];
$curriculum_plan=$_POST["curriculum_plan"];
$laws=$_POST["laws"];
$bylaws=$_POST["bylaws"];
$hs_diploma=$_POST["hs_diploma"];
$hs_students=$_POST["hs_students"];
$hs_transcript=$_POST["hs_transcript"];
$consultation=$_POST["consultations"];
$schea=$_POST["schea"];
$enchanted=$_POST["enchanted"];
$YorkTech=$_POST["YorkTech"];
$drivers=$_POST["drivers"];
$additions=$_POST["additions"];
$card=$_POST["card"];
$expedite=$_POST["expedite"];
$workshop=$_POST["workshop"];
$retreat=$_POST["retreat"];
$combo=$_POST["combo"];
$membership_documents=$_POST["membership_documents"];
if ($type == "Single_Student") {
$membership_cost = 35;
}
if ($type == "Multi-Student")
{
$membership_cost = 60;
}
if ($type == "kindergarten_only")
{
$membership_cost = 25;
}
$total = ($enchanted + $schea + $consultation + $hs_transcript + $hs_students + $hs_diploma + $membership_cost + $card + $expedite + $workshop + $retreat + $combo);

if ($spouse != "") {
	$spouse = "and " . $spouse;}

$message = " <html><head><style>
h1 {font-size: 18px;
	font-size: 1.285714286rem;
	line-height: 1.6;}
p {font-size: 14px;
	font-size: 1.285714286rem;
	line-height: 1.6;}
</style>
<body>
<br /><br />Online Renewal Form for $last_name, $first_name  $spouse <br /> <br /> Address: $address, $city, SC $zip <br /> E-mail: $email<br /> Phone: $phone<br /> County: $county   <br /> School District: $district <br /> <br /> Changes to membership information: $changes<br /> <br /> Children's names, grades, and birthdates:<br />  $child1, $grade1, $birthdate1<br /> $child2, $grade2, $birthdate2<br /> $child3, $grade3, $birthdate3<br /> $child4, $grade4, $birthdate4<br /> $child5, $grade5, $birthdate5<br /> $child6, $grade6, $birthdate6 <br /> $child7, $grade7, $birthdate7<br /> $child8, $grade8, $birthdate8 <br />$child9, $grade9, $birthdate9 <br /><br /> Curriculum Plans: $curriculum <br /><br /> Initialed compliance information: <br />   $curriculum_plan  - I have included each child's curriculum plan for this year.<br />  $laws  - I have read and understood the homeschool laws of SC section 59-65-47 and agree to abide by them, maintaining and make available all legally required home school records for review by the director of Faithful Scholars and/or the State Board of Education.<br />  $bylaws - I have read, and agree to comply with all of the Bylaws and Expectations as set forth by Faithful Scholars.<br /><br /><br />Membership Type: $type <br /><br /> Membership Additions:<br />  High School Students -- $hs_students<br /> <br /> Replacement Membership Card -- $card<br />  SCHEA Membership -- $schean<br />   Enchanted Learning Membership -- $enchanted <br />  Expedite Membership -- $expedite <br /><br />Total for membership -- $total<br /> <br />  Mail or Email membership documents?  $membership_documents<br />";

// set the to and from for the e-mail

	$to      = "katie@faithfulscholars.com, forms@faithfulscholars.com";
	$from    = "katie@faithfulscholars.com";

	$subject = "Online Renewal Form for $last_name $expedite";
$headers = "From: $from \r\n";
$headers .= "Reply-To: $from \r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$ok = @mail($to, $subject, $message, $headers);

/*
$message2 = "
<html><head><style>
h1 {font-size: 18px;
	font-size: 1.285714286rem;
	line-height: 1.6;}
p {font-size: 14px;
	font-size: 1.285714286rem;
	line-height: 1.6;}
</style>
<body>
<br /><br /><br /><br /><br />
<h2><span =
style=3D'font-size:24.0pt'>Proof of Membership & Legal Home School Status</span></h2>
<p><span =
style=3D'font-size:22.0pt'><b>Name:</b> $first_name $spouse $last_name </span> </p>
<p><span =
style=3D'font-size:22.0pt'><b>Address:</b> $address<br /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $city, SC $zip</span></p>
<p><span =
style=3D'font-size:22.0pt'><b>County:</b> $county</span></p>
<p><span =
style=3D'font-size:22.0pt'><b>School District:</b> $district</span></p>
<p><span =
style=3D'font-size:22.0pt'><b>School Year:</b> 2014-2015</p>
<p><b>Email address:</b> $email</span></p>
<p><b>Phone number:</b> $phone</span></p>
<p><span =
style=3D'font-size:22.0pt'><b>Student(s), Grade(s):</b><br/>
 &nbsp; &nbsp; &nbsp; $child1 &nbsp; $grade1<br />
 &nbsp; &nbsp; &nbsp; $child2 &nbsp; $grade2<br />
 &nbsp; &nbsp; &nbsp; $child3 &nbsp; $grade3<br />
 &nbsp; &nbsp; &nbsp; $child4 &nbsp; $grade4<br />
 &nbsp; &nbsp; &nbsp; $child5 &nbsp; $grade5<br />
 &nbsp; &nbsp; &nbsp; $child6 &nbsp; $grade6<br />
 &nbsp; &nbsp; &nbsp; $child7 &nbsp; $grade7<br />
 &nbsp; &nbsp; &nbsp; $child8  &nbsp; $grade8<br />
 &nbsp; &nbsp; &nbsp; $child9 &nbsp; $grade9<br />
</span></p>

<p>__________________________________________________<br />
Katharine S. Bach, Administrator </p>
 </body></html>
";
$subject2 = "Membership Letter for $first_name $last_name";
$headers2 = "From: $from \r\n";
$headers2 .= "Reply-To: $from \r\n";
$headers2 .= "MIME-Version: 1.0\r\n";
$headers2 .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$ok2 = @mail($to, $subject2, $message2, $headers2);
*/
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
  </div>
<div id="content">

    <canvas id="display" width="1px" height="1px" tabindex="1"> </canvas>
    <h2>Thank you for renewing your membership! </h2>
    <p> <? echo $first_name ?> <? echo $last_name?>,  <? echo $membership?></p>
    Please pay for your membership via the Paypal button below, or by mailing a check to Faithful Scholars, 1761 Ballard Ln, Fort Mill, SC 29715.  Note that if you are mailing a check, your membership renewal will not be considered complete until your check clears.  <br />
    <table align="center">
    <tr>
    <td>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top"> <!-- Identify your business so that you can collect the payments. --> <input type="hidden" name="business" value="katie@faithfulscholars.com"> <!-- Specify a Buy Now button. --> <input type="hidden" name="cmd" value="_xclick"> <!-- Specify details about the item that buyers will purchase. --> <input type="hidden" name="item_name" value="Faithful Scholars Membership Fees - <? echo $last_name ?>, <? echo $membership?>" > <input type="hidden" name="amount" value="<? echo $total ?>"> <input type="hidden" name="currency_code" value="USD"> <!-- Display the payment button. --> <input type="image" name="submit" border="0" src="http://www.faithfulscholars.com/images/paynow.jpg" alt="Faithful Scholars Checkout"> <img alt="" border="0" width="1" height="1" src="https://www.paypal.com/en_US/i/scr/pixel.gif" > </form>
</td>
</tr>
</table>
    <p>Thank you for submitting your membership renewal form online!</p>
    <p>You have chosen to receive your membership information by <? echo $membership_documents?>.    </p>
    <p><strong>Type of membership:</strong> <? echo $type ?></p>
    <p><strong>Additions to your membership: </strong> </p>
    <ul>
      <p> High school students  &nbsp; - $<? echo $hs_students ?></p>
      <p>High school diploma - $<? echo $hs_diploma ?></p>
      <p>Copy of official/compiled  4-year transcripts - $<? echo $hs_transcript ?> &nbsp;</p>
      <p> Personal consultations - $<? echo $consultation ?></p>
      <p><a href="http://www.schomeeducatorsassociation.org/" target="_blank">SCHEA</a> discounted membership - $<? echo $schea ?></p>
      <p><a href="http://www.enchantedlearning.com/" target="_blank">Enchanted Learning</a> discounted membership&nbsp;- $<? echo $enchanted ?></p>
      <p>Expedited renewal - $<? echo $expedite ?></p>
      <p><strong>Prepaid Workshops: </strong></p>
      <p>Workshop only: $<? echo $workshop ?></p>
      <p>Retreat only -$ <? echo $retreat ?></p>
      <p>Workshop and Retreat Combo -$ <? echo $combo ?></p>
    </ul>
    <p>To complete your renewal, please click the "Pay Now" button to pay securely online through PayPal.  You do not have to have a PayPal account, and you can pay with any credit card. Your total payment to Faithful Scholars for this year will be $ <? echo $total ?>.</p>
    <p>If you would prefer to pay by check, please mail your check to Faithful Scholars, </p>
    <p>If you have a high school student and need to submit your transcript information, you can do so with either the  <a href="transcript_input.html">Faithful Scholars Electronic Transcript Worksheet</a> or a <a href="transcriptform.pdf">Faithful Scholars Paper Transcript Worksheet.</a>
    </p>
    <div align="center">
      <p></p>
    </div>
</p>
<p>&nbsp;</p>
<div id="footer"></div>
  </div>
  </div>

</body>
</html>
