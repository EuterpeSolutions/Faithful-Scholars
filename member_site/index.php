<?php
  require 'config.php';
  require 'functions.php';
  require_once 'dbconfig.php';
  // Start the session if it is not already started
  session_start();

  $con = db_connect();
  $sql = "SELECT approved FROM members WHERE family_id = " . $_SESSION['userid'] . ";";
  if($stmt = $con->prepare($sql))
  {
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($count);
    while($stmt->fetch()){
      $approved_value = $approved;
    }
  }
  // Check if a user is logged in
  if($approved_value = 1 && isset($_SESSION['uname']) && isset($_SESSION['pwd'])){
    // If they are logged in then run the template / function files to fill out the app
    run();
  } else {
    // If not logged in then render the login file
    readfile('./login.html');
  }
?>
