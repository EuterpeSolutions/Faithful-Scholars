

<div class="container">
  <div class="row">
    <div class="col-md-4">

    </div>
    <div class="col-md-4">
      <form class="" action="?page=admin" method="post">
        <input class="admin-search" type="text" name="search"></input>
        <input type="submit" name="search-submit" value="Search">
      </form>

    </div>
    <div class="col-md-4">

    </div>
  </div>
  <br><br><br>
  <div class="row">
    <div class="col-md-12">
      <?php
       $search_value = "";
       if(isset($_POST["search"])){
         $search_value = $_POST["search"];
       }
       // Establish MySQL connection
       $con=mysqli_connect("127.0.0.1","root","newpassword","FaithfulScholars");
       if(mysqli_connect_errno()) {
         echo "Failed to connect to MySQL: " . mysqli_connect_error();
       };

       $sql="SELECT first_name, last_name, phone, email, address, city, zip, county FROM family WHERE last_name = '$search_value'";


       if($result = mysqli_query($con, $sql)){
           if(mysqli_num_rows($result) > 0){
               echo "<form class='' action='?page=admin-edit' method='post'>";
               echo "<table class=\"table\">";
                   echo "<tr>";
                       echo "<th>First</th>";
                       echo "<th>Last</th>";
                       echo "<th>Phone #</th>";
                       echo "<th>Email</th>";
                       echo "<th>Address</th>";
                       echo "<th>City</th>";
                       echo "<th>Zipcode</th>";
                       echo "<th>County</th>";
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
                       echo "<td>" . $row['zip'] . "</td>";
                       echo "<td>" . $row['county'] . "</td>";
                       echo "<td><input type='submit' name='edit' value='". $row['last_name'] . "' class='btn btn-success'></td>";
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
       // Close connection
       mysqli_close($con);
      ?>
    </div>
  </div>
</div>
