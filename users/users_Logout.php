<?php require_once('../Connections/localhost_i.php'); ?>
<?php require_once( "../webassist/security_assist/helper_php.php" ); ?>
<?php require_once('../webassist/mysqli/queryobj.php'); ?>
<?php
if ("" === "") {
  $InsertQuery = new WA_MySQLi_Query($localhost_i);
  $InsertQuery->Action = "insert";
  $InsertQuery->Table = "log";
  $InsertQuery->bindColumn("logUser", "s", "".$_SESSION['UserFirstName']  ." ".$_SESSION['UserLastName']  .", ".$_SESSION['UserEmail']  ."", "WA_BLANK");
  $InsertQuery->bindColumn("logIP", "s", "".((isset($_SERVER["REMOTE_ADDR"]))?$_SERVER["REMOTE_ADDR"]:"")  ."", "WA_BLANK");
  $InsertQuery->bindColumn("logContent", "s", "Log Out", "WA_BLANK");
  $InsertQuery->saveInSession("log_logID");
  $InsertQuery->execute();
  $InsertGoTo = "";
  if (function_exists("rel2abs")) $InsertGoTo = $InsertGoTo?rel2abs($InsertGoTo,dirname(__FILE__)):"";
  $InsertQuery->redirect($InsertGoTo);
}
?>
<?php
 
if (!session_id()) session_start();
if ("" == ""){
  // WA_ClearSession
	$clearAll = TRUE;
	$clearThese = explode(",","");
	if($clearAll){
		foreach ($_SESSION as $key => $value){
			unset($_SESSION[$key]);
		}
	}
	else{
		foreach($clearThese as $value){
			unset($_SESSION[$value]);
		}
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/main.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>journal-pop - Logout</title>
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
        <li><a href="users_LogIn.php" class="">Login</a></li>
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
    <span class="title">Logout</span>
  
    <div id="mainContent">
    <form id="form1" name="form1" method="post" action="">
      <p>You are logout. <a href="users_LogIn.php">Login</a>.</p>
</form>
</div>
  <!-- InstanceEndEditable --></div>
  </div>
<div id="footer">Journal-POP &copy; 2011- 2015</div>
</div>
</body>
<!-- InstanceEnd --></html>