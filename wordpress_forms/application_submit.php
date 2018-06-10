 <?php
$last_name=$_POST["last_name"];
$new_fs=$_POST["new_fs"];
$father=$_POST["father"];
$mother=$_POST["mother"];
$address=$_POST["address"];
$city=$_POST["city"];
$zip=$_POST["zip"];
$county=$_POST["county"];
$phone=$_POST["phone"];
$cell_phone_mom=$_POST["cell_phone_mom"];
$cell_phone_dad=$_POST["cell_phone_dad"];
$email=$_POST["email"];
$start_date=$_POST["start_date"];
$new_hs=$_POST["new_hs"];
$end_date=$_POST["end_date"];
$years_homeschooling=$_POST["years_homeschooling"];
$primary_instructor=$_POST["primary_instructor"];
// $instructor_education=$_POST["instructor_education"];
$removing_ps=$_POST["removing_ps"];
$referred_by=$_POST["referred_by"];
// $school_name=$_POST["school_name"];
$school_district=$_POST["school_district"];
$school_fax=$_POST["school_fax"];
$type=$_POST["type"];
$hs_students=$_POST["hs_students"];
// $hs_diploma=$_POST["hs_diploma"];
// $hs_transcript=$_POST["hs_transcript"];
// $consultations=$_POST["consultations"];
$card=$_POST["card"];
$schea=$_POST["schea"];
$enchanted=$_POST["enchanted"];
$expedite=$_POST["expedite"];
$certify_curriculum=$_POST["certify_curriculum"];
$certify_diploma=$_POST["certify_diploma"];
$certify_hs_transcript=$_POST["certify_hs_transcript"];
$certify_hs_gpa=$_POST["certify_hs_gpa"];
$certify_laws=$_POST["certify_laws"];
$certify_bylaws=$_POST["certify_bylaws"];
$student_1=$_POST["student_1"];
$student_1_grade=$_POST["student_1_grade"];
$student_1_age=$_POST["student_1_age"];
$student_1_birthdate=$_POST["student_1_birthdate"];
$student_2=$_POST["student_2"];
$student_2_grade=$_POST["student_2_grade"];
$student_2_age=$_POST["student_2_age"];
$student_2_birthdate=$_POST["student_2_birthdate"];
$student_3=$_POST["student_3"];
$student_3_grade=$_POST["student_3_grade"];
$student_3_age=$_POST["student_3_age"];
$student_3_birthdate=$_POST["student_3_birthdate"];
$student_4=$_POST["student_4"];
$student_4_grade=$_POST["student_4_grade"];
$student_4_age=$_POST["student_4_age"];
$student_4_birthdate=$_POST["student_4_birthdate"];
$student_5=$_POST["student_5"];
$student_5_grade=$_POST["student_5_grade"];
$student_5_age=$_POST["student_5_age"];
$student_5_birthdate=$_POST["student_5_birthdate"];
$student_6=$_POST["student_6"];
$student_6_grade=$_POST["student_6_grade"];
$student_6_age=$_POST["student_6_age"];
$student_6_birthdate=$_POST["student_6_birthdate"];
$student_7=$_POST["student_7"];
$student_7_grade=$_POST["student_7_grade"];
$student_7_age=$_POST["student_7_age"];
$student_7_birthdate=$_POST["student_7_birthdate"];
$student_8=$_POST["student_8"];
$student_8_grade=$_POST["student_8_grade"];
$student_8_age=$_POST["student_8_age"];
$student_8_birthdate=$_POST["student_8_birthdate"];
$curriculum_student1=$_POST["curriculum_student1"];
$curriculum_student2=$_POST["curriculum_student2"];
$curriculum_student3=$_POST["curriculum_student3"];
$curriculum_student4=$_POST["curriculum_student4"];
$curriculum_student5=$_POST["curriculum_student5"];
$curriculum_student6=$_POST["curriculum_student6"];
$curriculum_student7=$_POST["curriculum_student7"];
$curriculum_student8=$_POST["curriculum_student8"];



// Connect to server and select databse.
require 'dbconfig.php';
$con = mysqli_connect("$host", "$username", "$password", $db_name);
if(!$con)
{
  die("cannot connect" . mysqli_connect_error());
}
$username=mysqli_real_escape_string($con,$_POST["username"]);
$password=mysqli_real_escape_string($con,$_POST["password"]);
$email=mysqli_real_escape_string($con,$_POST["email"]);
//Make salted hash
$site_salt = "faithfulscholarsalt";
$p_salt = hash('sha256',$zip.$phone);
$password = hash('sha256',$password.$site_salt.$p_salt);
//Sql connection


$insert = $con->query( "INSERT INTO members (username,psalt,password,email) VALUES
('$username','$p_salt','$password','$email')" );

if($new_hs == 'yes'){
  $new_hs = 1;
} else {
  $new_hs = 0;
}

$family_insert_sql = "INSERT INTO family (last_name, father_name, mother_name, address, city, zip, county, phone, mom_cell, dad_cell, email, new) VALUES ('$last_name', '$father', '$mother', '$address', '$city', '$zip', '$county', '$phone', '$cell_phone_mom', '$cell_phone_dad', '$email', $new_hs)";
$family_id = 0;
if($con->query($family_insert_sql) === TRUE) {
  $family_id = mysqli_insert_id($con);
}


$homeschool_insert_sql = "INSERT INTO homeschool(family_id, school_start_date, school_end_date, new_homeschool, years_homeschooling, primary_instructor, removing_public_school, referred_by, school_district, school_fax) VALUES ($family_id, '$start_date', '$end_date', $new_hs, $years_homeschooling, '$primary_instructor', '$removing_ps', '$referred_by', '$school_district', '$school_fax')";
$con->query($homeschool_insert_sql);


if($type = "Kindergarten-Only"){
  $type = 1;
} else if ($type = "Single-Student"){
  $type = 2;
} else {
  $type = 3;
}


if(isset($schea)){
  $schea = 1;
} else {
  $schea = 0;
}

if(isset($enchanted)){
  $enchanted = 1;
} else {
  $enchanted = 0;
}

if(isset($card)){
  $card = 1;
} else {
  $card = 0;
}

if(isset($expedite)){
  $expedite = 1;
} else {
  $expedite = 0;
}

$membership_insert_sql = "INSERT INTO membership(family_id, type_id, highschool, replacement_card, schea, enchanted_learning, expedited, initial_1, initial_2, initial_3, initial_4, initial_5, initial_6) VALUES ($family_id, '$type', $hs_students, $card, $schea, $enchanted, $expedite, '$certify_curriculum', '$certify_diploma', '$certify_hs_transcript', '$certify_hs_gpa', '$certify_laws', '$certify_bylaws')";
$con->query($membership_insert_sql);


for($i = 1; $i <= 9; $i++){
  if(isset(${"student_".$i})){
    $student_insert_sql = "INSERT INTO student (family_id, name, grade, age, birthday, curriculum_desc)VALUES ($family_id, '${"student_".$i}', '${"student_".$i."_grade"}', '${"student_".$i."_age"}', '${"student_".$i."_birthdate"}', '${"curriculum_student".$i}')";
    $con->query($student_insert_sql);
  }
}

mysqli_close($con);

echo "type: " . $type . "<br>";
echo $membership_insert_sql . "<br>";

// if ($type == "Single-Student") {
// $membership_cost = 35;
// }
// if ($type == "Multi-Student")
// {
// $membership_cost = 60;
// }
// if ($type == "Kindergarten-Only")
// {
// $membership_cost = 25;
// }
// $total = ($enchanted + $schea + $consultations + $hs_transcript + $hs_students + $hs_diploma + $membership_cost + $card + $expedite );
//
// if ($expedite == 20){
// $warning=" -- Expedited Application";
// }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Faithful Scholars - SC Accountability Association</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="stylesheet.css" type="text/css" />
</head>

<body>



    <h2>Thank you for applying for membership with Faithful Scholars! </h2>
    <p> <? echo $last_name?> Family,
    <p>Thank  you for joining Faithful Scholars; we look forward to serving your  family.  Below is a summary of what you have submitted to us. Please print a copy of this page to keep as a record of your membership until your membership packet arrives.  </p>
    <p> To complete your application, please click the "Pay Now" button to pay securely online through PayPal.  You do not have to have a PayPal account, and you can pay with any credit card. You may also pay by personal check, certified check, or money order.  Please mail payments to: Faithful Scholars, 1761 Ballard Lane, Fort Mill, SC 29715.  Your total payment to Faithful Scholars for this year will be $ <? echo $total ?>.</p>
    <? if ($expedite == 20){ ?>
         <p>  You have chosen to expedite your application.  You are legal to homeschool as of the completion of submitting and paying for your application.  Your paperwork will be process, faxed and/or mailed out within 24 hours. </p>
         <? }
		   else { ?>
         <p>&nbsp; It will take us 3 to 30 days to fully process your paperwork  including mailouts.&nbsp; You are legal to homeschool as of the completion  of submitting/paying for your application.&nbsp; If there are any problems  with your application you will be notified within 7 days.&nbsp; If you need  your paperwork fully processed before this time, please hit the back arrow and re-submit your applicaton with expedited application option checked for an additional $20--which will have it processed,  faxed and/or mailed out within 24 hours.&nbsp;&nbsp;      </p>
         <? } ?>
    <p>If you have any questions or comments about your application, please <a href="contact.html">contact us!</a></p>
    <div align="center">
      <p>

</p>
<table align="center"><tr><td>
	  <form action="https://www.paypal.com/cgi-bin/webscr" method="post"  target="_top"> <!-- Identify your business so that you can collect the payments. --> <input type="hidden" name="business" value="katie@faithfulscholars.com"> <!-- Specify a Buy Now button. --> <input type="hidden" name="cmd" value="_xclick"> <!-- Specify details about the item that buyers will purchase. --> <input type="hidden" name="item_name" value="Faithful Scholars Membership Fees - <? echo $last_name ?>, <? echo $membership?>" > <input type="hidden" name="amount" value="<? echo $total ?>"> <input type="hidden" name="currency_code" value="USD"> <!-- Display the payment button. --> <input type="image" name="submit" border="0" src="http://www.faithfulscholars.com/images/paynow.jpg" alt="Faithful Scholars Checkout"> <img alt="" border="0" width="1" height="1" src="https://www.paypal.com/en_US/i/scr/pixel.gif" > </form></td></tr></table>

</div>
</p>
<p>&nbsp;</p>
    <h2> Information Submitted: </h2>
	  <p>&nbsp;</p>
      <fieldset>
        <legend> Family Information </legend>
        <table width="700" border="0">
          <tr>
            <td width="153"><label for="last_name">Last Name</label></td>
            <td width="120"><? echo $last_name ?></td>
            <td width="226"><label for="new_fs">New to Faithful Scholars?</label></td>
            <td width="183"><? echo $new_hs ?></td>
          </tr>
          <tr>
            <td><label for="Father2">Father's Name </label></td>
            <td><? echo $father ?></td>
            <td><label for="phone2">Phone</label></td>
            <td><? echo $phone?></td>
          </tr>
          <tr>
            <td><label for="mother">Mother's Name</label></td>
            <td><? echo $mother?></td>
            <td><label>Cell Phone (Mom)</label></td>
            <td><? echo $cell_phone_mom ?></td>
          </tr>
          <tr>
            <td><label for="address">Address</label></td>
            <td><? echo $address?></td>
            <td><label>Cell Phone (Dad)</label></td>
            <td><? echo $cell_phone_dad ?></td>
          </tr>
          <tr>
            <td><label for="city">City</label></td>
            <td><? echo $city ?></td>
            <td><label>Email Address</label></td>
            <td><? echo $email ?></td>
          </tr>
          <tr>
            <td><label for="zip">Zip</label></td>
            <td><? echo $zip ?></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><label for="county">County</label></td>
            <td><? echo $county ?></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
        <p>&nbsp;</p>
      </fieldset>
      <fieldset>
        <legend> Homeschool Information </legend>
        <table width="700" border="0">
          <tr>
            <td width="174"><label for="start_date">School Year Start Date</label></td>
            <td width="88"><? echo $start_date ?></td>
            <td width="280"><label>New to Homeschooling?</label></td>
            <td width="140"><? echo $new_hs ?></td>
          </tr>
          <tr>
            <td><label for="end_date">End of Year Date</label></td>
            <td><? echo $end_date ?></td>
            <td><label>Years of homeschooling</label></td>
            <td><? echo $years_homeschoooling ?></td>
          </tr>
          <tr>
            <td><label for="primary_instructor">Primary Instructor</label></td>
            <td><? echo $primary_instructor ?></td>
            <td><label>States in which you've homeschooled</label></td>
            <td><? echo $states_homeschooled ?></td>
          </tr>
          <tr>
            <td><label for="instructor_education">Level of Education</label></td>
            <td><? echo $instructor_education ?></td>
            <td><label>Removing a child from Public School?</label></td>
            <td><? echo $removing_ps ?></td>
          </tr>
          <tr>
            <td><label for="referred_by">Referred By</label></td>
            <td><? echo $referred_by ?></td>
            <td><label>If yes, school name:</label></td>
            <td><? echo $school_name ?></td>
          </tr>
          <tr>
            <td><label for="school_district">School District</label></td>
            <td><? echo $school_district ?></td>
            <td><label>If yes, school fax #:</label></td>
            <td><? echo $school_fax ?></td>
          </tr>
        </table>
        <p>&nbsp;</p>
      </fieldset>
      <fieldset>
        <legend> Student Information </legend>
        <table width="600" border="1" cellpadding="3" cellspacing="0">
          <tr>
            <td>Student Name</td>
            <td>Grade</td>
            <td>Age</td>
            <td>Birthdate (M / D / Y)</td>
          </tr>
          <tr>
            <td><? echo $student_1?></td>
            <td><? echo $student_1_grade ?></td>
            <td><? echo $student_1_age ?></td>
            <td><? echo $student_1_birthdate ?></td>
          </tr>
          <tr>
            <td><? echo $student_2 ?></td>
            <td><? echo $student_2_grade ?></td>
            <td><? echo $student_2_age ?></td>
            <td><? echo $student_2_birthdate ?></td>
          </tr>
          <tr>
            <td><? echo $student_3 ?></td>
            <td><? echo $student_3_grade ?></td>
            <td><? echo $student_3_age ?></td>
            <td><? echo $student_3_birthdate ?></td>
          </tr>
          <tr>
            <td><? echo $student_4 ?></td>
            <td><? echo $student_4_grade ?></td>
            <td><? echo $student_4_age ?></td>
            <td><? echo $student_4_birthdate ?></td>
          </tr>
          <tr>
            <td><? echo $student_5 ?></td>
            <td><? echo $student_5_grade ?></td>
            <td><? echo $student_5_age ?></td>
            <td><? echo $student_5_birthdate ?></td>
          </tr>
          <tr>
            <td><? echo $student_6 ?></td>
            <td><? echo $student_6_grade ?></td>
            <td><? echo $student_6_age ?></td>
            <td><? echo $student_6_birthdate ?></td>
          </tr>
          <tr>
            <td><? echo $student_7 ?></td>
            <td><? echo $student_7_grade ?></td>
            <td><? echo $student_7_age ?></td>
            <td><? echo $student_7_birthdate ?></td>
          </tr>
          <tr>
            <td><? echo $student_8 ?></td>
            <td><? echo $student_8_grade ?></td>
            <td><? echo $student_8_age ?></td>
            <td><? echo $student_8_birthdate ?></td>
          </tr>
        </table>
        <p>&nbsp;</p>
      </fieldset>
      <fieldset>
        <legend> Membership Information </legend>
        <p><strong>Type of Membership: </strong></p>
        <ul>
          <p>
            <? echo $type ?>
          </p>
        </ul>
        <p><strong>Additions to your membership: </strong></p>
        <ul>
          <p>High School Students $<? echo $hs_students ?>
          </p>
          <p>High School Diploma $<? echo $hs_diploma ?></p>

          <p>High School Transcript $<? echo $hs_transcript ?></p>

          <p>Consultations $<? echo $consultations ?></p>
          <p>             Replacement
            membership card $<? echo $card?> </p>
          <p>SCHEA discounted membership $<? echo $schea ?></p>
          <p>Enchanted Learning discounted membership $<? echo $enchanted ?> </p>
          <p>
            Expedite
            my Application Please $<? echo $expedite ?></p>
        </ul>

      </fieldset>

</body>
</html>
