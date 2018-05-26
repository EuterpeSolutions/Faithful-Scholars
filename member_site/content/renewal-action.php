<?php
$last_name='';
if (empty($_POST["last_name"])) {
  echo "no last name";
} else {
  $last_name=$_POST["last_name"];
};
$first_name=$_POST["first_name"];



$con=mysqli_connect("127.0.0.1","root","newpassword","FaithfulScholars");
if(mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
};

$sql = "INSERT INTO family(last_name, first_name)VALUES('$last_name', '$first_name')";

if ($con->query($sql) === TRUE) {
  echo "New record created";
} else {
  echo "Error: " . $sql . "<br>" . $con->error;
  echo $first_name . ' ' . $last_name;
}

?>
