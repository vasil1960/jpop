<html><head></head><body>
 Dear Dr. <?php echo $_SESSION['UserFirstName']?> <?php echo $_SESSION['UserLastName']?>,<br /><br />

  Thank you for the submited manusctript - JPOP <?php echo $row_rsCode['code']?>. <span lang="EN-US" xml:lang="EN-US">It will be sending to reviewers and will be considered for publication in Journal Propagation of Ornamental Plants</span>.<br />
Please find attached the <strong>Consent to publish and transfer of copiright</strong>. You are kindly requested to follow the next steps:<br />
<br />
1. Please fill in the <strong>title of your contribution</strong> and the <strong>author(s)</strong> on the indicated positions of the consent form <br />
2. Print and sign the consent (position in the end: <strong>Signature</strong>) <br />
3. Please send the consent <strong>BY AIRMAIL</strong> to: <br />
 
<p>Dr. Ivan Iliev<br />
Editor-in-chief<br />
Journal Propagation of Ornamental Plants<br />
University of Forestry<br />
10 Kliment Ohridski blvd.<br />
1756 Sofia <br />
Bulgaria</p>
<p><span lang="EN-US" xml:lang="EN-US">We will contact you again as soon as a final decision has been reached by the Editorial Board.</span><br />
<span lang="EN-US" xml:lang="EN-US">Please remember to quote the <strong>manuscript number (JPOP<?php echo $row_rsCode['code']?>) </strong>in any future correspondence</span></p>
<p> </p>
<p>With best regards<br />
  <a href="http://journal-pop.org/" target="_blank"><span id="lw_1305987834_0">journal</span></a> POP<br />
  Editorial office </p>
</body>
<?php
mysql_free_result($rsCode);

mysql_free_result($rsAutorFullName);
?>
</html>