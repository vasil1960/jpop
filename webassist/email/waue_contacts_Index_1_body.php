<html><head></head><body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><img src="../images/EmailLogo/logo.png" alt="" width="97" height="97" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="12%"><strong>Email:</strong></td>
    <td width="88%"><?php echo ((isset($_POST["txtEmail"]))?$_POST["txtEmail"]:"")?></td>
  </tr>
  <tr>
    <td><strong>Name:</strong></td>
    <td><?php echo ((isset($_POST["txtName"]))?$_POST["txtName"]:"")?></td>
  </tr>
  <tr>
    <td><strong>Message:</strong></td>
    <td><?php echo ((isset($_POST["txtMessage"]))?$_POST["txtMessage"]:"")?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body></html>