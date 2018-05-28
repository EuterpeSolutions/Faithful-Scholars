<?php
// Main information
$last_name = $_POST['last_name'];
$spouse = $_POST['spouse'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$zipcode = $_POST['zipcode'];
$district = $_POST['district'];
$first_name = $_POST['first_name'];
$email = $_POST['email'];
$city = $_POST['city'];
$county = $_POST['county'];
$extra_information = $_POST['extra_information'];
$curriculum_desc = $_POST['curriculum_desc'];

// Children
$child1=$_POST["child1"];
$grade1=$_POST["grade1"];
$birthdate1=$_POST["birthday1"];
$child2=$_POST["child2"];
$grade2=$_POST["grade2"];
$birthdate2=$_POST["birthday2"];
$child3=$_POST["child3"];
$grade3=$_POST["grade3"];
$birthdate3=$_POST["birthday3"];
$child4=$_POST["child4"];
$grade4=$_POST["grade4"];
$birthdate4=$_POST["birthday4"];
$child5=$_POST["child5"];
$grade5=$_POST["grade5"];
$birthdate5=$_POST["birthday5"];
$child6=$_POST["child6"];
$grade6=$_POST["grade6"];
$birthdate6=$_POST["birthday6"];
$child7=$_POST["child7"];
$grade7=$_POST["grade7"];
$birthdate7=$_POST["birthday7"];
$child8=$_POST["child8"];
$grade8=$_POST["grade8"];
$birthdate8=$_POST["birthday8"];
$child9=$_POST["child9"];
$grade9=$_POST["grade9"];
$birthdate9=$_POST["birthday9"];

// Membership
$initial1=$_POST["initial1"];
$initial5=$_POST["initial5"];
$initial6=$_POST["initial6"];
$optradio=$_POST["optradio"];
$high_school_number=$_POST["high_school_number"];
if(isset($_POST["replacement"]) && $_POST["replacement"] == 1){
  $replacement= "1";
} else {
  $replacement = "0";
}
if(isset($_POST["schea"]) && $_POST["schea"] == 1){
  $schea= "1";
} else {
  $schea = "0";
}
if(isset($_POST["el"]) && $_POST["el"] == 1){
  $el = "1";
} else {
  $el = "0";
}
if(isset($_POST["expedite"]) && $_POST["expedite"] == 1){
  $expedite = "1";
} else {
  $expedite = "0";
}

// Establish MySQL connection
$con=mysqli_connect("127.0.0.1","root","newpassword","FaithfulScholars");
if(mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
};

// Family Information
// SQL Queries //TODO: Replace with prepared statements after login is merged in
$sql = "INSERT INTO family (first_name, last_name, phone, email, county, zip, city, address)
                    VALUES('$first_name', '$last_name', '$phone', '$email', '$county', '$zipcode', '$city', '$address')";
$insert_id = 0;
if ($con->query($sql) === TRUE) {
  echo "New record created<br>";
  $insert_id = mysqli_insert_id($con);
  echo $insert_id . "<br>";
} else {
  echo "Error: " . $sql . "<br>" . $con->error . "<br>";
}

// Student Information
for($i = 0; $i < 9; $i++){
  if(${"child" . $i} != ''){
    $sql_student = "INSERT INTO student (family_id, name, grade, birthday)
                    VALUES ('$insert_id','${"child" . $i}','${"grade" . $i}','${"birthdate" . $i}')";
    if ($con->query($sql_student) === TRUE) {
      echo "New record created <br>";
    } else {
      echo "Error: " . $sql . "<br>" . $con->error;
    }
  }
}

// Membership Information
$type = (int)$optradio;
$highschool = (int)$high_school_number;
echo $highschool;
$sql_membership = "INSERT INTO membership (family_id, type_id, highschool,
                   replacement_card, schea, enchanted_learning, expedited, initial_1, initial_5, initial_6)
                   VALUES ('$insert_id', '$type', '$highschool', '$replacement', '$schea', '$el', '$expedite', '$initial1', '$initial5', '$initial6')";
if ($con->query($sql_membership) === TRUE) {
 echo "New record created<br>";
} else {
 echo "Error: " . $sql_membership . "<br>" . $con->error . "<br>";
}
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
    <p> <?php echo $first_name; ?> <?php echo $last_name?>,  <?php echo $membership?></p>
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
