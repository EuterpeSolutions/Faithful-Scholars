<?php
require 'config.php';
require 'functions.php';

  session_start();
  if(isset($_SESSION['uname']) && isset($_SESSION['pwd'])){
    run();
  } else {
    echo `
      <table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
      <tr>
      <form name="form1" method="post" action="checklogin.php">
      <td>
      <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
      <tr>
      <td colspan="3"><strong>Member Login </strong></td>
      </tr>
      <tr>
      <td width="78">Username</td>
      <td width="6">:</td>
      <td width="294"><input name="myusername" type="text" id="myusername"></td>
      </tr>
      <tr>
      <td>Password</td>
      <td>:</td>
      <td><input name="mypassword" type="text" id="mypassword"></td>
      </tr>
      <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" value="Login"></td>
      </tr>
      </table>
      </td>
      </form>
      </tr>
      </table>
      <form name="form2" method="post" action="content/resetpassword_requestform.php">
        <td>
          <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><input type="submit" name="recoverpassword" value="Recover your Password"></td>
          </tr>
        </td>
      </form>
    `;
  }
?>
