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

$pdf = new FPDF();
$pdf->SetFont('Arial', '', 11);


$result = mysqli_query($conn, "SELECT DISTINCT f.district, count(1) as count, s.grade FROM family f JOIN student s ON f.id = s.family_id GROUP BY district, s.grade;");

$index = 0;
$districtArray = array();

$countIndex = 0;
$countArray = array();
while($row = mysqli_fetch_assoc($result)){
  if($districtArray[$index - 1] != $row['district']){
    $districtArray[$index] = $row['district'];
    $index++;
  }
  $d = $row['district'];
  $g = $row['grade'];

  $countArray[$d][$g] = $row['count'];
}

$splitArray = array_chunk($districtArray, 47, false);
foreach($splitArray as $q => $value){
  addTotalPage($pdf, $splitArray[$q], $countArray);
}
// addTotalPage($pdf, $districtArray, $countArray);

function addTotalPage($pdf, $districtArray, $countArray){
  $pdf->AddPage();

  $X_Multiplier = 10;
  $Y_Row_Multiplier = 5;
  $X_Left_Table_Margin = 45;
  $X_Left_Margin = 10;
  $Y_Top_Margin = 15;
  $Y_Bottom_Margin = 265;
  $Cell_Size = 5;

  // District Label
  $pdf->SetY($Y_Top_Margin);
  $pdf->SetX($X_Left_Margin);
  $pdf->Cell($Cell_Size,$Cell_Size, 'Districts');

  // Grade
  for($i = 0; $i <= 12; $i++){
    $pdf->SetX($i * $X_Multiplier + $X_Left_Table_Margin);
    $pdf->Cell($Cell_Size,$Cell_Size, $i);
  }

  // Right Total
  $pdf->SetX((12 * $X_Multiplier + $X_Left_Table_Margin) + $X_Multiplier);
  $pdf->Cell($Cell_Size,$Cell_Size, 'Total');

  // Districts
  $gradeTotalArray = array();

  $pdf->SetX($X_Left_Margin);
  foreach($districtArray as $i => $value){
    // District Name
    $pdf->SetY(25 + ($i * $Y_Row_Multiplier));
    $pdf->Cell($Cell_Size,$Cell_Size, $districtArray[$i]);

    // Grade Counts
    $pdf->SetY(25 + ($i * $Y_Row_Multiplier));
    $count = 0;
    $rowTotal = 0;
    foreach($countArray[$districtArray[$i]] as $k => $value){
      $pdf->SetX($k * $X_Multiplier + $X_Left_Table_Margin);
      $pdf->Cell($Cell_Size,$Cell_Size, $countArray[$districtArray[$i]][$k]);

      $rowTotal = $rowTotal + $countArray[$districtArray[$i]][$k];

      $gradeTotalArray[$k] = $gradeTotalArray[$k] + $countArray[$districtArray[$i]][$k];
    }

    // Row Total
    $pdf->SetX((12 * $X_Multiplier + $X_Left_Table_Margin) + $X_Multiplier);
    $pdf->Cell($Cell_Size,$Cell_Size, $rowTotal);

    $gradeTotalArray[13] = $gradeTotalArray[13] + $rowTotal;
  }

  // Bottom Total
  $pdf->SetY($Y_Bottom_Margin);
  $pdf->SetX($X_Left_Margin + 21);
  $pdf->Cell($Cell_Size,$Cell_Size, 'Total');

  // Grade Totals
  foreach($gradeTotalArray as $j => $value){
    $pdf->SetX($j * $X_Multiplier + $X_Left_Table_Margin);
    $pdf->Cell($Cell_Size,$Cell_Size, $gradeTotalArray[$j]);
  }

  // Date
  $pdf->SetY($Y_Bottom_Margin + $Y_Row_Multiplier);
  $pdf->SetX($X_Left_Margin);

  $now = new \DateTime('now');

  $pdf->Cell($Cell_Size,$Cell_Size, $now->format('F d, Y'));
}

$result = mysqli_query($conn, "SELECT COUNT(s.id) as count, grade, district FROM family f JOIN student s ON f.id = s.family_id WHERE district IS NOT NULL GROUP BY district, grade ORDER BY district, grade + 0;");
$number_of_records = mysqli_num_rows($result);

$column_count = "";
$column_grade = "";

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

  $Y_Top_Margin = 65;
  $Y_Row_Height = 5;
  $Y_Table_Header_Position = $Y_Top_Margin + 25;
  $Y_Enrollment_Label = $Y_Table_Header_Position - (4 * $Y_Row_Height);
  $Y_Num_Students_Label = $Y_Table_Header_Position - (2 * $Y_Row_Height);
  $Y_Table_Position = $Y_Table_Header_Position + $Y_Row_Height;
  $Y_Fax_Label = $Y_Top_Margin + 100;
  $Y_Bottom_Margin = 270;

  $X_Margin_Position = 25;

  $pdf->SetFillColor(232,232,232);
  $pdf->SetFont('Arial', 'B', 12);

  $pdf->Image('../assets/faithfulscholarslogo.png', 50,10,125); // Logo

  $pdf->SetY($Y_Enrollment_Label);
  $pdf->SetX($X_Margin_Position - 1);
  $pdf->Cell(120,5, '2018-2019 ENROLLMENT FOR FAITHFUL SCHOLARS');

  $pdf->SetY($Y_Num_Students_Label);
  $pdf->SetX($X_Margin_Position - 1);
  $pdf->Cell(120,5, 'NUMBER OF STUDENTS FROM ' . $district . ' DISTRICT:');
  $pdf->SetFont('Arial', 'B', 12);

  $pdf->SetY($Y_Table_Header_Position);
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

  $pdf->SetY($Y_Fax_Label);
  $pdf->SetX($X_Margin_Position);
  $pdf->Cell(120, 5, 'FAX FROM: Kate Bach, Faithful Scholars');
  $pdf->SetY($Y_Fax_Label + $Y_Row_Height);
  $pdf->SetX($X_Margin_Position + 24);
  $pdf->Cell(120, 5, '803-802-7664 fax');
  $pdf->SetY($Y_Fax_Label + (2 * $Y_Row_Height));
  $pdf->SetX($X_Margin_Position + 24);
  $pdf->Cell(120, 5, '803-548-4428 phone');

  $pdf->SetY($Y_Bottom_Margin);
  $pdf->SetX($X_Margin_Position);
  $pdf->SetFont('Arial', '', 9);
  $pdf->Cell(120, 5, '1761 Ballard Lane Fort Mill, SC 29715  (803)-548-4428 fax (803)-802-7446 www.faithfulscholars.com');
}



$pdf->Output();
?>
