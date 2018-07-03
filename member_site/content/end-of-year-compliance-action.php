<?php
require_once 'dbconfig.php';

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
$con = db_connect();

// Compliance Information
// SQL Queries //TODO: Replace with prepared statements after login is merged in
$family_id = $_SESSION['userid'];
$sql = "INSERT INTO eoy (family_id, initial_1, initial_2, initial_3, initial_4, initial_5,
  initial_6, initial_7, submitted_worksheet, dual_enrollment)
  VALUES('$family_id','$initial_1','$initial_2','$initial_3','$initial_4',
    '$initial_5','$initial_6','$initial_7','$submitted_worksheet',
    '$dual_enrollment')";
    if ($con->query($sql) === TRUE) {
      $insert_id = mysqli_insert_id($con);
    } else {
      echo "Error: " . $sql . "<br>" . $con->error . "<br>";
    }
    ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
      <title>Faithful Scholars - SC Accountability Association</title>
      <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
      <link rel="stylesheet" href="stylesheet.css" type="text/css" />
    </head>
    <body>
      <div id="container">
        <div id="header">
          <p align="center">&nbsp;</p>
        </div>
        <div id="content">
          <canvas id="display" width="1px" height="1px" tabindex="1"> </canvas>
          <h2>Thank you for completing your end of the year compliance form! </h2>
        </td>
      </tr>
    </table>
    <p>Thank you for submitting your compliance form online!</p>
    <p><strong>You have submitted the following information:</strong></p>
    <ul>
      <p>intitials to the following statements:</p>
      <p><?php echo $initial_1 ?>, I, the primary parent/guardian-instructor hold at least a high school diploma or GED.</p>
      <p><?php echo $initial_2 ?>, Student(s) has/have attended a minimum of 180 days of school which are recorded.</p>
      <p><?php echo $initial_3 ?>, I have maintained a plan book, journal <b>or</b> diary, <b><i>AND</i></b></p>
      <p><?php echo $initial_4 ?>, maintained a portfolio of academic work for each student, <b><i>AND</i></b></p>
      <p><?php echo $initial_5 ?>, I have completed, and have on file, a semi-annual progress report, <b><i>AND</i></b></p>
      <p><?php echo $initial_6 ?>, I have completed, and have on file, an end-of-year progress report, <b><i>AND</i></b></p>
      <p><?php echo $initial_7 ?>, I have taught reading, writing, math, science and social studies, including composition and literature in grades 7 through 12, to my students.</p>
      <br>
      <p>name: <?php echo $name ?></p>
      <p>email: <?php echo $email ?></p>
      <p>phone: <?php echo $phone ?></p>
      <p>
        <?php
        if($submitted_worksheet == 1) {
          echo "I have submitted my student's transcript worksheet by/before June 10th.";
        } else if ($submitted_worksheet == 0) {
          echo "I choose not to submit my student's transcript worksheet
          by/before June 10th and understand that it may affect his/her eligibility for scholarships.";
        }
        ?>
      </p>
      <p>
        <?php
        if($dual_enrollment == 1) {
          echo "Yes, my student plans to take dual enrollment classes either online or a local college.";
        } else if ($dual_enrollment == 0){
          echo "No, my student does not plan to take dual enrollment classes either online or a local college.";
        }
        ?>
      </p>
    </ul>
    <div align="center">
      <p></p>
    </div>
  </p>
  <p>&nbsp;</p>
  <div id="footer"></div>
</div>
</div>
</body>
</html>
