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
    $district = $row["district"];
  }
}

$sql2 = "SELECT * FROM student as f JOIN members as m ON f.id = m.id JOIN homeschool as h ON h.family_id = f.id WHERE username LIKE '".$_SESSION['uname']."%'";
if($result2 = mysqli_query($conn, $sql2)){
  while($row = mysqli_fetch_array($result2)){
    $name = $row["name"];
    $grade = $row["grade"];
    $family_id = $row["family_id"];
  }
}


class myPDF extends FPDF {
  function header() {
    if ( $this->PageNo() == 1 ) {
      $this->Image('../assets/faithfulscholarslogo.png',50,0,125); // Logo
      $this->SetFont('Times','B',12);   // Arial bold, size 15
      $this->SetY(50);    // set the cursor at Y position 5
      $this->Cell(80); // Move to the right
      $this->Cell(30,10,'Proof of Membership & Legal Home School Status',0,1,'C'); // Title
      $this->Ln(2);// Line break
    }
  }

  function footer() {
    if ( $this->PageNo() == 1 ) {
      $this->SetXY(0,-15); //set X and Y
      $this->SetFont('Times','', 12); //times, size 12
      $this->Cell(0,10,'1761 Ballard Lane Fort Mill, S.C. 29715 www.faithfulscholars.com (803) 548-4428',0,0,'C');
    }
  }

  function headerTable($conn) {
    $this->SetFont('Times','B', 12);
    $this->SetY(70);
    $this->Cell(20);
    $this->Cell(30,10,'Name: ',0,1);
    $this->SetFont('Times','', 12);
    $this->SetXY(45,70);
    $this->Cell(30,10,$GLOBALS['first_name']." ".$GLOBALS['last_name'],0,1);
    $this->SetFont('Times','B', 12);
    $this->SetY(85);
    $this->Cell(20);
    $this->Cell(30,10,'Address: ',0,1);
    $this->SetFont('Times','', 12);
    $this->SetXY(50,85);
    $this->Cell(30,10,$GLOBALS['address'],0,1);
    $this->SetFont('Times','B', 12);
    $this->SetY(100);
    $this->Cell(20);
    $this->Cell(30,10,'County:',0,1);
    $this->SetFont('Times','', 12);
    $this->SetXY(47,100);
    $this->Cell(30,10,$GLOBALS['county'],0,1);
    $this->SetFont('Times','B', 12);
    $this->SetY(120);
    $this->Cell(20);
    $this->Cell(30,10,'School District:',0,1);
    $this->SetFont('Times','', 12);
    $this->SetXY(60,120);
    $this->Cell(30,10,$GLOBALS['district'],0,1);
    $this->SetFont('Times','B', 12);
    $this->SetY(140);
    $this->Cell(20);
    $this->Cell(30,10,'School Year:',0,1);
    $this->SetFont('Times','', 12);
    $this->SetXY(55,140);

    $now = new \DateTime('now');
    $month = $now->format('n');
    $year = $now->format('Y');
    $currentYear = $now->format('Y');
    $intMonth = (int)$month;

    if($intMonth >= 8 and $intMonth <=12) {
      $schoolYear = $currentYear;
      $semester = "Fall";
      $this->Cell(30,10,$semester." ".$schoolYear,0,1);

    } else if ($intMonth >=1 and $intMonth <=5) {

      $schoolYear = $currentYear;
      $semester = "Spring";
      $this->Cell(30,10,$semester." ".$schoolYear,0,1);

    } else {
      $schoolYear = $currentYear;
      $semester = "Summer";
      $this->Cell(30,10,$semester." ".$schoolYear,0,1);
    }
    $this->SetFont('Times','B', 12);
    $this->SetY(155);
    $this->Cell(20);
    $this->Cell(30,10,'Member Number:',0,1);
    $this->SetFont('Times','', 12);
    $this->SetXY(65,155);
    $this->Cell(30,10,$GLOBALS['family_id'],0,1);
    $this->SetFont('Times','B', 12);
    $this->SetY(170);
    $this->Cell(20);
    $this->Cell(30,10,'Student, Grade:',0,1);
    $this->SetFont('Times','', 12);
    $this->SetXY(62,170);
    $this->Cell(30,10,$GLOBALS['name']." ".$GLOBALS['last_name']." , ".$GLOBALS['grade'],0,1);
    $this->SetFont('Times','B', 12);
    $this->Image('../assets/kate-signature.png',142,175,50); // Logo
    $this->Line(135,195,195,195);
    $this->SetXY(113,195);
    $this->Cell(20);
    $this->Cell(30,10,'Katharine S. Bach, Administrator',0,1);
    $this->SetXY(125,200);
    $this->Cell(20);
    $this->Cell(30,10,'katie@faithfulscholars.com',0,1);
  }

  function header2Table() {
    $this->SetFont('Times','B', 11); //times, size 12
    $this->Text(38,15,'FAITHFUL SCHOLARS');
    $this->Cell(100,50,'',1,1);
    $this->SetY(65);
    $this->Text(38,70,'FAITHFUL SCHOLARS');
    $this->Cell(100,50,'',1,1);
    $this->SetY(120);
    $this->Text(38,125,'FAITHFUL SCHOLARS');
    $this->Cell(100,50,'',1,1);
    $this->SetY(175);
    $this->Text(38,180,'FAITHFUL SCHOLARS');
    $this->Cell(100,50,'',1,1);
  }

}
$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('P','Letter',0);
$pdf->headerTable($conn);
$pdf->AddPage('P','Letter',0);
$pdf->header2Table();
$pdf->Output();

$conn->close();
?>
