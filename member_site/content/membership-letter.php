<?php
require "fpdf.php";
require "../dbconfig.php";

// Create connection
$conn = db_connect();

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

session_start();

$sql = "SELECT * FROM family as f JOIN members as m ON f.id = m.id JOIN homeschool as h ON h.family_id = f.id WHERE username LIKE '".$_SESSION['uname']."%'";
if($result = mysqli_query($conn, $sql)){
  while($row = mysqli_fetch_array($result)){
    $last_name = $row["last_name"];
    $first_name = $row["first_name"];
    $email = $row["email"];
    $phone = $row["phone"];
    $address = $row["address"];
    $city = $row["city"];
    $zipcode = $row["zip"];
    $county = $row["county"];
  }
}

$sql2 = "SELECT * FROM student as f JOIN members as m ON f.id = m.id JOIN homeschool as h ON h.family_id = f.id WHERE username LIKE '".$_SESSION['uname']."%'";
if($result2 = mysqli_query($conn, $sql2)){
  while($row = mysqli_fetch_array($result2)){
    $name = $row["name"];
    $grade = $row["grade"];
  }
}


class myPDF extends FPDF {
  function header() {
    $this->Image('../assets/faithfulscholarslogo.png',50,0,125); // Logo
    $this->SetFont('Times','B',12);   // Arial bold, size 15
    $this->SetY(50);    // set the cursor at Y position 5
    $this->Cell(80); // Move to the right
    $this->Cell(30,10,'Proof of Membership & Legal Home School Status',0,1,'C'); // Title
    $this->Ln(2);// Line break
  }

  function footer() {
    $this->SetXY(0,-15); //set X and Y
    $this->SetFont('Times','', 12); //times, size 12
    $this->Cell(0,10,'1761 Ballard Lane Fort Mill, S.C. 29715 www.faithfulscholars.com (803) 548-4428',0,0,'C');
  }

  function headerTable($conn) {
    $this->SetFont('Times','B', 12);
    $this->SetY(70);
    $this->Cell(20);
    $this->Cell(30,10,'Name: ',0,1);
    $this->SetFont('Times','', 12);
    $this->SetXY(45,70);
    $this->Cell(30,10,$GLOBALS[first_name]." ".$GLOBALS[last_name],0,1);
    $this->SetFont('Times','B', 12);
    $this->SetY(85);
    $this->Cell(20);
    $this->Cell(30,10,'Address: ',0,1);
    $this->SetFont('Times','', 12);
    $this->SetXY(50,85);
    $this->Cell(30,10,$GLOBALS[address],0,1);
    $this->SetFont('Times','B', 12);
    $this->SetY(100);
    $this->Cell(20);
    $this->Cell(30,10,'County:',0,1);
    $this->SetFont('Times','', 12);
    $this->SetXY(50,100);
    $this->Cell(30,10,$GLOBALS[county],0,1);
    $this->SetFont('Times','B', 12);
    $this->SetY(120);
    $this->Cell(20);
    $this->Cell(30,10,'School District:',0,1);
    $this->SetY(140);
    $this->Cell(20);
    $this->Cell(30,10,'School Year:',0,1);
    $this->SetFont('Times','', 12);
    $this->SetXY(55,140);
    $this->Cell(30,10,date('Y', strtotime('+0 year'))."-".date('Y', strtotime('+1 year')),0,1);
    $this->SetFont('Times','B', 12);
    $this->SetY(155);
    $this->Cell(20);
    $this->Cell(30,10,'Member Number:',0,1);
    $this->SetY(170);
    $this->Cell(20);
    $this->Cell(30,10,'Student, Grade:',0,1);
    $this->SetFont('Times','', 12);
    $this->SetXY(62,170);
    $this->Cell(30,10,$GLOBALS[name]." ".$GLOBALS[last_name]." , ".$GLOBALS[grade],0,1);
    $this->SetFont('Times','B', 12);
    $this->Line(135,195,195,195);
    $this->SetXY(113,195);
    $this->Cell(20);
    $this->Cell(30,10,'Katharine S. Bach, Administrator',0,1);
    $this->SetXY(125,200);
    $this->Cell(20);
    $this->Cell(30,10,'katie@faithfulscholars.com',0,1);
  }
}
$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('P','Letter',0);
$pdf->headerTable($conn);
$pdf->Output();

$conn->close();
?>
