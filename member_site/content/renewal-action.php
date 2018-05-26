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

$con=mysqli_connect("127.0.0.1","root","newpassword","FaithfulScholars");
if(mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
};

$sql = "INSERT INTO family (first_name, last_name, phone, email, county, zip, city, address) 
                    VALUES('$first_name', '$last_name', '$phone', '$email', '$county', '$zipcode', '$city', '$address')";

if ($con->query($sql) === TRUE) {
  echo "New record created";
} else {
  echo "Error: " . $sql . "<br>" . $con->error;
}

?>
