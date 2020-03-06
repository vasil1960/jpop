<html><head></head><body>Hi Editor,<br/>
<?php echo $_SESSION['UserFirstName']?> <?php echo $_SESSION['UserLastName']?> <br/>
has send and upload manuscript with title "<?php echo ((isset($_POST["txtFullTitle"]))?$_POST["txtFullTitle"]:"")?>\" to the system</body></html>