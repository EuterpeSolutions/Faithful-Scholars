<?php
  require 'config.php';
  require 'functions.php';
  require_once 'dbconfig.php';
  // Start the session if it is not already started
  session_start();

  $check = checkLogin($_SESSION['userid']);

  if($check == 1){
    run();
  }else {
    readfile('./login.html');
  }

?>
