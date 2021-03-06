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



$userid = $_SESSION['userid'];
if(isset($_SESSION['adminproxyid']) && $_SESSION['adminproxyid'] != -1){
  $userid = $_SESSION['adminproxyid'];
}

$sql = "SELECT * FROM family as f JOIN members as m ON f.id = m.id JOIN homeschool as h ON h.family_id = f.id WHERE f.id = ". $userid .";";
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

class myPDF extends FPDF {
  function header() {
    $this->Image('../assets/faithfulscholarslogo.png',50,15,125); // Logo
    $this->SetFont('Times','B',12);   // Arial bold, size 15
    $this->SetY(50);    // set the cursor at Y position 5
    $this->Cell(80); // Move to the right
    $this->Cell(30,10,'STUDENT IDENTIFICATION VERIFICATION For DMV',0,1,'C'); // Title
    $this->Ln(2);// Line break
  }

  function footer() {
    $this->SetXY(0,-30); //set X and Y
    $this->SetFont('Times','', 12); //times, size 12
    $this->Cell(0,10,'1761 Ballard Lane Fort Mill, S.C. 29715  www.faithfulscholars.com  (803) 548-4428',0,0,'C');
  }

  function headerTable($name,$grade,$birthday) {
    $this->SetFont('Times','B', 12); //times, size 12
    $this->SetY(70);
    $this->Cell(20);
    $this->Cell(30,10,'Student:',0,1);
    $this->SetFont('Times','', 12);
    $this->SetXY(47,70);
    $this->Cell(30,10,$GLOBALS['name'],0,1);
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

    $now = new \DateTime('now');
    $month = $now->format('n');

    if($month >=1 and $month <=5) {
      $this->Cell(30,10,date('Y', strtotime('-1 year'))." - ".date('Y'),0,1);
    } else {
      $this->Cell(30,10,date('Y')." - ".date('Y', strtotime('+1 year')),0,1);
    }
    $this->SetFont('Times','', 12); //times, size 12
    $this->SetXY(10,120);
    $this->Cell(20);
    $this->Cell(30,10,'To Whom It May Concern:',0,1);
    $this->SetXY(30,132);
    $this->Cell(30,10,$GLOBALS['name'],0,1);
    $this->SetXY(10,140);
    $this->Cell(20);
    $this->MultiCell(140,10,'is a member in good standing of the South Carolina home school accountability association, Faithful Scholars.',0,1);
    $this->SetXY(10,170);
    $this->Cell(20);
    $this->Cell(30,10,'Sincerely,',0,1);
    $this->SetXY(10,175);
    $this->Cell(20);
    $this->Cell(30,10,'I am,',0,1);
    $this->SetXY(10,185);
    $this->Cell(20);
    $this->Cell(30,10,'Katharine S. Bach, Administrator',0,1);
    $this->Image('../assets/kate-signature.png',30,200,50); // Logo
  }
}

$sql2 = "SELECT * FROM student WHERE family_id  = " . $userid . ";";
if($result2 = mysqli_query($conn, $sql2)){
  if($result2->num_rows <= 0){
    header("Location:member_site/?page=error");
  }

  $pdf = new myPDF();
  $pdf->AliasNbPages();

  while($row = mysqli_fetch_array($result2)){
    $name = $row["name"];
    $grade = $row["grade"];
    $birthday = $row["birthday"];
    $age = $row["age"];
    if($age >=  15){
      $pdf->AddPage('P','Letter',0);
      $pdf->headerTable($name,$grade,$birthday);
    }
  }
  $pdf->Output();
}

$conn->close();
?>
