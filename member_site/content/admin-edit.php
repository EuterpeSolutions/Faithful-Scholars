<?php
session_start();
  require_once 'dbconfig.php';
  $con = db_connect();

  if (mysqli_connect_errno()) {
    die('<p>Failed to connect to MySQL: '.mysqli_connect_error().'</p>');
  }
  $selected_id = $_POST["selected_id"];

  $_SESSION['adminproxyid'] = $_POST['selected_id'];

  $sql="SELECT id, first_name, last_name, phone, email, address, city, zip, county FROM family WHERE id = ". $selected_id . ";";
  $last_name = "";
  $first_name = "";
  $phone = "";
  $email = "";
  $address = "";
  $zipcode = "";
  $city = "";

  $family_id = 0;

  if($result = mysqli_query($con, $sql)){
    while($row = mysqli_fetch_array($result)){
      $family_id = $row["id"];
      $last_name = $row["last_name"];
      $first_name = $row["first_name"];
      $phone = $row["phone"];
      $email = $row["email"];
      $address = $row["address"];
      $zipcode = $row["zip"];
      $city = $row["city"];
    }
  }

  $student_name = [];
  $student_grade = [];
  $student_birthday = [];

  $student_sql = "SELECT name, grade, birthday FROM student WHERE family_id = ". $selected_id;
  if($student_result = mysqli_query($con, $student_sql)){
    $count = 0;
    while($row = mysqli_fetch_array($student_result)){
      $student_name[$count] = $row["name"];
      $student_grade[$count] = $row["grade"];
      $student_birthday[$count] = $row["birthday"];
    }
  }
  global $students;
  $student_sql = "SELECT * FROM student WHERE family_id = " . $selected_id . ";";
  $students = array();
  if($student_result = mysqli_query($con, $student_sql)){
    while($row = mysqli_fetch_array($student_result)){
      array_push($students, $row);
    }
  }
?>
<form class="form-horizontal" method="post" action="?page=admin">
  <fieldset>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h4>User Documents</h4>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <a href="/member_site/content/membership-letter.php">Membership Letter</a>
          </div>
          <div class="col-md-4">
            <a href="/member_site/content/dmv-letter.php">DMV Letter</a>
          </div>
          <div class="col-md-4">
            <a href="/member_site/content/secondary-school.php">Secondary School</a>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <h4>User Edit</h4>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="hidden" name="original_last_name" id="original_last_name" value="<?php echo $selected_id?>">
              <label for="last_name">Last Name:</label>
              <input type="last_name" class="form-control" value="<?php echo htmlspecialchars($last_name)?>" name="last_name" id="last_name" placeholder="Enter name">
            </div>
            <div class="form-group">
              <label for="phone">Phone:</label>
              <input type="phone" class="form-control" value="<?php echo htmlspecialchars($phone)?>"name="phone" id="phone" placeholder="Enter name">
            </div>
            <div class="form-group">
              <label for="address">Address:</label>
              <input type="address" class="form-control" value="<?php echo htmlspecialchars($address)?>"name="address" id="address" placeholder="Enter address">
            </div>
            <div class="form-group">
              <label for="zip">Zipcode:</label>
              <input type="zip" class="form-control" value="<?php echo htmlspecialchars($zipcode)?>"name="zipcode" id="zip" placeholder="Enter zipcode">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="first_name">First Name:</label>
              <input type="first_name" class="form-control" value="<?php echo htmlspecialchars($first_name)?>"name="first_name" id="first_name" placeholder="Enter name">
            </div>
            <div class="form-group">
              <label for="email">E-mail:</label>
              <input type="email" class="form-control" value="<?php echo htmlspecialchars($email)?>"name="email" id="email" placeholder="Enter name">
            </div>
            <div class="form-group"><label for=""></label><br><br><label for=""></label></div>
            <div class="form-group">
              <label for="city">City:</label>
              <input type="city" class="form-control" value="<?php echo htmlspecialchars($city)?>"name="city" id="city" placeholder="Enter city" >
            </div>
          </div>
        </div>
        <br>
        <hr>
        <br>
        <div class="row">
          <div class="col-md-6">
            <?php echo childInput('name', $students)?>
          </div>
          <div class="col-md-2">
            <?php echo childInput('grade', $students)?>
          </div>
          <div class="col-md-4">
            <?php echo childInput('birthday', $students)?>
          </div>
        </div>
      </div>
    </fieldset>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <input class="btn btn-success" type="submit" name="submit" value="Submit" />
          </div>
        </div>
      </div>
    </div>
  </form>
