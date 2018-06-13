<?php
  require 'config.php';
  require 'functions.php';
  // Start the session if it is not already started
  session_start();

  // Check if a user is logged in
  if(isset($_SESSION['uname']) && isset($_SESSION['pwd'])){
    // If they are logged in then run the template / function files to fill out the app
    run();
  } else {
    // If not logged in then render the login file
    readfile('./login.html');
  }
?>
