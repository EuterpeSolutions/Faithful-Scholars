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
    $father_name = $row["father_name"];
    $mother_name = $row["mother_name"];
  }
}

$sql2 = "SELECT * FROM student as f JOIN members as m ON f.id = m.id JOIN homeschool as h ON h.family_id = f.id WHERE username LIKE '".$_SESSION['uname']."%'";
if($result2 = mysqli_query($conn, $sql2)){
  while($row = mysqli_fetch_array($result2)){
    $name = $row["name"];
    $grade = $row["grade"];
    $age = $row["age"];
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
      $this->Cell(0,10,'1761 Ballard Lane Fort Mill, S.C. 29715  www.faithfulscholars.com  (803) 548-4428',0,0,'C');
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
    $this->Cell(30,10,$GLOBALS['address'].", ".$GLOBALS['city'].", SC ".$GLOBALS['zipcode'],0,1);
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

    $this->Cell(30,10,date('Y')." - ".date('Y', strtotime('+1 year')),0,1);
    $this->SetFont('Times','B', 12);
    $this->SetY(155);
    $this->Cell(20);
    $this->Cell(30,10,'Student, Grade:',0,1);
    $this->SetFont('Times','', 12);
    $this->SetXY(62,155);
    $sql2 = "SELECT * FROM student as s JOIN members as m ON s.family_id = m.id WHERE username LIKE '".$_SESSION['uname']."%'";
    if($result2 = mysqli_query($conn, $sql2)){
      while($row = mysqli_fetch_array($result2)){
        $name = $row["name"];
        $grade = $row["grade"];
        $this->SetX(62);
        $this->Cell(30,10,$name." ".$GLOBALS['last_name']." , ".$grade,0,1);
      }
    }
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

  function CardTable() {
    $this->SetFont('Times','B', 11); //times, size 12
    $this->SetDash(5,5); //5mm on, 5mm off
    $this->Image('../assets/faithfulscholarscardbg.png', 15, 20, 85, 25);
    $this->Text(38,15,'FAITHFUL SCHOLARS');
    $this->Text(45,20,'(803) 548-4428');
    $this->Text(35,25,'www.faithfulscholars.com');
    $this->Text(40,45,strtoupper($GLOBALS["father_name"]." and ".$GLOBALS["mother_name"]));
    $this->Text(25,50,strtoupper($GLOBALS["address"]." ".$GLOBALS["city"]." SC ".$GLOBALS["zip"]));
    $this->Text(53,55,date('Y'));
    $this->Cell(100,50,'',1,1);
    $this->SetY(65);
    $this->Image('../assets/faithfulscholarscardbg.png', 15, 75, 85, 25);
    $this->Text(38,70,'FAITHFUL SCHOLARS');
    $this->Text(45,75,'(803) 548-4428');
    $this->Text(35,80,'www.faithfulscholars.com');
    $this->Text(40,100,strtoupper($GLOBALS["father_name"]." and ".$GLOBALS["mother_name"]));
    $this->Text(25,105,strtoupper($GLOBALS["address"]." ".$GLOBALS["city"]." SC ".$GLOBALS["zip"]));
    $this->Text(53,110,date('Y'));
    $this->Cell(100,50,'',1,1);
    $this->SetY(120);
    $this->Image('../assets/faithfulscholarscardbg.png', 15, 130, 85, 25);
    $this->Text(38,125,'FAITHFUL SCHOLARS');
    $this->Text(45,130,'(803) 548-4428');
    $this->Text(35,135,'www.faithfulscholars.com');
    $this->Text(40,155,strtoupper($GLOBALS["father_name"]." and ".$GLOBALS["mother_name"]));
    $this->Text(25,160,strtoupper($GLOBALS["address"]." ".$GLOBALS["city"]." SC ".$GLOBALS["zip"]));
    $this->Text(53,165,date('Y'));
    $this->Cell(100,50,'',1,1);
    $this->SetY(175);
    $this->Image('../assets/faithfulscholarscardbg.png', 15, 185, 85, 25);
    $this->Text(38,180,'FAITHFUL SCHOLARS');
    $this->Text(45,185,'(803) 548-4428');
    $this->Text(35,190,'www.faithfulscholars.com');
    $this->Text(40,210,strtoupper($GLOBALS["father_name"]." and ".$GLOBALS["mother_name"]));
    $this->Text(25,215,strtoupper($GLOBALS["address"]." ".$GLOBALS["city"]." SC ".$GLOBALS["zip"]));
    $this->Text(53,220,date('Y'));
    $this->Cell(100,50,'',1,1);
    $this->SetXY(140,60);
    $this->MultiCell(0,15,'Laminating Options: Laminating machine, self-sealing laminating pouches, clear packing tape, or synthetic paper. Please print out and cut. You must obtain a new membership card each year.');
  }

  function StudentCard($conn,$name,$birthday) {
    $this->SetFont('Times','B', 11); //times, size 12
    $this->SetDash(5,5); //5mm on, 5mm off
    $this->Image('../assets/faithfulscholarscardbg.png', 15, 20, 85, 25);
    $this->MultiCell(100,8,'FAITHFUl SCHOLARS'."\n".'(803) 548-4428'."\n".'www.faithfulscholars.com'."\n"."\n".$name.", ".$birthday."\n".$GLOBALS["address"]." ".$GLOBALS["city"]." SC ".$GLOBALS["zip"],1,'C');
  }
}
$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('P','Letter',0);
$pdf->headerTable($conn);
$pdf->AddPage('P','Letter',0);
$pdf->CardTable();
$pdf->AddPage('P','Letter',0);
$sql2 = "SELECT * FROM student as s JOIN members as m ON s.family_id = m.id WHERE username LIKE '".$_SESSION['uname']."%'";
if($result2 = mysqli_query($conn, $sql2)){
  while($row = mysqli_fetch_array($result2)){
    $name = $row["name"];
    $birthday = $row["birthday"];
    $age = $row["age"];
    if($age > 14) {
      $pdf->StudentCard($conn,$name,$birthday);
    }
  }
}
$pdf->Output();
$conn->close();
?>
