<?php
//personal information
$email = $_POST['email'];
$phone = $_POST['phone'];
$name = $_POST['name'];

//initials
$initial_1 = $_POST['initial1'];
$initial_2 = $_POST['initial2'];
$initial_3 = $_POST['initial3'];
$initial_4 = $_POST['initial4'];
$initial_5 = $_POST['initial5'];
$initial_6 = $_POST['initial6'];
$initial_7 = $_POST['initial7'];

//submission
if (isset($_POST['submit'])) {
  if(isset($_POST['submitted_worksheet']))
  {
    $submitted_worksheet = $_POST['submitted_worksheet'];  //  Displaying Selected Value
  }
}

//dual enrollment
if (isset($_POST['submit'])) {
  if(isset($_POST['dual_enrollment']))
  {
    $dual_enrollment = $_POST['dual_enrollment'];  //  Displaying Selected Value
  }
}

// Establish MySQL connection
$con=mysqli_connect("127.0.0.1","root","newpassword","FaithfulScholars");
if(mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
};

// Compliance Information
// SQL Queries //TODO: Replace with prepared statements after login is merged in
$family_id = 1;
$sql = "INSERT INTO eoy (family_id, initial_1, initial_2, initial_3, initial_4, initial_5,
                         initial_6, initial_7, submitted_worksheet, dual_enrollment)
                    VALUES('$family_id','$initial_1','$initial_2','$initial_3','$initial_4',
                           '$initial_5','$initial_6','$initial_7','$submitted_worksheet',
                            '$dual_enrollment')";
if ($con->query($sql) === TRUE) {
  echo "New record created<br>";
  $insert_id = mysqli_insert_id($con);
  echo $insert_id . "<br>";
} else {
  echo "Error: " . $sql . "<br>" . $con->error . "<br>";
}
?>
