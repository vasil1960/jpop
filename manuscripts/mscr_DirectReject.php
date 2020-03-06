<?php require_once('../Connections/localhost_i.php'); ?>
<?php require_once( "../webassist/security_assist/helper_php.php" ); ?>
<?php require_once('../webassist/mysqli/rsobj.php'); ?>
<?php require_once('../webassist/mysqli/queryobj.php'); ?>
<?php
$rsDirectReject = new WA_MySQLi_RS("rsDirectReject",$localhost_i,1);
$rsDirectReject->setQuery("SELECT mnscrpts.mscrID, mnscrpts.mscrFullTitle, mnscrpts.mscrCodeU, mnscrpts.mscrRecommendation_1, mnscrpts.mscrRecommendation_2, mnscrpts.mscrRecommendation_3, users.UserFirstName, users.UserLastName, users.UserEmail FROM mnscrpts, users WHERE mnscrpts.mscrID=? AND users.UserID=mnscrpts.mscrAutorID");
$rsDirectReject->bindParam("i", "".($_GET['mnscrpt_id'])  ."", "-1"); //colname
$rsDirectReject->execute();
?>
<?php
if (isset($_POST["button"]) || isset($_POST["button_x"])) {
  $UpdateQuery = new WA_MySQLi_Query($localhost_i);
  $UpdateQuery->Action = "update";
  $UpdateQuery->Table = "mnscrpts";
  $UpdateQuery->bindColumn("mscrRecommendation_1", "s", "Rejected", "WA_BLANK");
  $UpdateQuery->bindColumn("mscrRecommendation_2", "s", "Rejected", "WA_BLANK");
  $UpdateQuery->bindColumn("mscrRecommendation_3", "s", "Rejected", "WA_BLANK");
  $UpdateQuery->addFilter("mscrID", "=", "d", "".$rsDirectReject->getColumnVal('mscrID')  ."");
  $UpdateQuery->execute();
  $UpdateGoTo = "mscr_All.php";
  if (function_exists("rel2abs")) $UpdateGoTo = $UpdateGoTo?rel2abs($UpdateGoTo,dirname(__FILE__)):"";
  $UpdateQuery->redirect($UpdateGoTo);
}
?>
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST")     {  //WA Universal Email
  $Email = new WA_Email("waue_mscr_DirectReject_1");
  $Email->From = "Journal POP <ivilievltu@klaro-bg.com>";
  $Email->BurstSize = "200";
  $Email->BurstTime = "1";
  $Email->WaitTime = "1";
  $Email->addTo("".$rsDirectReject->getColumnVal('UserEmail')  ."");
  $Email->addTo("ivilievltu@yahoo.com");
  $Email->addTo("v.tsigov@yahoo.com");
  $Email->addTo("v.tsigov@gmail.com");
  $Email->BodyFile = "../webassist/email/waue_mscr_DirectReject_1_body.php";
  if (function_exists("rel2abs") && $Email->Redirect) $Email->Redirect = $Email->Redirect?rel2abs($Email->Redirect,dirname(__FILE__)):"";
  for ($emailGroup=0; $emailGroup<sizeof($Email->To); $emailGroup++) {
    $Email->Subject = "Rejected Manuscript";
    $Email->send($emailGroup);
  }
  $Email->close();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/main.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Journal-pop</title>
<!-- InstanceEndEditable -->
<link href="../css/main.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<!-- InstanceParam name="home" type="text" value="" -->
<!-- InstanceParam name="contact" type="text" value="" -->
<!-- InstanceParam name="instructions" type="text" value="" -->
<!-- InstanceParam name="submit_paper" type="text" value="" -->
<!-- InstanceParam name="register" type="text" value="" -->
<!-- InstanceParam name="login" type="text" value="" -->
<!-- InstanceParam name="your_manuscript" type="text" value="" -->
<script type="text/javascript" src="../CSSMenuWriter/cssmw0/menu.js"></script>
<style type="text/css" media="all">
<!--
@import url("../CSSMenuWriter/cssmw0/menu.css");
-->
</style>
<!-- InstanceBeginEditable name="menu_ie" -->
<!--[if lte IE 6]>
<style type="text/css" media="all">
@import url("../CSSMenuWriter/cssmw0/menu_ie.css");
</style>

<![endif]-->
<!-- InstanceEndEditable -->
<script type="text/javascript" src="../CSSMenuWriter/cssmw1/menu.js"></script>
<style type="text/css" media="all">
<!--
@import url("../CSSMenuWriter/cssmw1/menu.css");
-->
</style>
<!--[if lte IE 6]>
<style type="text/css" media="all">
@import url("../CSSMenuWriter/cssmw1/menu_ie.css");
</style>

<![endif]-->
<script type="text/javascript" src="../CSSMenuWriter/cssmw2/menu.js"></script>
<style type="text/css" media="all">
<!--
@import url("../CSSMenuWriter/cssmw2/menu.css");
a:link {
	color: #366;
	text-decoration: underline;
}
a:visited {
	text-decoration: underline;
	color: #366;
}
a:hover {
	text-decoration: none;
	color: #396;
}
a:active {
	text-decoration: underline;
	color: #396;
}
-->
</style>
<!--[if lte IE 6]>
<style type="text/css" media="all">
@import url("../CSSMenuWriter/cssmw2/menu_ie.css");
</style>

<![endif]-->
<style type="text/css" media="all">
<!--
@import url("../CSSMenuWriter/cssmw2/menu.css");
-->
</style>
<!-- InstanceParam name="submit_manuscript" type="text" value="" -->
<!-- InstanceParam name="manuscript" type="text" value="" -->
</head>

<body>
<div id="container">
  <div id="header">
    
  </div>
  <div id="navigation">
    
<ul>
        <li><a href="../index.php" class="">Home</a></li> 
        <li><a href="../users/users_LogIn.php" class="">Login</a></li>
    <li><a href="mscr_Submit.php" class="">Submit Manuscripts</a></li>        <li><a href="mscr_Index.php" class="">Manuscripts</a></li>
      <li><a href="../users/users_Register.php" class="" >Register</a></li>
     <li><a href="../instructions/instructions_Index.php" class="">Instructions</a></li>
       <li><a href="../contacts/contacts_Index.php" class="">Contact</a></li>
        
    </ul>
    
  </div>
  <div id="mainContainer">
  <div id="sidebarLeft">
    
    <div id="login_left_siedebar">
      <?php if(WA_Auth_RulePasses("Autors_Reviewer_and_Editors")){ // Begin Show Region ?>
        <a href="../profile/profile_Index.php"><?php echo $_SESSION['UserEmail']; ?></a> 
        <?php } // End Show Region ?>
    </div> 
    <div id="autors_menu">
    <?php if(WA_Auth_RulePasses("Autors")){ // Begin Show Region ?>
     
        <?php require_once("../CSSMenuWriter/cssmw2/menu.php"); ?>
      
     <?php } // End Show Region ?>
      </div>
      
      <div id="reviewers_menu">
        <?php if(WA_Auth_RulePasses("Reviewer")){ // Begin Show Region ?>
          <?php require_once("../CSSMenuWriter/cssmw1/menu.php"); ?>
          <?php } // End Show Region ?>
      </div>
    <div id="editors_menu">
      <?php if(WA_Auth_RulePasses("Editors")){ // Begin Show Region ?>
        <?php require_once("../CSSMenuWriter/cssmw0/menu.php"); ?>
        <?php } // End Show Region ?>
    </div>
    
<!-- InstanceBeginEditable name="LeftSidebar" -->
      
    <!-- InstanceEndEditable --></div>
    <div id="content"><!-- InstanceBeginEditable name="mainContent" -->
      
      
      <div id="mainContent">
        <form id="form1" name="form1" method="post" action="">
           <span class="title">Reject Manuscript</span>
           <hr />
           <br />
           <table width="100%" border="0" cellpadding="0" cellspacing="3">
             <tr>
               <td width="11%"><?php echo $rsDirectReject->getColumnVal('mscrCodeU'); ?></td>
               <td width="89%"><?php echo $rsDirectReject->getColumnVal('mscrFullTitle'); ?></td>
             </tr>
             <tr>
               <td>Author:</td>
               <td><?php echo $rsDirectReject->getColumnVal('UserFirstName'); ?> <?php echo $rsDirectReject->getColumnVal('UserLastName'); ?></td>
             </tr>
             <tr>
               <td>Email:</td>
               <td><?php echo $rsDirectReject->getColumnVal('UserEmail'); ?></td>
             </tr>
             <tr>
               <td>&nbsp;</td>
               <td>&nbsp;</td>
             </tr>
             <tr>
               <td colspan="2"><input type="submit" name="button" id="button" value="Reject Manuscript" /> 
                 <a href="mscr_All.php">Cancel</a></td>
             </tr>
           </table>
        </form>
      </div>
    <!-- InstanceEndEditable --></div>
  </div>
<div id="footer">Journal-POP &copy; 2011- 2015</div>
</div>
</body>
<!-- InstanceEnd --></html>