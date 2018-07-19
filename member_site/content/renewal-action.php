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

// nameren
$name1=$_POST["name1"];
$grade1=$_POST["grade1"];
$birthdate1=$_POST["birthday1"];
$name2=$_POST["name2"];
$grade2=$_POST["grade2"];
$birthdate2=$_POST["birthday2"];
$name3=$_POST["name3"];
$grade3=$_POST["grade3"];
$birthdate3=$_POST["birthday3"];
$name4=$_POST["name4"];
$grade4=$_POST["grade4"];
$birthdate4=$_POST["birthday4"];
$name5=$_POST["name5"];
$grade5=$_POST["grade5"];
$birthdate5=$_POST["birthday5"];
$name6=$_POST["name6"];
$grade6=$_POST["grade6"];
$birthdate6=$_POST["birthday6"];
$name7=$_POST["name7"];
$grade7=$_POST["grade7"];
$birthdate7=$_POST["birthday7"];
$name8=$_POST["name8"];
$grade8=$_POST["grade8"];
$birthdate8=$_POST["birthday8"];
$name9=$_POST["name9"];
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

require_once "dbconfig.php";

$con = db_connect();

// Family Information
$sql = "UPDATE family SET first_name = '$first_name', last_name = '$last_name', phone = '$phone', email = '$email', county = '$county', zip = '$zipcode', city = '$city', address = '$address' WHERE id =".$_SESSION['userid'].";";
$insert_id = 0;
if(!($con->query($sql) == true)){
  echo "Error2: " . $sql . "</br>" . $con->error;
}
$sql_delete_students = "DELETE FROM student WHERE family_id = " . $_SESSION['userid'] . ";";
$con->query($sql_delete_students);
// Student Information
for($i = 1; $i < 9; $i++){
  if(${"name" . $i} != ''){
    $sql_student = "INSERT INTO student (family_id, name, grade, birthday) VALUES ('" . $_SESSION['userid'] . "','${"name" . $i}','${"grade" . $i}','${"birthdate" . $i}')";
    if ($con->query($sql_student) === TRUE) {
    } else {
      echo "Error: " . $sql . "<br>" . $con->error;
    }
  }
}

// Membership Information
$type = (int)$optradio;
$highschool = (int)$high_school_number;
$sql_membership = "UPDATE membership SET type_id = '$type', highschool = '$highschool', replacement_card = '$replacement', schea = '$schea', enchanted_learning = '$el', expedited = '$expedite', initial_1 = '$initial1', initial_5 = '$initial5', initial_6 = '$initial6' WHERE family_id = ".$_SESSION['userid'].";";
if ($con->query($sql_membership) === TRUE) {
} else {
 echo "Error: " . $sql_membership . "<br>" . $con->error . "<br>";
}

// Calculate membership fees
// Base
$total = 0;
$type_full = "";
$type_price = 0;
// Membership Fee
switch($type) {
  case 1: // Kindergarten
    $total += 25;
    $type_full = "Kindergarten only membership";
    $type_price = 25;
    break;
  case 2: // Single-student
    $total += 35;
    $type_full = "Single-student family membership";
    $type_price = 35;
    break;
  case 3: // Multi-student
    $total += 60;
    $type_full = "Multi-student family membership";
    $type_price = 60;
    break;
}

// Number of high school students
$total += ($highschool * 75);

// Additions
if($replacement == "1"){
  $total += 3;
}
if($schea == "1"){
  $total += 15;
}
if($el == "1"){
  $total += 7;
}
if($expedite == "1"){
  $total += 20;
}
?>
<br><br><br><br><br><br>
<h2 class="center">Thank you for renewing your membership! </h2>
<p class="center"> <?php echo $first_name; ?> <?php echo $last_name?>,  <?php echo $type_full?></p>
<br><br><br><br><br><br>
Please pay for your membership via the Paypal button below, or by mailing a check to Faithful Scholars, 1761 Ballard Ln, Fort Mill, SC 29715.  Note that if you are mailing a check, your membership renewal will not be considered complete until your check clears.  <br />
<br>
<h3 class="center">Amount Due: $<?php echo $total?></h3>
<form class="center" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top"> <!-- Identify your business so that you can collect the payments. --> <input type="hidden" name="business" value="katie@faithfulscholars.com"> <!-- Specify a Buy Now button. --> <input type="hidden" name="cmd" value="_xclick"> <!-- Specify details about the item that buyers will purchase. --> <input type="hidden" name="item_name" value="Faithful Scholars Membership Fees - <? echo $last_name ?>, <? echo $type_full?>" > <input type="hidden" name="amount" value="<? echo $total ?>"> <input type="hidden" name="currency_code" value="USD"> <!-- Display the payment button. --> <input type="image" name="submit" border="0" src="http://www.faithfulscholars.com/images/paynow.jpg" alt="Faithful Scholars Checkout"> <img alt="" border="0" width="1" height="1" src="https://www.paypal.com/en_US/i/scr/pixel.gif" > </form>
<br>
<p>You have chosen to receive your membership information by <? echo $membership_documents?>.    </p>
<p><strong>Type of membership:</strong> <?php echo $type_full ?> - $<?php echo $type_price?></p>

<?php
  if($highschool > 0 || $schea == "1" || $el == "1" || $expedite == "1"){
    echo "<p><strong>Additions to your membership: </strong> </p><ul>";
    if($replacement == "1"){ echo "<p> Replacement Membership Card - $3";}
    if($highschool > 0){ echo "<p> High school students  &nbsp; - $" . ($highschool * 75) . "</p>";}
    if($schea == "1"){ echo "<p><a href=\"http://www.schomeeducatorsassociation.org/\" target=\"_blank\">SCHEA</a> discounted membership - $15</p>";}
    if($el == "1"){ echo "<p><a href=\"http://www.enchantedlearning.com/\" target=\"_blank\">Enchanted Learning</a> discounted membership&nbsp;- $7</p>";}
    if($expedite == "1"){echo "<p>Expedited renewal - $20</p>";}
    echo "</ul>";
  }

?>
<p>If you have a high school student and need to submit your transcript information, you can do so with either the  <a href="transcript_input.html">Faithful Scholars Electronic Transcript Worksheet</a> or a <a href="transcriptform.pdf">Faithful Scholars Paper Transcript Worksheet.</a>
</p>
