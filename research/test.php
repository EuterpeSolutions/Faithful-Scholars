<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>PHP Test</title>
  </head>
  <body>
    <?php
      $con = new mysqli("127.0.0.1", "root", "newpassword", "FaithfulScholars");
      $message = $con->query("SELECT message FROM myTable")->fetch_object()->message;
      $con->close();
      echo "$message <br/>";
      ?>
  </body>
</html>
