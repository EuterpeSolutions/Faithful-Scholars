<?php
  require_once 'dbconfig.php';
  if(isAdmin($_SESSION['uname']) != 1){
    header("Location: /");
  }
?>

<div class="container">
  <div class="row">
    <div class="col-md-4">
      <h5>User Search</h5>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 mx-auto">
      <form action="?page=admin" method="post">
        <div class="form-group">
          <input class="admin-search" type="text" id="search" name="search" class="form-control">
        </div>
        <div class="form-group">
          <input type="submit" name="search-submit" value="Search" class="btn btn-primary">
        </div>
      </form>
    </div>
  </div>
  <br><br><br>
  <div class="row">
    <div class="col-md-12">
      <?php

      $con = db_connect();
       if(isset($_POST["search"])){
         $search_value = $_POST["search"];
         $sql = "";
         if($search_value != ''){
           $sql="SELECT id, first_name, last_name, phone, email, address, city, zip, county FROM family WHERE last_name LIKE '%$search_value%' OR first_name LIKE '%$search_value%' ORDER BY last_name ASC";
         } else {
           $sql="SELECT id, first_name, last_name, phone, email, address, city, zip, county FROM family ORDER BY last_name ASC";
         }


         if($result = mysqli_query($con, $sql)){
             if(mysqli_num_rows($result) > 0){
                 echo "<form class='' action='?page=admin-edit' method='post'>";
                 echo "<table class=\"table\" style=\"width:100%;\">";
                     echo "<tr>";
                         echo "<th>First</th>";
                         echo "<th>Last</th>";
                         echo "<th>Phone #</th>";
                         echo "<th>Email</th>";
                         echo "<th>Address</th>";
                         echo "<th>City</th>";
                         echo "<th>Edit</th>";
                     echo "</tr>";
                 while($row = mysqli_fetch_array($result)){
                     echo "<tr>";
                         echo "<td>" . $row['first_name'] . "</td>";
                         echo "<td>" . $row['last_name'] . "</td>";
                         echo "<td>" . $row['phone'] . "</td>";
                         echo "<td>" . $row['email'] . "</td>";
                         echo "<td>" . $row['address'] . "</td>";
                         echo "<td>" . $row['city'] . "</td>";
                         echo "<td><input type='submit' name='selected_id' value='". $row['id'] . "' class='btn btn-success'></td>";
                     echo "</tr>";
                 }
                 echo "</table>";
                 echo "</form>";
                 // Free result set
                 mysqli_free_result($result);
             } else{
                 echo "No records matching your query were found.";
             }
         } else{
             echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
         }
         $search_value = "";
       }

       // Save data
       if(isset($_POST["original_last_name"])){
         $original_last_name = $_POST["original_last_name"];
         $last_name = $_POST["last_name"];
         $first_name = $_POST["first_name"];
         $phone = $_POST["phone"];
         $email = $_POST["email"];
         $address = $_POST["address"];
         $zipcode = $_POST["zipcode"];
         $city = $_POST["city"];


         $save_sql = "UPDATE family SET last_name = '$last_name', first_name = '$first_name', phone = '$phone', email = '$email', address='$address', zip = '$zipcode', city = '$city' WHERE id = '$original_last_name'";

         $con->query($save_sql);

         $family_id_sql = 'SELECT id FROM family WHERE last_name = "'.$last_name.'"';
         $family_id;
         if($result = mysqli_query($con, $family_id_sql)){
             if(mysqli_num_rows($result) > 0){
                 while($row = mysqli_fetch_array($result)){
                   $family_id = $row["id"];
                 }
             }
         }
         echo "family_id ".$family_id."<br>";
         // Save student data
         for($i = 0; $i < 9; $i++){
           if(isset($_POST["name".$i]) && $_POST["name".$i] != "" && isset($_POST["grade".$i]) && isset($_POST["birthday".$i])){

             $current_name = $_POST["name".$i];
             $current_grade = $_POST["grade".$i];
             $current_birthday = $_POST["birthday".$i];

             $check_sql = 'SELECT id FROM student WHERE family_id = "'.$family_id.'" AND name = "'.$current_name.'"';

             if($result = mysqli_query($con, $check_sql)) {

               if(mysqli_num_rows($result) == 1){
                 // student record already exists so update it
                 while($row = mysqli_fetch_array($result)){
                   $update_sql = 'UPDATE student SET name = "'.$current_name.'", grade = '.$current_grade.', birthday = "'.$current_birthday.'" WHERE id = '.$row["id"];
                   $con->query($update_sql);
                 }
               } else {
                 // Student record does not exist to create interface
                 $insert_sql = "INSERT INTO student (family_id,name,grade,birthday) VALUES($family_id,'$current_name',$current_grade,'$current_birthday')";
                 $con->query($insert_sql);
               }
             }
           }
         }
       }
       // Close connection
       mysqli_close($con);
      ?>
    </div>
  </div>
  <br><br>
  <hr>
  <br>
  <div class="row">
    <div class="col-md-12">
      <?php

      $con = db_connect();//mysqli_connect("$host", "$username", "$password", $db_name);

      echo "<h5>Total Student Count: </h5>";
      $sql="SELECT COUNT(id) as count FROM student;";
      if($result = mysqli_query($con,$sql)){
         if(mysqli_num_rows($result) > 0){
	    while($row = mysqli_fetch_array($result)) {
               echo "<h6>".$row['count']."</h6>";
            }
         }
      }

      echo "<br><h5>Student Count by District</h5>";
      $sql="SELECT COUNT(id) as count, district as district FROM family WHERE district IS NOT NULL GROUP BY district;";
      if($result = mysqli_query($con, $sql)){
         if(mysqli_num_rows($result) > 0){
             echo "<form class='' action='?page=admin-edit' method='post'>";
             echo "<table class=\"table\" style=\"width:100%;\">";
                 echo "<tr>";
                     echo "<th>District</th>";
                     echo "<th>Count</th>";
                 echo "</tr>";
             while($row = mysqli_fetch_array($result)){
                 echo "<tr>";
                     echo "<td>" . $row['district'] . "</td>";
                     echo "<td>" . $row['count'] . "</td>";
                 echo "</tr>";
             }
             echo "</table>";
             echo "</form>";
             // Free result set
             mysqli_free_result($result);
         } else{
             echo "No records matching your query were found.";
         }
      } else{
         echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
      }

      echo "<br><h5>Student Count by Grade</h5>";
      $sql="SELECT COUNT(id) as count, grade FROM student WHERE grade IS NOT NULL GROUP BY grade;";
      if($result = mysqli_query($con, $sql)){
         if(mysqli_num_rows($result) > 0){
             echo "<form class='' action='?page=admin-edit' method='post'>";
             echo "<table class=\"table\" style=\"width:100%;\">";
                 echo "<tr>";
                     echo "<th>Grade</th>";
                     echo "<th>Count</th>";
                 echo "</tr>";
             while($row = mysqli_fetch_array($result)){
                 echo "<tr>";
                     echo "<td>" . $row['grade'] . "</td>";
                     echo "<td>" . $row['count'] . "</td>";
                 echo "</tr>";
             }
             echo "</table>";
             echo "</form>";
             // Free result set
             mysqli_free_result($result);
         } else{
             echo "No records matching your query were found.";
         }
      } else{
         echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
      }
?>
  </div>
</div>
<br><br>
<hr>
<br>
<h5>SCHEA and Enchanted Learning</h5>
<br>
<div class="row">
<div class="col-md-6">
<?php
      $sql = "SELECT count(id) as count FROM membership WHERE schea > 0 AND schea_sent = 0;";
      if($result = mysqli_query($con, $sql)){
        if(mysqli_num_rows($result) > 0){
          while($row = mysqli_fetch_array($result)){
            echo "<span>SCHEA: $" . (15 * $row['count']) . "</span><br>";
            echo "<a href=\"/member_site/content/schea.php\">List of SCHEA Users</a>";
            echo "<br><br>";
          }
        }
      }
      $sql = "SELECT count(id) as count FROM membership WHERE enchanted_learning > 0 AND enchanted_learning_sent = 0;";
      if($result = mysqli_query($con, $sql)){
        if(mysqli_num_rows($result) > 0){
          while($row = mysqli_fetch_array($result)){
            echo "<p>Enchanted Learning: $" . (10 * $row['count']) . "</p>";
            echo "<br>";
          }
        }
      }

      // Close connection
      mysqli_close($con);
      ?>
    </div>
    <div class="col-md-6">
      <form method="post">
        <input onclick="return confirm('Are you sure that you sent off the SCHEA information? This action cannot be undone.')" class="btn btn-success" type="submit" name="test" id="test" value="Mark SCHEA as Sent" /><br />
      </form>
      <?php
        if(array_key_exists('test', $_POST)){
          $con = db_connect();
          $update_sql = "UPDATE membership SET schea_sent = 1;";
          if($con->query($update_sql)){
            echo "Updated SCHEA";
            header('Location: /member_site/?page=admin');
          }
        }

       ?>
       <br>
       <form method="post">
         <input onclick="return confirm('Are you sure that you sent off the Enchanted Learning information? This action cannot be undone')" class="btn btn-success" type="submit" name="test2" id="test2" value="Mark Enchanted Learning as Sent" /><br />
       </form>
       <?php
         if(array_key_exists('test2', $_POST)){
           $con = db_connect();
           $update_sql = "UPDATE membership SET enchanted_learning_sent = 1;";
           if($con->query($update_sql)){
             echo "Updated Enchanted Learning";
             header('Location: /member_site/?page=admin');
           }
         }
        ?>
    </div>
  </div>
</div>
