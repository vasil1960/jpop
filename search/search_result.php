<?php require_once('../Connections/localhost_i.php'); ?>
<?php require_once( "../webassist/file_manipulation/helperphp.php" ); ?>
<?php require_once( "../webassist/security_assist/helper_php.php" ); ?>
<?php require_once('../webassist/mysqli/rsobj.php'); ?>
<?php require_once('../webassist/mysqli/queryobj.php'); ?>
<?php require("../my_functions/my_php_functions.php"); ?>
<?php
if (!WA_Auth_RulePasses("Editors")){
	WA_Auth_RestrictAccess("../users/users_LogIn.php");
}
?>
<?php
/////////////////////////////////////////////////////////////////
//$_POST = array_map("trim", $_POST);
//print_r($_POST);
/////////////////////////////////////////////////
?>
<?php
$rsSearch = new WA_MySQLi_RS("rsSearch",$localhost_i,0);
$rsSearch->setQuery("SELECT mnscrpts.mscrID, mnscrpts.mscrAutorID,  mnscrpts.mscrFullTitle, mnscrpts.mscrAbstract, mnscrpts.mscrKeywords, users.UserID, users.UserEmail,CONCAT_WS(' ', users.UserFirstName, users.UserLastName) AS FullAuthorName, users.UserLastName, mnscrpts.mscrCode, mnscrpts.mscrUpldDate, mnscrpts.mscrCodeU, mnscrpts.mscrCoverLeter, mnscrpts.mscrRecommendation_1, mnscrpts.mscrRecommendation_2, mnscrpts.mscrRecommendation_3 FROM mnscrpts INNER JOIN users ON mnscrpts.mscrAutorID = users.UserID WHERE CONCAT(UPPER(users.UserFirstName), ' ',UPPER(users.UserLastName)) LIKE UPPER(?) OR  UPPER(users.UserFirstName) LIKE UPPER(?) OR  UPPER(users.UserLastName) LIKE UPPER(?) OR  UPPER(mnscrpts.mscrAbstract) LIKE UPPER(?) OR   UPPER(mnscrpts.mscrFullTitle) LIKE UPPER(?) OR   UPPER(mnscrpts.mscrCoverLeter) LIKE UPPER(?) OR   UPPER(mnscrpts.mscrKeywords) LIKE UPPER(?) ");
$rsSearch->bindParam("s", "".($_POST['txtSearch'])  ."", "-1"); //colname
$rsSearch->execute();
?>
<?php
if (!($rsSearch->TotalRows == 0)) {
  $InsertQuery = new WA_MySQLi_Query($localhost_i);
  $InsertQuery->Action = "insert";
  $InsertQuery->Table = "log";
  $InsertQuery->bindColumn("logUser", "s", "".$_SESSION['UserFirstName']  ." ".$_SESSION['UserEmail']  ."", "WA_BLANK");
  $InsertQuery->bindColumn("logIP", "s", "".((isset($_SERVER["REMOTE_ADDR"]))?$_SERVER["REMOTE_ADDR"]:"")  ."", "WA_BLANK");
  $InsertQuery->bindColumn("logContent", "s", "Open search result site to show result", "WA_BLANK");
  $InsertQuery->saveInSession("searchresult");
  $InsertQuery->execute();
  $InsertGoTo = "";
  if (function_exists("rel2abs")) $InsertGoTo = $InsertGoTo?rel2abs($InsertGoTo,dirname(__FILE__)):"";
  $InsertQuery->redirect($InsertGoTo);
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
<meta charset="utf-8" />

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
    <li><a href="../manuscripts/mscr_Submit.php" class="">Submit Manuscripts</a></li>        <li><a href="../manuscripts/mscr_Index.php" class="">Manuscripts</a></li>
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
       
           <span class="title">Search Result</span><hr />
           <p><a href="javascript:history.back()">[ Back ]</a></p>
           <?php
$wa_startindex = 0;
while(!$rsSearch->atEnd()) {
  $wa_startindex = $rsSearch->Index;
?>
            <?php if ($rsSearch->TotalRows > 0) { // Show if mysqli recordset not empty ?>
              <div id="divSearchResult">
                <table width="100%" border="0" cellspacing="1" cellpadding="0">
  <tr>
    <td width="11%" rowspan="2" align="center"  bgcolor="<?php echo colorRecommendation($rsSearch->getColumnVal('mscrRecommendation_1'),$rsSearch->getColumnVal('mscrRecommendation_2'),$rsSearch->getColumnVal('mscrRecommendation_3')); ?>"><a href="../manuscripts/mscr_Status.php?manuscript=<?php echo $rsSearch->getColumnVal('mscrID'); ?>"><?php echo $rsSearch->getColumnVal('mscrCodeU'); ?></a></td>
    <td width="73%" rowspan="2" bgcolor="#DFDFDF"><?php echo $rsSearch->getColumnVal('mscrFullTitle'); ?></td>
    <td width="16%" align="center" bgcolor="#DFDFDF"><?php echo $rsSearch->getColumnVal('FullAuthorName'); ?></td>
    </tr>
  <tr>
    <td align="center" bgcolor="#DFDFDF"><?php echo $rsSearch->getColumnVal('mscrUpldDate'); ?></td>
  </tr>
  <tr>
    <td align="right" valign="top"><strong>Cover Letter:</strong></td>
    <td colspan="2"><?php echo $rsSearch->getColumnVal('mscrCoverLeter'); ?></td>
    </tr>
  <tr>
    <td align="right" valign="top"><strong>Abstract:</strong></td>
    <td colspan="2"><?php echo $rsSearch->getColumnVal('mscrAbstract'); ?></td>
    </tr>
  <tr>
    <td align="right" valign="top"><strong>Keywords:</strong></td>
    <td colspan="2"><?php echo $rsSearch->getColumnVal('mscrKeywords'); ?></td>
    </tr>
                </table>

              </div>
              <?php } // Show if mysqli recordset not empty ?>
<?php
  $rsSearch->moveNext();
}
$rsSearch->moveFirst(); //return RS to first record
unset($wa_startindex);
unset($wa_repeatcount);
?>
 <p><a href="javascript:history.back()">[ Back ]</a></p>
      </div>
      <?php if ($rsSearch->TotalRows == 0) { // Show if mysqli recordset empty ?>
        <div class="validation_text" id="divNoSearchResult ">No search result</div>
        <?php } // Show if mysqli recordset empty ?>
    <!-- InstanceEndEditable --></div>
  </div>
<div id="footer">Journal-POP &copy; 2011- 2015</div>
</div>
</body>
<!-- InstanceEnd --></html>