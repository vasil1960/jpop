<html><head></head><body>Hi Ivan,<br/>
User <?php echo ((isset($_POST["txtFirstName"]))?$_POST["txtFirstName"]:"")?> <?php echo ((isset($_POST["txtLastName"]))?$_POST["txtLastName"]:"")?> from <?php echo ((isset($_POST["txtCity"]))?$_POST["txtCity"]:"")?>, <?php echo ((isset($_POST["txtCountry"]))?$_POST["txtCountry"]:"")?>
has submited the form for registration. <br/>
After registration his status will be an "Autor". <br/>
Only you can change his/her ststus. <br />
<br/>
Best regards from your System!</body></html>