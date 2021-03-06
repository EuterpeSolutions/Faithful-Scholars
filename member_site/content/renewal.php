<?php
  require_once "dbconfig.php";

  $con = db_connect();


  $check_sql = "SELECT count(id) as count from eoy WHERE family_id = ". $_SESSION['userid'] . " AND YEAR(last_updated_at) = YEAR(CURRENT_TIMESTAMP);";
  if($result = mysqli_query($con, $check_sql)){
    while($row = mysqli_fetch_array($result)){
      if($row['count'] == 0) {
        header('Location: /member_site/?page=no-end-of-year');
      }
    }
  }

  global $last_name, $first_name, $email, $phone, $address, $city, $zipcode, $county, $school_district, $students;

  $sql = "SELECT * FROM family as f JOIN members as m ON f.id = m.family_id JOIN homeschool as h ON h.family_id = f.id WHERE username LIKE '%". $_SESSION['uname']."%'";
  if($result = mysqli_query($con, $sql)){
    while($row = mysqli_fetch_array($result)){
      $last_name = $row["last_name"];
      $first_name = $row["first_name"];
      $email = $row["email"];
      $phone = $row["phone"];
      $address = $row["address"];
      $city = $row["city"];
      $zipcode = $row["zip"];
      $county = $row["county"];
      $school_district = $row["district"];
    }
  }


  $student_sql = "SELECT * FROM student WHERE family_id = " . $_SESSION['userid'] . ";";
  $students = array();
  if($student_result = mysqli_query($con, $student_sql)){
    while($row = mysqli_fetch_array($student_result)){
      array_push($students, $row);
    }
  }
?>

<form class="form-horizontal" method="post" action="?page=renewal-action">
  <fieldset>
    <legend> </legend>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <p>In order to renew your Faithful Scholars membership please review the following information to make sure that it is still valid. Then initial the compliance boxes and select any additions to your membership that you want to add then click the the submit button.</p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="last_name">Last Name:</label>
              <input tabindex="1" type="last_name" class="form-control" name="last_name" id="last_name" value="<?php echo $last_name ?>">
            </div>
            <div class="form-group">
              <label for="spouse">Spouse:</label>
              <input tabindex="3" type="spouse" class="form-control" name="spouse" id="spouse" placeholder="Enter name">
            </div>
            <div class="form-group">
              <label for="phone">Phone:</label>
              <input tabindex="5" type="phone" class="form-control" name="phone" id="phone" value="<?php echo $phone?>" placeholder="Enter name">
            </div>
            <div class="form-group">
              <label for="address">Address:</label>
              <input tabindex="7" type="address" class="form-control" name="address" id="address" value="<?php echo $address?>" placeholder="Enter address">
            </div>
            <div class="form-group">
              <label for="zip">Zipcode:</label>
              <input tabindex="9" type="zip" class="form-control" name="zipcode" id="zip" value="<?php echo $zipcode?>" placeholder="Enter zipcode">
            </div>
            <div class="form-group">
              <label for="district">School District: (<a href="http://ed.sc.gov/schools/" target="_blank">Look it up</a>)</label>
              <select tabindex="11" class="form-control" name="district" id="district">
                <?php generateSchoolDisctrict($school_district)?>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="first_name">First Name:</label>
              <input tabindex="2" type="first_name" class="form-control" name="first_name" id="first_name" value="<?php echo $first_name ?>" placeholder="Enter name">
            </div>
            <div class="form-group">
              <label for="email">E-mail:</label>
              <input tabindex="4" type="email" class="form-control" name="email" id="email" value="<?php echo $email ?>" placeholder="Enter name">
            </div>
            <div class="form-group"><label for=""></label><br><br><label for=""></label></div>
            <div class="form-group">
              <label for="city">City:</label>
              <input tabindex="6" type="city" class="form-control" name="city" id="city" value="<?php echo $city ?>" placeholder="Enter city" >
            </div>
            <div class="form-group">
              <label for="county">County:</label>
              <?php echo $county ?>
              <select tabindex="8" class="form-control" name="county" id="county" required>
                <?php generateCounty($county); ?>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="exampleFormControlTextarea1">Please list any additional changes to your current information:</label>
              <textarea tabindex="12" class="form-control" name="extra_information" id="exampleFormControlTextarea1" rows="3" ></textarea>
            </div>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-md-6">
            <?php echo childInput('name', $students,13)?>
          </div>
          <div class="col-md-2">
            <?php echo childInput('grade', $students, 14)?>
          </div>
          <div class="col-md-4">
            <?php echo childInput('birthday', $students, 15)?>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="exampleFormControlTextarea1">Please include a brief description of your planned core curriculum for this year:</label>
              <textarea tabindex="40" class="form-control" name="curriculum_desc" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
                Please initial the following boxes to show your compliance with them:
            </div>
            <div class="form-group">
              <div>
                <input tabindex="41" size=5 type="initial" name="initial1" id="initial1" required> I have included our curriculum plan for this year.
              </div>
            </div>
            <div class="form-group">
              <div>
                <input tabindex="42" size=5 type="initial" name="initial5" id="initial5" required> I have read and understood the homeschool laws of SC section 59-65-47 and agree to abide by them, maintaining and make available all legally required home school records for review by the director of Faithful Scholars and/or the State Board of Education.
              </div>
            </div>
            <div class="form-group">
              <div>
                <input tabindex="43" size=5 type="initial" name="initial6" id="initial6" required> I have read, and agree to comply with all of the Bylaws and Expectations as set forth by Faithful Scholars.
              </div>
            </div>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="membership_type">Type of Membership:</label>
              <div class="radio">
                <label><input tabindex="44" type="radio" name="optradio" value="1" required>Kindergarten only membership $25/year</label>
              </div>
              <div class="radio">
                <label><input tabindex="45" type="radio" name="optradio" value="2" required>Single-student family membership $35/year</label>
              </div>
              <div class="radio">
                <label><input tabindex="46" type="radio" name="optradio" value="3" required>Multi-student family membership $60/year</label>
              </div>
            </div>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-md-12">
            <label>Additions to your membership</label>
            <div class="form-group">
              <label>Number of High School Students:</label>

              <select tabindex="47" class="form-control" name="high_school_number" id="high_school_number">
                <option value='0'>0</option>
                <option value='1'>1</option>
                <option value='2'>2</option>
                <option value='3'>3</option>
                <option value='4'>4</option>
              </select>
              <label>* high school package includes: annual transcript, formal college accepted transcript upon graduation, diploma, DMV permission letter, secondary school recommendation, workshop, & email support
            </div>
            <div class="form-group">
              <label tabindex="48" class="checkbox-inline"><input type="checkbox" name="replacement" value="1">Replacement membership or student membership card $3</label><br>
              <label tabindex="49" class="checkbox-inline"><input type="checkbox" name="schea" value="1">SCHEA discounted membership $15</label><br>
              <label tabindex="50" class="checkbox-inline"><input type="checkbox" name="el" value="1">Enchanted Learning discounted membership $7</label><br>
              <label tabindex="51" class="checkbox-inline"><input type="checkbox" name="expedite" value="1">Expedite my Application Please $20 (24 hour turn around)</label><br>
            </div>
          </div>
        </div>
      </div>
    </fieldset>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <div class="col-sm-2 mx-auto">
            <input tabindex="52" class="btn btn-success" type="submit" name="submit" value="Submit" />
          </div>
        </div>
      </div>
    </div>
  </form>
