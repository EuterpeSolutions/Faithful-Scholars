<?php
require "fpdf.php";
require '../functions.php';
require_once "../dbconfig.php";
session_start();
$check = checkLogin($_SESSION['userid']);
if($check == 0){
  readfile('../login.html');
}

// Create connection
$conn = db_connect();

$result = mysqli_query($conn, "SELECT COUNT(s.id) as count, grade, district FROM family f JOIN student s ON f.id = s.family_id WHERE district IS NOT NULL GROUP BY district, grade ORDER BY district, grade + 0;");
$number_of_records = mysqli_num_rows($result);

$column_count = "";
$column_grade = "";

$pdf = new FPDF();

if($row = mysqli_fetch_assoc($result)){
  $previous_district = $row['district'];
  $count = $row['count'];
  $grade = $row['grade'];

  $column_count = $column_count . $count . "\n";
  $column_grade = $column_grade . $grade . "\n";

  while($row = mysqli_fetch_assoc($result)){
    if($row['district'] != $previous_district){
      addPage($pdf, $column_count, $column_grade, $previous_district);
      $column_count = "";
      $column_grade = "";
      $previous_district = $row['district'];
    }
    $count = $row['count'];
    $grade = $row['grade'];

    $column_count = $column_count . $count . "\n";
    $column_grade = $column_grade . $grade . "\n";
  }
  addPage($pdf, $column_count, $column_grade, $previous_district);
}
$conn->close();

function addPage($pdf, $column_count, $column_grade, $district){
  $pdf->AddPage();

  $Y_Fields_Name_position = 40;
  $Y_Table_Position = 45;
  $X_Margin_Position = 25;

  $pdf->SetFillColor(232,232,232);
  $pdf->SetFont('Arial', 'B', 12);
  $pdf->SetY(15);
  $pdf->SetX($X_Margin_Position - 1);
  $pdf->Cell(120,5, '2018-2019 ENROLLMENT FOR FAITHFUL SCHOLARS');
  $pdf->SetY(33);
  $pdf->SetX($X_Margin_Position - 1);
  $pdf->Cell(120,5, 'NUMBER OF STUDENTS FROM ' . $district . ' DISTRICT:');
  $pdf->SetFont('Arial', 'B', 12);
  $pdf->SetY($Y_Fields_Name_position);
  $pdf->SetX($X_Margin_Position);
  $pdf->Cell(60,5,'Grade',1,0,'L',1);
  $pdf->SetX($X_Margin_Position + 60);
  $pdf->Cell(60,5,'Count',1,0,'L',1);
  $pdf->Ln();

  $pdf->SetFont('Arial','',12);
  $pdf->SetY($Y_Table_Position);
  $pdf->SetX($X_Margin_Position);
  $pdf->MultiCell(60,5,$column_grade,1);
  $pdf->SetY($Y_Table_Position);
  $pdf->SetX($X_Margin_Position + 60);
  $pdf->MultiCell(60,5,$column_count,1);

  $pdf->SetY(155);
  $pdf->SetX($X_Margin_Position);
  $pdf->Cell(120, 5, 'FAX FROM: Kate Bach, Faithful Scholars');
  $pdf->SetY(160);
  $pdf->SetX($X_Margin_Position + 24);
  $pdf->Cell(120, 5, '803-802-7664 fax');
  $pdf->SetY(165);
  $pdf->SetX($X_Margin_Position + 24);
  $pdf->Cell(120, 5, '803-548-4428 phone');
}



$pdf->Output();
?>
