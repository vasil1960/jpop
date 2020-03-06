<html><head></head><body>
<p>Please klick on the link below to confirm your registration:</p>
<p><a href="http://jpop.klaro-bg.com/users/users_Confirm.php?UID=<?php echo (mysql_insert_id())?>&amp;code=<?php echo ((isset($_SESSION["randomConfirm"]))?$_SESSION["randomConfirm"]:"")?>">I confirm my registration.</a></p>
<p>(If you can't click over the link please select it, copy and paste into the browser address fild and press &quot;Ehter&quot;.)</p>
<p>Thenk you.</p>
<p>Journal POP</p>
</body>
<?php
mysql_free_result($CheckRepeat);
?>
</html>