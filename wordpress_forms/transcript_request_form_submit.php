<?
$student=$_POST["student"];
$parent=$_POST["parent"];
$parent_email=$_POST["parent_email"];
$phone=$_POST["phone"];
$reason_request=$_POST["reason_request"];
$transcript_address=$_POST["transcript_address"];

$message = "<html><head><link rel='stylesheet' type='text/css' href='http://www.faithfulscholars.com/stylesheet.css'><body><p> Transcript Mailing Request $student</p><p>Student's Name: $student <br />Parent's Name: $parent<br />Email Address: $parent_email<br />Phone: $phone<br /><br />Reason for transcript request: $reason_request <br />Address for transcript: $transcript_address </p></body></html>";
$to      = "katie@faithfulscholars.com, forms@faithfulscholars.com";

$from    = "katie@faithfulscholars.com";

$subject = "Request for mailed transcript:  $student";
$headers = "From: $from \r\n";
$headers .= "Reply-To: $from \r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$ok = @mail($to, $subject, $message, $headers);
?>
<html >
<head>
<link rel="stylesheet" href="stylesheet.css" type="text/css" />
</head>

<body>


    <h2>Thank you! </h2>

    <p>Thank you for submitting a request to mail a transcript for <? echo $student ?>.  The information
      you submitted is as follows:<br /><br />
      Student Name: <? echo $student; ?><br />
      Parent Name: <? echo $parent; ?><br />
      Email: <? echo $parent_email; ?><br />
      Phone: <? echo $phone; ?><br /><br />
      Reason for request: <? echo $reason_request; ?><br /><br />
      Transcript mailing address: <? echo $transcript_address; ?><br />
    </p>
  </body>
  </html>
