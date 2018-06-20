<?php
require "fpdf.php";
require "../dbconfig.php";

// Create connection
$conn = db_connect();

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
    $birthday = $row["birthday"];
  }
}

class myPDF extends FPDF {
  function header() {
    $this->Image('../assets/faithfulscholarslogo.png',50,0,125); // Logo
    $this->SetFont('Times','B',12);   // Arial bold, size 15
    $this->SetY(40);    // set the cursor at Y position 5
    $this->Cell(80); // Move to the right
    $this->Cell(30,10,'PERMISSION FOR ATTENDING A SECONDARY SCHOOL',0,1,'C'); // Title
    $this->SetX(87);
    $this->Cell(30,10,'such as York Tech',0,1,'C'); // Title
    $this->Ln();// Line break
  }

  function footer() {
    $this->SetXY(0,-15); //set X and Y
    $this->SetFont('Times','', 12); //times, size 12
    $this->Cell(0,10,'1761 Ballard Lane Fort Mill, S.C. 29715  www.faithfulscholars.com  (803) 548-4428',0,0,'C');
  }

  function headerTable() {
    $this->SetFont('Times','B', 12); //times, size 12
    $this->SetY(70);
    $this->Cell(20);
    $this->Cell(30,10,'Student:',0,1);
    $this->SetFont('Times','', 12);
    $this->SetXY(47,70);
    $this->Cell(30,10,$GLOBALS['name']." ".$GLOBALS['last_name'],0,1);
    $this->SetFont('Times','B', 12);
    $this->SetY(80);
    $this->Cell(20);
    $this->Cell(30,10,'D.O.B:',0,1);
    $this->SetFont('Times','', 12);
    $this->SetXY(47,80);
    $this->Cell(30,10,$GLOBALS['birthday'],0,1);
    $this->SetFont('Times','B', 12);
    $this->SetY(90);
    $this->Cell(20);
    $this->Cell(30,5,'Address:',0,1);
    $this->SetFont('Times','', 12);
    $this->SetXY(47,90);
    $this->MultiCell(50,5,$GLOBALS['address'],0,1);
    $this->SetFont('Times','B', 12);
    $this->SetXY(70,70);
    $this->Cell(20);
    $this->Cell(30,10,'Home School Association:',0,1);
    $this->SetFont('Times','', 12);
    $this->SetXY(140,70);
    $this->Cell(30,10,"Faithful Scholars",0,1);
    $this->SetXY(140,74);
    $this->Cell(30,10,"1761 Ballard Lane",0,1);
    $this->SetXY(140,78);
    $this->Cell(30,10,"Fort Mill, SC 29715",0,1);
    $this->SetXY(140,82);
    $this->Cell(30,10,"(803) 548-4428",0,1);
    $this->SetFont('Times','B', 12);
    $this->SetXY(70,88);
    $this->Cell(20);
    $this->Cell(30,10,'School Year:',0,1);
    $this->SetFont('Times','', 12);
    $this->SetXY(120,88);
    $this->Cell(30,10,date('Y', strtotime('+0 year'))."-".date('Y', strtotime('+1 year')),0,1);
    $this->SetFont('Times','', 12); //times, size 12
    $this->SetXY(10,120);
    $this->Cell(20);
    $this->Cell(30,10,'To Whom It May Concern:',0,1);
    $this->SetXY(35,140);
    $this->Cell(30,10,$GLOBALS['name'],0,1);
    $this->SetXY(30,140);
    $this->Cell(20);
    $this->MultiCell(140,10,'is a member in good standing of the home school accountability association Faithful Scholars, and as such has permission to attend classes at York Tech and/or any secondary school.',0,1);
    $this->SetXY(10,180);
    $this->Cell(20);
    $this->Cell(30,10,'Sincerely,',0,1);
    $this->SetXY(10,185);
    $this->Cell(20);
    $this->Cell(30,10,'I am,',0,1);
    $this->SetXY(10,190);
    $this->Cell(20);
    $this->Cell(30,10,'Katharine S. Bach, Administrator',0,1);

  }

  function viewTable($conn) {
  }
}
$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('P','Letter',0);
$pdf->headerTable();
$pdf->viewTable($conn);
$pdf->Output();

$conn->close();
?>
