<? 
$name=$_POST["name"];
$member = $_POST["member"];
$email=$_POST["email"];
$phone=$_POST["phone"];
$number_workshops=$_POST["number_workshops"];
$workshops=$_POST["workshops"];

$winter_retreat=$_POST["winter_retreat"];
$spring_retreat=$_POST["spring_retreat"];
$fall_retreat=$_POST["fall_retreat"];
$winter_combo=$_POST["winter_combo"];
$fall_combo=$_POST["fall_combo"];
$spring_combo=$_POST["spring_combo"];


$total = (($number_workshops*5) + $winter_retreat + $spring_retreat );

$message = " Name: $name \n Email: $email \n Phone: $phone \n Member of Faithful Scholars? $member \n \n Workshops: $workshops \n\n Retreats: \n  Winter Retreat: $winter_combo \n     Spring Retreat: $spring_combo  \n\n  Total:  $total \n\n ";
// set the to and from for the e-mail
	$to      = "katie@faithfulscholars.com";
	$from    = "katie@faithfulscholars.com";

	$subject = "Workshop Registration from FaithfulScholars.com for $name";

	
$ok = @mail($to, $subject, $message, $headers);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Faithful Scholars - SC Accountability Association</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="stylesheet.css" type="text/css" />
</head>

<body>

<div id="container">
	<div id="header">
	 <p align="center">&nbsp;</p>
  </div>
<div id="content">

    <h1>Workshop registration</h1>
    <p>We appreciate your registration for our workshops! </p>
    <p>The total for the workshops is $<? echo $total; ?>.  You can pay online now using PayPal; or mail a check to:</p>
    <p> Faithful Scholars</p>
    <p>1761 Ballard Lane</p>
    <p>Fort Mill, SC 29715</p>
    <div align="center">
    <form action="https://www.paypal.com/cgi-bin/webscr" method="post"  target="_top"> <!-- Identify your business so that you can collect the payments. --> <input type="hidden" name="business" value="katie@faithfulscholars.com"> <!-- Specify a Buy Now button. --> <input type="hidden" name="cmd" value="_xclick"> <!-- Specify details about the item that buyers will purchase. --> <input type="hidden" name="item_name" value="Faithful Scholars Workshop and Retreats - <? echo $name ?>" > <input type="hidden" name="amount" value="<? echo $total ?>"> <input type="hidden" name="currency_code" value="USD"> <!-- Display the payment button. --> <input type="image" name="submit" border="0" src="http://www.faithfulscholars.com/images/paynow.jpg" alt="Faithful Scholars Checkout"> <img alt="" border="0" width="1" height="1" src="https://www.paypal.com/en_US/i/scr/pixel.gif" > </form>  </div>
    <p>You will be contacted prior to the event with a reminder / confirmation. </p>
    <p>&nbsp;</p>
    <div id="footer">
      <p>Faithful Scholars, LLC Copyright 2013</p>
    </div>
	</div>
  </div>

</body>
</html>