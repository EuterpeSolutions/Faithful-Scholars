<?php
  require '../dbconfig.php';
  $last_name = $_POST["edit"];

  $con=db_connect();
  
  $sql="SELECT id, first_name, last_name, phone, email, address, city, zip, county FROM family WHERE last_name = '$last_name'";
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

  $student_sql = "SELECT name, grade, birthday FROM student WHERE family_id = ".$family_id;
  if($student_result = mysqli_query($con, $student_sql)){
    $count = 0;
    while($row = mysqli_fetch_array($student_result)){
      $student_name[$count] = $row["name"];
      $student_grade[$count] = $row["grade"];
      $student_birthday[$count] = $row["birthday"];
    }
  }
?>
<form class="form-horizontal" method="post" action="?page=admin">
  <fieldset>
    <legend> Membership Renewal </legend>
      <div class="container">
        <div class="row">
          <input type="text" class="form-control" value="<?php echo $last_name;?>" name="original_last_name">
          <div class="col-md-6">
            <div class="form-group">
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
            <?php echo childInput('child', $student_name)?>
          </div>
          <div class="col-md-2">
            <?php echo childInput('grade', $student_grade)?>
          </div>
          <div class="col-md-4">
            <?php echo childInput('birthday', $student_birthday)?>
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
