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
$removing_ps=$_POST["removing_ps"];
$referred_by=$_POST["referred_by"];
$school_district=$_POST["school_district"];
$school_fax=$_POST["school_fax"];
$type=$_POST["type"];
$hs_students=$_POST["hs_students"];
$card="";
if(isset($_POST["card"])){
  $card=$_POST["card"];
}
$schea="";
if(isset($_POST["schea"])){
  $schea=$_POST["schea"];
}
$enchanted="";
if(isset($_POST["enchanted"])){
  $enchanted=$_POST["enchanted"];
}
$expedite="";
if(isset($_POST["expedite"])){
  $expedite=$_POST["expedite"];
}
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



if($new_hs == 'yes'){
  $new_hs = 1;
} else {
  $new_hs = 0;
}

$family_insert_sql = "INSERT INTO family (first_name, last_name, father_name, mother_name, address, city, zip, county, phone, mom_cell, dad_cell, email, new, district) VALUES ('$primary_instructor','$last_name', '$father', '$mother', '$address', '$city', '$zip', '$county', '$phone', '$cell_phone_mom', '$cell_phone_dad', '$email', $new_hs, '$school_district')";
$family_id = 0;
if($con->query($family_insert_sql) === TRUE) {
  $family_id = mysqli_insert_id($con);
} else {
  echo mysqli_error();
}

$con->query( "INSERT INTO members (id, username,psalt,password,email,family_id) VALUES
($family_id,'$username','$p_salt','$password','$email',$family_id);" );

$homeschool_insert_sql = "INSERT INTO homeschool(family_id, school_start_date, school_end_date, new_homeschool, years_homeschooling, primary_instructor, removing_public_school, referred_by, school_district, school_fax) VALUES ($family_id, '$start_date', '$end_date', $new_hs, $years_homeschooling, '$primary_instructor', '$removing_ps', '$referred_by', '$school_district', '$school_fax');";
$con->query($homeschool_insert_sql);

$typeprice = 0;
$membership = "";
if($type == "Kindergarten-Only"){
  $membership = $type;
  $type = 1;
  $typeprice = 25;
} else if ($type == "Single-Student"){
  $membership = $type;
  $type = 2;
  $typeprice = 35;
} else {
  $membership = "Multi-Student";
  $type = 3;
  $typeprice = 60;
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
    $student_insert_sql = "INSERT INTO student (family_id, name, grade, age, birthday, curriculum_desc)VALUES ($family_id, '${"student_".$i}', ${"student_".$i."_grade"}, ${"student_".$i."_age"}, '${"student_".$i."_birthdate"}', '${"curriculum_student".$i}');";
    $con->query($student_insert_sql);
  }
}

mysqli_close($con);

global $total;
$total = ($schea * 15) + ($enchanted * 10) + ($expedite * 20) + $typeprice + $hs_students;
?>
<?php
/*
* MailChimp Implementation
*/

session_start();
if(isset($_POST['Submit'])){
    $fname = $_POST["primary_instructor"];
    $lname = $_POST["last_name"];
    $email = $_POST['email'];
    $phone = $_POST["phone"];
    $address=$_POST["address"];

    if(!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL) === false){
        // MailChimp API credentials
        $apiKey = 'api-key-goes-here';
        $listID = 'lsit-id-goes-here';

        // MailChimp API URL
        $memberID = md5(strtolower($email));
        $dataCenter = substr($apiKey,strpos($apiKey,'-')+1);
        $url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $listID . '/members/' . $memberID;

        // member information
        $json = json_encode([
            'email_address' => $email,
            'status'        => 'subscribed',
            'merge_fields'  => [
                'FNAME'     => $fname,
                'LNAME'     => $lname,
                'PHONE'     => $phone,
                'ADDRESS'   => $address,

            ]
        ]);

        // send a HTTP POST request with curl
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $apiKey);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        // store the status message based on response code
        if ($httpCode == 200) {
            $_SESSION['msg'] = '<p style="color: #34A853">You have successfully subscribed to FaithfulScholars.</p>';
        } else {
            switch ($httpCode) {
                case 214:
                    $msg = 'You are already subscribed.';
                    break;
                default:
                    $msg = 'Some problem occurred, please try again.';
                    break;
            }
            $_SESSION['msg'] = '<p style="color: #EA4335">'.$msg.'</p>';
        }
    }else{
        $_SESSION['msg'] = '<p style="color: #EA4335">Please enter valid email address.</p>';
    }
}
// // redirect to homepage
// header('location:onlineapplication.html');
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
    <p> <?php echo $last_name?> Family,
    <p>Thank  you for joining Faithful Scholars; we look forward to serving your  family.  Below is a summary of what you have submitted to us. Please print a copy of this page to keep as a record of your membership until your membership packet arrives.  </p>
    <p> To complete your application, please click the "Pay Now" button to pay securely online through PayPal.  You do not have to have a PayPal account, and you can pay with any credit card. You may also pay by personal check, certified check, or money order.  Please mail payments to: Faithful Scholars, 1761 Ballard Lane, Fort Mill, SC 29715.  Your total payment to Faithful Scholars for this year will be $ <? echo $total ?>.</p>
    <?php if ($expedite == 1){ ?>
         <p>  You have chosen to expedite your application.  You are legal to homeschool as of the completion of submitting and paying for your application.  Your paperwork will be process, faxed and/or mailed out within 24 hours. </p>
         <? }
		   else { ?>
         <p>&nbsp; It will take us 3 to 30 days to fully process your paperwork  including mailouts.&nbsp; You are legal to homeschool as of the completion  of submitting/paying for your application.&nbsp; If there are any problems  with your application you will be notified within 7 days.&nbsp; If you need  your paperwork fully processed before this time, please hit the back arrow and re-submit your applicaton with expedited application option checked for an additional $20--which will have it processed,  faxed and/or mailed out within 24 hours.&nbsp;&nbsp;      </p>
         <?php } ?>
    <p>If you have any questions or comments about your application, please <a href="contact.html">contact us!</a></p>
    <div align="center">
      <p>

</p>
<table align="center"><tr><td>
	  <form action="https://www.paypal.com/cgi-bin/webscr" method="post"  target="_top"> <!-- Identify your business so that you can collect the payments. --> <input type="hidden" name="business" value="katie@faithfulscholars.com"> <!-- Specify a Buy Now button. --> <input type="hidden" name="cmd" value="_xclick"> <!-- Specify details about the item that buyers will purchase. --> <input type="hidden" name="item_name" value="Faithful Scholars Membership Fees - <?php echo $last_name ?>, <?php echo $membership?>" > <input type="hidden" name="amount" value="<?php echo $total ?>"> <input type="hidden" name="currency_code" value="USD"> <!-- Display the payment button. --> <input type="image" name="submit" border="0" src="http://www.faithfulscholars.com/images/paynow.jpg" alt="Faithful Scholars Checkout"> <img alt="" border="0" width="1" height="1" src="https://www.paypal.com/en_US/i/scr/pixel.gif" > </form></td></tr></table>

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
            <td width="120"><?php echo $last_name ?></td>
            <td width="226"><label for="new_fs">New to Faithful Scholars?</label></td>
            <td width="183"><?php echo $new_hs ?></td>
          </tr>
          <tr>
            <td><label for="Father2">Father's Name </label></td>
            <td><?php echo $father ?></td>
            <td><label for="phone2">Phone</label></td>
            <td><?php echo $phone?></td>
          </tr>
          <tr>
            <td><label for="mother">Mother's Name</label></td>
            <td><?php echo $mother?></td>
            <td><label>Cell Phone (Mom)</label></td>
            <td><?php echo $cell_phone_mom ?></td>
          </tr>
          <tr>
            <td><label for="address">Address</label></td>
            <td><?php echo $address?></td>
            <td><label>Cell Phone (Dad)</label></td>
            <td><?php echo $cell_phone_dad ?></td>
          </tr>
          <tr>
            <td><label for="city">City</label></td>
            <td><?php echo $city ?></td>
            <td><label>Email Address</label></td>
            <td><?php echo $email ?></td>
          </tr>
          <tr>
            <td><label for="zip">Zip</label></td>
            <td><?php echo $zip ?></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><label for="county">County</label></td>
            <td><?php echo $county ?></td>
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
            <td width="88"><?php echo $start_date ?></td>
            <td width="280"><label>New to Homeschooling?</label></td>
            <td width="140"><?php echo $new_hs ?></td>
          </tr>
          <tr>
            <td><label for="end_date">End of Year Date</label></td>
            <td><?php echo $end_date ?></td>
            <td><label>Years of homeschooling</label></td>
            <td><?php echo $years_homeschoooling ?></td>
          </tr>
          <tr>
            <td><label for="primary_instructor">Primary Instructor</label></td>
            <td><?php echo $primary_instructor ?></td>
            <td><label>States in which you've homeschooled</label></td>
            <td><?php echo $states_homeschooled ?></td>
          </tr>
          <tr>
            <td><label for="instructor_education">Level of Education</label></td>
            <td><?php echo $instructor_education ?></td>
            <td><label>Removing a child from Public School?</label></td>
            <td><?php echo $removing_ps ?></td>
          </tr>
          <tr>
            <td><label for="referred_by">Referred By</label></td>
            <td><?php echo $referred_by ?></td>
            <td><label>If yes, school name:</label></td>
            <td><?php echo $school_name ?></td>
          </tr>
          <tr>
            <td><label for="school_district">School District</label></td>
            <td><?php echo $school_district ?></td>
            <td><label>If yes, school fax #:</label></td>
            <td><?php echo $school_fax ?></td>
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
            <td><?php echo $student_1?></td>
            <td><?php echo $student_1_grade ?></td>
            <td><?php echo $student_1_age ?></td>
            <td><?php echo $student_1_birthdate ?></td>
          </tr>
          <tr>
            <td><?php echo $student_2 ?></td>
            <td><?php echo $student_2_grade ?></td>
            <td><?php echo $student_2_age ?></td>
            <td><?php echo $student_2_birthdate ?></td>
          </tr>
          <tr>
            <td><?php echo $student_3 ?></td>
            <td><?php echo $student_3_grade ?></td>
            <td><?php echo $student_3_age ?></td>
            <td><?php echo $student_3_birthdate ?></td>
          </tr>
          <tr>
            <td><?php echo $student_4 ?></td>
            <td><?php echo $student_4_grade ?></td>
            <td><?php echo $student_4_age ?></td>
            <td><?php echo $student_4_birthdate ?></td>
          </tr>
          <tr>
            <td><?php echo $student_5 ?></td>
            <td><?php echo $student_5_grade ?></td>
            <td><?php echo $student_5_age ?></td>
            <td><?php echo $student_5_birthdate ?></td>
          </tr>
          <tr>
            <td><?php echo $student_6 ?></td>
            <td><?php echo $student_6_grade ?></td>
            <td><?php echo $student_6_age ?></td>
            <td><?php echo $student_6_birthdate ?></td>
          </tr>
          <tr>
            <td><?php echo $student_7 ?></td>
            <td><?php echo $student_7_grade ?></td>
            <td><?php echo $student_7_age ?></td>
            <td><?php echo $student_7_birthdate ?></td>
          </tr>
          <tr>
            <td><?php echo $student_8 ?></td>
            <td><?php echo $student_8_grade ?></td>
            <td><?php echo $student_8_age ?></td>
            <td><?php echo $student_8_birthdate ?></td>
          </tr>
        </table>
        <p>&nbsp;</p>
      </fieldset>
      <fieldset>
        <legend> Membership Information </legend>
        <p><strong>Type of Membership: </strong></p>
        <ul>
          <p>
            <?php echo $membership ?>
          </p>
        </ul>
        <p><strong>Additions to your membership: </strong></p>
        <ul>
          <p>SCHEA discounted membership $<?php echo $schea * 15 ?></p>
          <p>Enchanted Learning discounted membership $<?php echo $enchanted * 10?> </p>
          <p>
            Expedite
            my Application Please $<?php echo $expedite * 20?></p>
        </ul>

      </fieldset>

</body>
</html>
