<html>
<body>
  Name: <?php echo $_POST["name"]; ?><br>
  Your email address is: <?php echo $_POST["email"]; ?><br>
  Your phone number is: <?php echo $_POST["phone"]; ?><br>
  You have selected :
  <?php
  if (isset($_POST['submit'])) {
    if(isset($_POST['gridRadios']))
    {
      echo $_POST['gridRadios'];  //  Displaying Selected Value
    }
  }
  ?><br>
  You have selected :
  <?php
  if (isset($_POST['submit'])) {
    if(isset($_POST['options']))
    {
      echo $_POST['options'];  //  Displaying Selected Value
    }
  }
  ?><br>
  You have selected :
  <?php
  if (isset($_POST['submit'])) {
    if(isset($_POST['optionsRadios']))
    {
      if($_POST['optionsRadios'] == "school name") {
        echo $_POST['optionsRadios'] . " : " . $_POST["school"];
      } else {
        echo $_POST['optionsRadios'];  //  Displaying Selected Value
      }
    }
  }
  ?>
</body>
</html>
