<?php require_once('../Connections/localhost_i.php'); ?>
<?php require_once( "../webassist/security_assist/helper_php.php" ); ?>
<?php require_once('../webassist/mysqli/rsobj.php'); ?>
<?php require_once('../webassist/mysqli/queryobj.php'); ?>
<?php 
if (!WA_Auth_RulePasses("Autors_Reviewer_and_Editors")){
	WA_Auth_RestrictAccess("users_LogIn.php?checkout=1");
}

if (!session_id()) session_start();
if ("" == "")     {
  $_SESSION["randomConfirm"] = "".$_SESSION['randomConfirm']  ."";
}
?>
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $UpdateQuery = new WA_MySQLi_Query($localhost_i);
  $UpdateQuery->Action = "update";
  $UpdateQuery->Table = "users";
  $UpdateQuery->bindColumn("UserLavel", "d", "".((isset($_POST["txtStatus"]))?$_POST["txtStatus"]:"")  ."", "WA_BLANK");
  $UpdateQuery->addFilter("UserID", "=", "d", "".((isset($_POST["hiddenUserID"]))?$_POST["hiddenUserID"]:"")  ."");
  $UpdateQuery->execute();
  $UpdateGoTo = "users_Index.php";
  if (function_exists("rel2abs")) $UpdateGoTo = $UpdateGoTo?rel2abs($UpdateGoTo,dirname(__FILE__)):"";
  $UpdateQuery->redirect($UpdateGoTo);
}
?>
<?php
$rsStatus = new WA_MySQLi_RS("rsStatus",$localhost_i,1);
$rsStatus->setQuery("SELECT status.statusID, status.statusName FROM status");
$rsStatus->execute();
?>
<?php
$rsChangeRsersStatus = new WA_MySQLi_RS("rsChangeRsersStatus",$localhost_i,1);
$rsChangeRsersStatus->setQuery("SELECT * FROM users WHERE users.UserID=?");
$rsChangeRsersStatus->bindParam("i", "".($_GET['update'])  ."", "-1"); //colname
$rsChangeRsersStatus->execute();
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
<!-- InstanceParam name="login" type="text" value="current" -->
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
        <li><a href="users_LogIn.php" class="current">Login</a></li>
    <li><a href="../manuscripts/mscr_Submit.php" class="">Submit Manuscripts</a></li>        <li><a href="../manuscripts/mscr_Index.php" class="">Manuscripts</a></li>
      <li><a href="users_Register.php" class="" >Register</a></li>
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
<div id="left_sidebar">
  <p>&nbsp;</p>

</div>
<!-- InstanceEndEditable --></div>
    <div id="content"><!-- InstanceBeginEditable name="mainContent" -->
    <p class="title">Change User Status
   </p>
   
    <div id="mainContent"><form action="" method="post">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td colspan="5"><input name="hiddenUserID" type="hidden" id="hiddenUserID" value="<?php echo $rsChangeRsersStatus->getColumnVal('UserID'); ?>" /></td>
        </tr>
        <tr>
          <td width="3%"><?php echo $rsChangeRsersStatus->getColumnVal('UserID'); ?>.</td>
          <td width="19%"><?php echo $rsChangeRsersStatus->getColumnVal('UserEmail'); ?></td>
          <td width="16%"><?php echo $rsChangeRsersStatus->getColumnVal('UserFirstName'); ?> <?php echo $rsChangeRsersStatus->getColumnVal('UserLastName'); ?></td>
          <td width="18%"><label for="txtStatus"></label>
            <select name="txtStatus" id="txtStatus">
              <?php
while(!$rsStatus->atEnd()) { //dyn select
?>
              <option value="<?php echo $rsStatus->getColumnVal('statusID')?>"<?php if (!(strcmp($rsStatus->getColumnVal('statusID'), $rsChangeRsersStatus->getColumnVal('UserLavel')))) {echo "selected=\"selected\"";} ?>><?php echo $rsStatus->getColumnVal('statusName')?></option>
              <?php
  $rsStatus->moveNext();
} //dyn select
$rsStatus->moveFirst();
?>
            </select></td>
          <td width="44%"><input type="submit" name="button" id="button" value="Submit" /></td>
        </tr>
      </table>
    </form></div>
  <!-- InstanceEndEditable --></div>
  </div>
<div id="footer">Journal-POP &copy; 2011- 2015</div>
</div>
</body>
<!-- InstanceEnd --></html>