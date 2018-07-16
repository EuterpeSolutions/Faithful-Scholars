<?php
require 'fpdf.php';
require '../dbconfig.php';
$con = db_connect();
class myPDF extends FPDF {
  function header() {
    $this->SetFont('Times','B',14);   // Arial bold, size 15
    $this->SetY(10);    // set the cursor at Y position 5
    $this->Cell(80); // Move to the right
    $this->Cell(30,10,'SCHEA Users',0,1,'C'); // Title
    $this->Ln(2);// Line break
  }

  function footer() {
    $this->SetXY(0,-15); //set X and Y
    $this->SetFont('Times','', 12); //times, size 12
    $this->Cell(0,10,'1761 Ballard Lane Fort Mill, S.C. 29715  www.faithfulscholars.com  (803) 548-4428',0,0,'C');
  }


  function AddContent($name,$address,$email,$phone,$i) {
    $this->SetFont('Times','', 12);
    $this->Cell(160,5,$name.'  |  '.$address.'  |  '.$email.'  |  '.$phone,0,1,'L');
  }
}
$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('P','Letter',0);

$sql = "SELECT CONCAT(f.first_name, ' ', f.last_name) as name, CONCAT(f.address, ' ', f.city, ' ', f.zip, ' ', f.county) as address, f.email, f.phone FROM family as f JOIN membership as m ON f.id = m.family_id WHERE m.schea = 1 AND m.schea_sent = 0;";
if($result = mysqli_query($con, $sql)){
  $i = 1;
  while($row = mysqli_fetch_array($result)){
    $name = $row['name'];
    $address = $row['address'];
    $email = $row['email'];
    $phone = $row['phone'];

    if($name !== "" && isset($name)){
      $pdf->AddContent($name,$address,$email,$phone,$i);
    }
    $i++;
  }
}

$pdf->Output();

 ?>
