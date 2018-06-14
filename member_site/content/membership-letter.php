<?php
require "fpdf.php";
require "../dbconfig.php";

// Create connection
$conn = db_connect();

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT ID,Name,Year FROM testtable";
$result = $conn->query($sql);

session_start();

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

  function headerTable() {
    $this->SetFont('Times','B', 12); //times, size 12
    $this->SetY(70);
    $this->Cell(20);
    $this->Cell(30,10,'Name:',0,1);
    $this->SetY(85);
    $this->Cell(20);
    $this->Cell(30,10,'Address:',0,1);
    $this->SetY(110);
    $this->Cell(20);
    $this->Cell(30,10,'County:',0,1);
    $this->SetY(125);
    $this->Cell(20);
    $this->Cell(30,10,'School District:',0,1);
    $this->SetY(140);
    $this->Cell(20);
    $this->Cell(30,10,'School Year:',0,1);
    $this->SetY(155);
    $this->Cell(20);
    $this->Cell(30,10,'Member Number:',0,1);
    $this->SetY(170);
    $this->Cell(20);
    $this->Cell(30,10,'Student, Grade:',0,1);
    $this->Line(135,195,195,195);
    $this->SetXY(113,195);
    $this->Cell(20);
    $this->Cell(30,10,'Katharine S. Bach, Administrator',0,1);
    $this->SetXY(125,200);
    $this->Cell(20);
    $this->Cell(30,10,'katie@faithfulscholars.com',0,1);

  }

  function header2Table() {
    $this->SetFont('Times','B', 12); //times, size 12
    $this->Cell(100,50,'',1,1);
    $this->SetY(65);
    $this->Cell(100,50,'',1,1);
    $this->SetY(120);
    $this->Cell(100,50,'',1,1);
    $this->SetY(175);
    $this->Cell(100,50,'',1,1);
  }

}
$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('P','Letter',0);
$pdf->headerTable();
$pdf->AddPage('P','Letter',0);
$pdf->header2Table();
$pdf->Output();

$conn->close();
?>
