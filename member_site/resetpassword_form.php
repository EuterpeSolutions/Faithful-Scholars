<?php
  require_once 'dbconfig.php';
  $a = checkSalt($_GET['q']);
  if($a == null || !isset($a) || $a == 0 || $a == ''){
    header('Location: http://faithfulscholars.com/member_site');
    exit();
  } 
?>
<table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<form name="form1" method="post" action="resetpassword.php">
<td>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
<tr>
<td colspan="3"><strong>Password Reset</strong></td>
</tr>
<tr>
<td>Email</td>
<td>:</td>
<td><input name="myemail" type="text" id="myemail"></td>
</tr>
<tr>
  <tr>
  <td>New Password</td>
  <td>:</td>
  <td><input name="mypassword" type="text" id="mypassword"></td>
  </tr>
  <tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input type="submit" name="Submit" value="Submit"></td>
</tr>
</table>
</td>
</form>
</tr>
</table>
