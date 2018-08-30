 <?php
 function checkPostParams($param) {
   if(isset($_POST[$param])){
     return $_POST[$param];
   } else {
     return "";
   }
 }
$last_name=checkPostParams("last_name");
$new_fs=checkPostParams("new_fs");
$father=checkPostParams("father");
$mother=checkPostParams("mother");
$address=checkPostParams("address");
$city=checkPostParams("city");
$zip=checkPostParams("zip");
$county=checkPostParams("county");
$phone=checkPostParams("phone");
$cell_phone_mom=checkPostParams("cell_phone_mom");
$cell_phone_dad=checkPostParams("cell_phone_dad");
$email=checkPostParams("email");
$start_date=checkPostParams("start_date");
$new_hs=checkPostParams("new_hs");
$end_date=checkPostParams("end_date");
$years_homeschooling=checkPostParams("years_homeschooling");
$primary_instructor=checkPostParams("primary_instructor");
$removing_ps=checkPostParams("removing_ps");
$referred_by=checkPostParams("referred_by");
$school_district=checkPostParams("school_district");
$school_fax=checkPostParams("school_fax");
$type=checkPostParams("type");
$hs_students=checkPostParams("hs_students");
$schea=checkPostParams("schea");
$enchanted=checkPostParams("enchanted");
$expedite=checkPostParams("expedite");
$certify_curriculum=checkPostParams("certify_curriculum");
$certify_diploma=checkPostParams("certify_diploma");
$certify_hs_transcript=checkPostParams("certify_hs_transcript");
$certify_hs_gpa=checkPostParams("certify_hs_gpa");
$certify_laws=checkPostParams("certify_laws");
$certify_bylaws=checkPostParams("certify_bylaws");
$student_1=checkPostParams("student_1");
$student_1_grade=checkPostParams("student_1_grade");
$student_1_age=checkPostParams("student_1_age");
$student_1_birthdate=checkPostParams("student_1_birthdate");
$student_2=checkPostParams("student_2");
$student_2_grade=checkPostParams("student_2_grade");
$student_2_age=checkPostParams("student_2_age");
$student_2_birthdate=checkPostParams("student_2_birthdate");
$student_3=checkPostParams("student_3");
$student_3_grade=checkPostParams("student_3_grade");
$student_3_age=checkPostParams("student_3_age");
$student_3_birthdate=checkPostParams("student_3_birthdate");
$student_4=checkPostParams("student_4");
$student_4_grade=checkPostParams("student_4_grade");
$student_4_age=checkPostParams("student_4_age");
$student_4_birthdate=checkPostParams("student_4_birthdate");
$student_5=checkPostParams("student_5");
$student_5_grade=checkPostParams("student_5_grade");
$student_5_age=checkPostParams("student_5_age");
$student_5_birthdate=checkPostParams("student_5_birthdate");
$student_6=checkPostParams("student_6");
$student_6_grade=checkPostParams("student_6_grade");
$student_6_age=checkPostParams("student_6_age");
$student_6_birthdate=checkPostParams("student_6_birthdate");
$student_7=checkPostParams("student_7");
$student_7_grade=checkPostParams("student_7_grade");
$student_7_age=checkPostParams("student_7_age");
$student_7_birthdate=checkPostParams("student_7_birthdate");
$student_8=checkPostParams("student_8");
$student_8_grade=checkPostParams("student_8_grade");
$student_8_age=checkPostParams("student_8_age");
$student_8_birthdate=checkPostParams("student_8_birthdate");
$curriculum_student1=checkPostParams("curriculum_student1");
$curriculum_student2=checkPostParams("curriculum_student2");
$curriculum_student3=checkPostParams("curriculum_student3");
$curriculum_student4=checkPostParams("curriculum_student4");
$curriculum_student5=checkPostParams("curriculum_student5");
$curriculum_student6=checkPostParams("curriculum_student6");
$curriculum_student7=checkPostParams("curriculum_student7");
$curriculum_student8=checkPostParams("curriculum_student8");


// Connect to server and select databse.
require '../member_site/dbconfig.php';
$con = db_connect();
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

if($new_hs == 'yes'){
  $new_hs = 1;
} else {
  $new_hs = 0;
}

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
  $schea_set = 1;
} else {
  $schea_set = 0;
}

if(isset($enchanted)){
  $enchanted_set = 1;
} else {
  $enchanted_set = 0;
}

if(isset($card)){
  $card_set = 1;
} else {
  $card_set = 0;
}

if(isset($expedite)){
  $expedite_set = 1;
} else {
  $expedite_set = 0;
}

$family_id = 0;
$user_sql = "CALL insertUser('$primary_instructor','$last_name', '$father', '$mother', '$address', '$city', '$zip', '$county', '$phone', '$cell_phone_mom', '$cell_phone_dad', '$email', $new_hs, '$school_district','$username','$p_salt','$password','$start_date', '$end_date', $new_hs, $years_homeschooling, '$primary_instructor', '$removing_ps', '$referred_by', '$school_district', '$school_fax', $type, $hs_students, $schea_set, $enchanted_set, $expedite_set, '$certify_curriculum', '$certify_diploma', '$certify_hs_transcript', '$certify_hs_gpa', '$certify_laws', '$certify_bylaws');";

$result = mysqli_query($con, $user_sql) or die("Invalid insert " . mysqli_error($con));
while($row = mysqli_fetch_array($result)){
  if(isset($row['MYSQL_ERROR'])){
    echo "An unexpected error has occurred during submission. Please try again later and if you continue to see this error email katie@faithfulscholars.com with the error code 'app1'.";
  }
  if(isset($row['new_family_id'])){
    $family_id = $row['new_family_id'];
  }

}
mysqli_close($con);

for($i = 1; $i <= 9; $i++){
  if(isset(${"student_".$i})){
    $con = db_connect();
    $sql = "CALL insertStudent($family_id, '${"student_".$i}', '${"student_".$i."_grade"}', ${"student_".$i."_age"}, '${"student_".$i."_birthdate"}', '${"curriculum_student".$i}');";
    $result = mysqli_query($con, $sql);
    if($result){
      while($row = mysqli_fetch_array($result)){
        if(isset($row['MYSQL_ERROR'])){
          echo "An unexpected error has occurred during submission. Please try again later and if you continue to see this error email katie@faithfulscholars.com with the error code 'app2'.";
        }
      }
    }
  }
}

mysqli_close($con);

global $total;
try{
  if(isset($schea) && isset($enchanted) && isset($expedite)){
    $total = $schea + $enchanted + $expedite + $typeprice + $hs_students;
  }else {
    $total = $typeprice + $hs_students;
  }

} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}


/*
*
*/
$message = "
<html><head><link rel='stylesheet' type='text/css' href='http://www.faithfulscholars.com/stylesheet.css'>
<body>
<fieldset><legend> Family Information </legend>
    <table width='700' border='0'>
            <tr> <td><label for='last_name'>Last Name</label></td>
              <td>$last_name </td>
              <td><label for='new_fs'>New to Faithful Scholars?</label></td>
              <td> $new_hs </td></tr>
            <tr><td><label for='Father2'>Fathers Name </label>'</td>
              <td> $father  </td>
              <td><label for='phone2'>Phone</label></td>
              <td> $phone </td></tr>
            <tr><td><label for='mother'>Mother's Name</label></td>
              <td> $mother </td>
              <td><label>Cell Phone (Mom)</label></td>
              <td> $cell_phone_mom  </td></tr>
            <tr><td><label for='address'>Address</label></td>
              <td> $address </td>
              <td><label>Cell Phone (Dad)</label></td>
              <td> $cell_phone_dad  </td> </tr>
            <tr> <td><label for='city'>City</label></td>
              <td> $city  </td>
              <td><label>Email Address</label></td>
              <td> $email  </td></tr>
            <tr> <td><label for='zip'>Zip</label></td>
              <td> $zip  </td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr><tr> <td><label for='county'>County</label></td>
              <td> $county  </td>
              <td>&nbsp;</td>
              <td>&nbsp;</td> </tr> </table><p>&nbsp;</p></fieldset>
        <fieldset><legend> Homeschool Information </legend>
          <table width='700' border='0'>
            <tr> <td><label for='start_date'>School Year Start Date</label></td>
              <td> $start_date  </td>
              <td><label>New to Homeschooling?</label></td>
              <td> $new_hs  </td></tr>
            <tr> <td><label for='end_date'>End of Year Date</label></td>
              <td> $end_date  </td>
              <td><label>Years of homeschooling</label></td>
              <td> $years_homeschoooling  </td> </tr>
            <tr><td><label for='primary_instructor'>Primary Instructor</label></td>
              <td> $primary_instructor  </td>
              <td><label></label></td>
              <td>   </td></tr>
            <tr> <td><label for='instructor_education'>Level of Education</label></td>
              <td> $instructor_education  </td>
              <td><label>Removing a child from SC Public School?</label></td>
              <td> $removing_ps  </td> </tr>
            <tr><td><label for='referred_by'>Referred By</label></td>
              <td> $referred_by  </td>
              <td><label>If yes, school name:</label></td>
              <td> $school_name  </td></tr>
            <tr> <td><label for='school_district'>School District</label></td>
              <td> $school_district  </td>
              <td><label>If yes, school fax #:</label></td>
              <td> $school_fax  </td></tr> </table>
          <p>&nbsp;</p> </fieldset></body></html>
     <fieldset><legend> Student Information </legend>
          <table width='600' border='1' cellpadding='3' cellspacing='0'>
            <tr> <td>Student Name</td>
              <td>Grade</td>
              <td>Age</td>
              <td>Birthdate (M / D / Y)</td>
              <td>Briefly Describe Curriculum</td></tr>
            <tr><td>$student_1</td>
              <td> $student_1_grade  </td>
              <td> $student_1_age  </td>
              <td> $student_1_birthdate  </td>
              <td> $curriculum_student1 </td>
            </tr>
            <tr> <td>$student_2</td>
              <td> $student_2_grade  </td>
              <td> $student_2_age  </td>
              <td> $student_2_birthdate  </td>
               <td> $curriculum_student2 </td></tr>
            <tr><td>$student_3</td>
              <td> $student_3_grade  </td>
              <td> $student_3_age  </td>
              <td> $student_3_birthdate  </td>
              <td> $curriculum_student3 </td> </tr>
            <tr><td>$student_4</td>
              <td> $student_4_grade  </td>
              <td> $student_4_age  </td>
              <td> $student_4_birthdate  </td>
               <td> $curriculum_student4 </td></tr>
            <tr><td>$student_5</td>
              <td> $student_5_grade  </td>
              <td> $student_5_age  </td>
              <td> $student_5_birthdate  </td>
              <td> $curriculum_student5 </td></tr>
            <tr> <td>$student_6</td>
              <td> $student_6_grade  </td>
              <td> $student_6_age  </td>
              <td> $student_6_birthdate  </td>
               <td> $curriculum_student6 </td></tr>
            <tr> <td>$student_7</td>
              <td> $student_7_grade  </td>
              <td> $student_7_age  </td>
              <td> $student_7_birthdate  </td>
               <td> $curriculum_student7</td></tr>
            <tr><td>$student_8</td>
              <td> $student_8_grade  </td>
              <td> $student_8_age  </td>
              <td> $student_8_birthdate  </td>
              <td> $curriculum_student8 </td> </tr> </table><p>&nbsp;</p> </fieldset>
        <fieldset><legend> Membership Information </legend>
          <p><strong>Type of Membership: </strong></p>
          <ul><p> $type  </p> </ul>
          <p><strong>Additions to your membership: </strong></p>
          <ul><p>High School Students $ $hs_students  </p>
            <p>High School Diploma $ $hs_diploma  </p>
            <p>High School Transcript $ $hs_transcript  </p>
            <p>Consultations $ $consultations  </p>
            <p>             Replacement membership card $ $card  </p>
            <p>SCHEA discounted membership $ $schea  </p>
            <p>Enchanted Learning discounted membership $ $enchanted   </p>
            <p>Expedite my Application Please $ $expedite  </p></ul>
              <h2><strong><u>INITIAL APPLICABLE BOXES FOR APPLICATION  PROCESS TO BE COMPLETED</u></strong></h2>
  <p>$certify_curriculum I have included each child&rsquo;s curriculum plan for this year.</p>
  <p>$certify_diploma I have a copy of my diploma or certificate on file at  home.</p>
  <p>$certify_hs_transcript (if applicable)I have sent/faxed a copy of my <em><strong>high school</strong></em> students transcripts. </p>
  <p>$certify_hs_gpa  (if applicable) I understand that I am expected to submit my <em><strong>high school</strong></em> student&rsquo;s GPA by June 1st or he/she will be assigned a  2.0 GPA for purposes of scholarship ranking (once grades are submitted, the student's actual GPA will replace the 2.0).</p>
  <p>$certify_laws    I have read and understood the homeschool  laws of <a href='legal.html'>SC section 59-65-47</a> and agree to abide by them, maintaining and make  available all&nbsp;legally required home school records for review  by a member of Faithful Scholars and/or the State Board of Education.</p>
  <p>$certify_bylaws    I have read, and agree to comply with all of  the <a href='bylaws.html'>Bylaws and Expectations</a> as set forth by Faithful Scholars.<br />
  </p></fieldset></body></html>
";

// set the to and from for the e-mail
$to      = "katie@faithfulscholars.com, forms@faithfulscholars.com";
$from    = "katie@faithfulscholars.com";
$subject = "";

if(isset($expedite) || $expedite != "") {
  $subject = "EXPEDITED APPLICATION - Online Application Form for $last_name  $warning";
} else {
  $subject = "Online Application Form for $last_name  $warning";
}

$headers = "From: $from \r\n";
$headers .= "Reply-To: $from \r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$ok = @mail($to, $subject, $message, $headers);

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

    <h2>Thank you! </h2>
    <p> <?php echo $last_name?> Family,
    <p>Thank you for joining our wonderful group of Faithful Scholars, 3rd Option Accountability Association.
      We look forward to serving your family with the goals of guiding and educating you in your administrative
      duties while supporting and encouraging you as you teach.  As of the moment of payment, you became a
      legal SC homeschooler. Your application will be reviewed and processed within the week. </p>
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
          <?php
            if(isset($schea) && $schea != ""){
              echo "<p>SCHEA discounted membership $" . $schea . "</p>";
            }

            if(isset($enchanted) && $enchanted != ""){
              echo "<p>Enchanted Learning discounted membership $" . $enchanted . "</p>";
            }

            if(isset($expedite) && $expedite != ""){
              echo "<p>Expedite my Application $" . $expedite . "</p>";
            }
          ?>
        </ul>
      </fieldset>
</body>
</html>
