<?php
session_start();
  require_once 'dbconfig.php';
  $con = db_connect();

  if (mysqli_connect_errno()) {
    die('<p>Failed to connect to MySQL: '.mysqli_connect_error().'</p>');
  }
  global $selected_id;
  $selected_id = $_POST["selected_id"];

  $_SESSION['adminproxyid'] = $_POST['selected_id'];
  $sql="SELECT family.id, mother_name, father_name, first_name, last_name, district, phone, family.email, address, city, zip, county, username FROM family JOIN members ON family.id = members.family_id WHERE family.id = ". $selected_id . ";";
  $last_name = "";
  $first_name = "";
  $phone = "";
  $email = "";
  $address = "";
  $zipcode = "";
  $district = "";
  $city = "";
  $username = "";
  $mother_name = "";
  $father_name = "";

  $family_id = 0;

  if($result = mysqli_query($con, $sql)){
    while($row = mysqli_fetch_array($result)){
      $family_id = $row["id"];
      $last_name = $row["last_name"];
      $first_name = $row["first_name"];
      $mother_name = $row["mother_name"];
      $father_name = $row["father_name"];
      $phone = $row["phone"];
      $email = $row["email"];
      $address = $row["address"];
      $zipcode = $row["zip"];
      $district = $row["district"];
      $city = $row["city"];
      $username = $row["username"];
    }
  }

  $student_id = [];
  $student_name = [];
  $student_grade = [];
  $student_birthday = [];

  $student_sql = "SELECT id, name, grade, birthday FROM student WHERE family_id = ". $selected_id;
  if($student_result = mysqli_query($con, $student_sql)){
    $count = 0;
    while($row = mysqli_fetch_array($student_result)){
      $student_id[$count] = $row["id"];
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

  if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['approved_btn']))
  {
      func($_POST['approved_btn']);
  }
  if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['delete_btn']))
  {
      deleteFunc($_POST['delete_btn']);
  }
  function func($id)
  {
      $con = db_connect();
      $update_sql = "UPDATE members SET approved = 1 WHERE family_id = $id";
      $con->query($update_sql);
      echo "Marked as paid!";
  }
  function deleteFunc($id){
      $con = db_connect();
      $update_sql = "DELETE FROM family WHERE id = $id";
      $con->query($update_sql);
  }
?>
<div class="container">
  <div class="col-md-12">
    <form action="?page=admin-edit" method="post">
      <?php
        $con = db_connect();
        $sql_check = "SELECT approved FROM members WHERE family_id = $selected_id";
        if($check_result = mysqli_query($con, $sql_check)){
          while($row = mysqli_fetch_array($check_result)){
            if($row['approved'] == 0){
              echo "<button class='btn btn-danger' name='approved_btn' value='$selected_id'>Mark as Paid</button>";
            } else {
              echo "<p>Marked as paid!</p>";
            }
          }
        }
      ?>
    </form>
  </div>
</div>

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
            <a href="/member_site/content/membership-letter.php" target="_blank">Membership Letter</a>
          </div>
          <div class="col-md-4">
            <a href="/member_site/content/dmv-letter.php" target="_blank">DMV Letter</a>
          </div>
          <div class="col-md-4">
            <a href="/member_site/content/secondary-school.php" target="_blank">Secondary School</a>
          </div>
        </div>
        <br><br>
        <div class="row">
          <div class="col-md-12">
            <h4>User Edit</h4>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-md-6" style="margin-top:9px;">
            <div class="form-group">
              <label for="username_field">Username:</label>
              <p><?php echo htmlspecialchars($username)?></p>
            </div>
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
              <label for="mother_name">Mothers Name:</label>
              <input type="mother_name" class="form-control" value="<?php echo htmlspecialchars($mother_name)?>"name="mother_name" id="mother_name" placeholder="Enter name">
            </div>
            <div class="form-group">
              <label for="father_name">Fathers Name:</label>
              <input type="father_name" class="form-control" value="<?php echo htmlspecialchars($father_name)?>"name="father_name" id="father_name" placeholder="Enter name">
            </div>
            <div class="form-group">
              <label for="email">E-mail:</label>
              <input type="email" class="form-control" value="<?php echo htmlspecialchars($email)?>"name="email" id="email" placeholder="Enter name">
            </div>
            <div class="form-group">
              <label for="district">District:</label>
              <input type="district" class="form-control" value="<?php echo htmlspecialchars($district)?>"name="district" id="district" placeholder="Enter district" >
            </div>
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
      <div class="col-md-6">
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <input class="btn btn-success" type="submit" name="submit" value="Submit" />
          </div>
        </div>
      </div>
      <div class="col-md-6">

      </div>
    </div>
  </form>
  <form action="?page=admin-edit" method="post">
    <button onclick="return confirm('Are you sure that you sent off the SCHEA information? This action cannot be undone.')" class='btn btn-danger' name='delete_btn' value='<?php global $selected_id; echo $selected_id; ?>' style="float:right;">Delete User </button><br><br>
    <p style="float:right;">(Warning this actioncannot be undone)</p>
  </form>
