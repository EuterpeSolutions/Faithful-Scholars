<?php
require "fpdf.php";

class myPDF extends FPDF {
  function header() {
    $this->SetFont('Arial','B',14);
    $this->Cell(267,5,'Form Example',0,0,'C');
    $this->Ln();
    $this->setFont('Times','',12);
    $this->Cell(267,10,'Some Official Address',0,0,'C');
    $this->Ln(20);
  }

  function footer() {
    $this->SetY(-15);
    $this->SetFont('Arial','',8);
    $this->Cell(0,10,'Page ' .$this->PageNo. '/{nb}',0,0,'C');
  }

  function headerTable() {
    $this->SetFont('Times','B',12);
    $this->Cell(20,10,'ID',1,0,'C');
    $this->Cell(40,10,'Name',1,0,'C');
    $this->Cell(40,10,'Year',1,0,'C');
    $this->Ln();
  }

  function viewTable($conn) {
    $this->SetFont('Times','',12);
    $sql = "SELECT ID,Name,Year FROM testtable";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        $this->Cell(20,10,$row["ID"],1,0,'L');
        $this->Cell(40,10,$row["Name"],1,0,'L');
        $this->Cell(40,10,$row["Year"],1,0,'L');
        $this->Ln();
      }
    } else {
      echo "0 results";
    }
  }
}
$pdf = new myPDF();
$pdf->AddPage();

$pdf->Image('../../member_site/assets/arrow.png', 5, 5, 20, 20);
$pdf->SetFont('Arial', 'B', 23);

$name = "{$forename} {$surname}";

$pdf->Text(500, 457, $name);

$pdf->Text(500, 1268, date('jS F Y'), $row['when']);

$pdf->Output();
?>
