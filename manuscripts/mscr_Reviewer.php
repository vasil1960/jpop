<?php require_once('../Connections/localhost_i.php'); ?>
<?php require_once( "../webassist/security_assist/helper_php.php" ); ?>
<?php require_once('../webassist/mysqli/rsobj.php'); ?>
<?php require_once('../webassist/mysqli/queryobj.php'); ?>
<?php
if (!WA_Auth_RulePasses("Autors_Reviewer_and_Editors")){
	WA_Auth_RestrictAccess("../users/users_LogIn.php?checkout=1");
}

$currentPage = $_SERVER["PHP_SELF"];

?>
<?php
$rsForReviewer1 = new WA_MySQLi_RS("rsForReviewer1",$localhost_i,5);
$rsForReviewer1->setQuery("SELECT mnscrpts.mscrID, mnscrpts.mscrAutorID, mnscrpts.mscrFullTitle, mnscrpts.mscrCodeU, mnscrpts.mscrUpldDate, mnscrpts.mscrReviewer_1, mnscrpts.mscrFileReviewer_1, mnscrpts.mscrDateFileReviewer_1, mnscrpts.mnscConfirmReviewer_1, mnscrpts.mscrChecklist_1, mnscrDateConfirm_1 FROM mnscrpts WHERE mnscrpts.mscrReviewer_1=? ORDER BY mnscrpts.mscrID DESC");
$rsForReviewer1->bindParam("i", "".($_SESSION['UserID'])  ."", "-1"); //colname
$rsForReviewer1->execute();
?>
<?php
$rsForReviewer2 = new WA_MySQLi_RS("rsForReviewer2",$localhost_i,5);
$rsForReviewer2->setQuery("SELECT mnscrpts.mscrID, mnscrpts.mscrAutorID, mnscrpts.mscrFullTitle, mnscrpts.mscrCodeU, mnscrpts.mscrUpldDate, mnscrpts.mscrReviewer_2, mnscrpts.mscrFileReviewer_2, mnscrpts.mscrDateFileReviewer_2, mnscrpts.mnscConfirmReviewer_2, mnscrpts.mscrChecklist_2, mnscrDateConfirm_2 FROM mnscrpts WHERE mnscrpts.mscrReviewer_2=? ORDER BY mnscrpts.mscrID DESC");
$rsForReviewer2->bindParam("i", "".($_SESSION['UserID'])  ."", "-1"); //colname
$rsForReviewer2->execute();
?>
<?php
$rsForReviewer3 = new WA_MySQLi_RS("rsForReviewer3",$localhost_i,5);
$rsForReviewer3->setQuery("SELECT mnscrpts.mscrID, mnscrpts.mscrAutorID, mnscrpts.mscrFullTitle, mnscrpts.mscrCodeU, mnscrpts.mscrUpldDate, mnscrpts.mscrReviewer_3, mnscrpts.mscrFileReviewer_3, mnscrpts.mscrDateFileReviewer_3, mnscrpts.mnscConfirmReviewer_3, mnscrpts.mscrChecklist_3, mnscrDateConfirm_3 FROM mnscrpts WHERE mnscrpts.mscrReviewer_3=? ORDER BY mnscrpts.mscrID DESC");
$rsForReviewer3->bindParam("i", "".($_SESSION['UserID'])  ."", "-1"); //colname
$rsForReviewer3->execute();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/main.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<?php
if (!session_id()) session_start();
if ("" == "")     {
  $_SESSION["randomConfirm"] = "".$_SESSION['randomConfirm']  ."";
}

$queryString_rsForReviewer1 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsForReviewer1") == false && 
        stristr($param, "totalRows_rsForReviewer1") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsForReviewer1 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsForReviewer1 = sprintf("&totalRows_rsForReviewer1=%d%s", $rsForReviewer1->TotalRows, $queryString_rsForReviewer1);

$queryString_rsForReviewer2 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsForReviewer2") == false && 
        stristr($param, "totalRows_rsForReviewer2") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsForReviewer2 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsForReviewer2 = sprintf("&totalRows_rsForReviewer2=%d%s", $rsForReviewer2->TotalRows, $queryString_rsForReviewer2);

$queryString_rsForReviewer3 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsForReviewer3") == false && 
        stristr($param, "totalRows_rsForReviewer3") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsForReviewer3 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsForReviewer3 = sprintf("&totalRows_rsForReviewer3=%d%s", $rsForReviewer3->TotalRows, $queryString_rsForReviewer3);?>
<?php
if ("" === "") {
  $InsertQuery = new WA_MySQLi_Query($localhost_i);
  $InsertQuery->Action = "insert";
  $InsertQuery->Table = "log";
  $InsertQuery->bindColumn("logUser", "s", "".$_SESSION['UserFirstName']  ." ".$_SESSION['UserLastName']  .", ".$_SESSION['UserEmail']  ."", "WA_BLANK");
  $InsertQuery->bindColumn("logIP", "s", "".((isset($_SERVER["REMOTE_ADDR"]))?$_SERVER["REMOTE_ADDR"]:"")  ."", "WA_BLANK");
  $InsertQuery->bindColumn("logContent", "s", "Reviewer", "WA_BLANK");
  $InsertQuery->saveInSession("log_logID");
  $InsertQuery->execute();
  $InsertGoTo = "";
  if (function_exists("rel2abs")) $InsertGoTo = $InsertGoTo?rel2abs($InsertGoTo,dirname(__FILE__)):"";
  $InsertQuery->redirect($InsertGoTo);
}
?>
<title>Journal-pop - Manuscripts For Reviewer</title>
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
<!-- InstanceParam name="manuscript" type="text" value="current" -->
</head>

<body>
<div id="container">
  <div id="header">
    
  </div>
  <div id="navigation">
    
<ul>
        <li><a href="../index.php" class="">Home</a></li> 
        <li><a href="../users/users_LogIn.php" class="">Login</a></li>
    <li><a href="mscr_Submit.php" class="">Submit Manuscripts</a></li>        <li><a href="mscr_Index.php" class="current">Manuscripts</a></li>
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
      <span class="title">Manuscripts For Review</span>
      
      <div id="mainContent">
      <br />
      <?php if ($rsForReviewer1->TotalRows > 0) { // Show if mysqli recordset not empty ?>
          <strong>As Reviewer No 1:</strong><br /><br />
  <form id="formReviewer1" name="formReviewer1" method="post" action="">
  Manuscripts:
    <?php
for ($i=0; $i <= $totalPages_rsForReviewer1; $i++) {
  $TFM_counter = ($i) * $maxRows_rsForReviewer1 + 1;
  $TFM_endCounter = min($rsForReviewer1->TotalRows,$TFM_counter + $maxRows_rsForReviewer1 - 1);
  if($i != $pageNum_rsForReviewer1) {
    printf('<a href="'."%s?pageNum_rsForReviewer1=%d%s", $currentPage, $i, $queryString_rsForReviewer1.'">');
    echo "$TFM_counter-$TFM_endCounter</a>";
  }else{
    echo "<strong>$TFM_counter-$TFM_endCounter</strong>";
  }
  if($i != $totalPages_rsForReviewer1) echo " | ";
}
?>
    <?php
$wa_startindex = 0;
while(!$rsForReviewer1->atEnd()) {
  $wa_startindex = $rsForReviewer1->Index;
?>
      <div id="Reviewer_1">
        <table width="100%" border="0" cellspacing="5" cellpadding="0">
          <tr>
            <td width="8%" align="center" bgcolor="#FEED77"><?php echo $rsForReviewer1->getColumnVal('mscrCodeU'); ?></td>
            <td width="71%" height="22" bgcolor="#D8D8D8"><?php echo $rsForReviewer1->getColumnVal('mscrFullTitle'); ?></td>
            <td width="9%" align="center"><?php echo $rsForReviewer1->getColumnVal('mscrUpldDate'); ?></td>
            <td width="12%" align="center" bgcolor="#CCCCCC">[ <a href="mscr_UpldFileReviewer_1.php?mnscrpt_id=<?php echo $rsForReviewer1->getColumnVal('mscrID'); ?>&amp;reviewer1=<?php echo $rsForReviewer1->getColumnVal('mscrReviewer_1'); ?>">Upload file</a> ]</td>
          </tr>
          <tr>
            <td colspan="4" align="left">Received: [ <a href="../download/mainManuscriptFile.php?mnscrpt_id=<?php echo $rsForReviewer1->getColumnVal('mscrID'); ?>">Manuscript</a> ] [ <a href="mnsc_PhotographsAndGrapphs.php?mnscrpt_id=<?php echo $rsForReviewer1->getColumnVal('mscrID'); ?>">Photographs and Graphs</a> ] [ <a href="../download/Checlist.php">Checklist</a> ] [ <a href="../download/Instructions.php">Instructions</a> ] [ <?php echo $rsForReviewer1->getColumnVal('mscrUpldDate'); ?> ]</td>
          </tr>
          <tr>
            <td colspan="4" align="left">Confirmed: <?php echo $rsForReviewer1->getColumnVal('mnscrDateConfirm_1'); ?></td>
          </tr>
          <tr>
            <td colspan="4" align="left">Reviewed: [ <a href="../download/mscrFileChecklist_1.php?mnscrpt_id=<?php echo $rsForReviewer1->getColumnVal('mscrID'); ?>"><?php echo $rsForReviewer1->getColumnVal('mscrChecklist_1'); ?></a> ] [ <a href="../download/mnscrFileReviewer_1.php?mnscrpt_id=<?php echo $rsForReviewer1->getColumnVal('mscrID'); ?>"><?php echo $rsForReviewer1->getColumnVal('mscrFileReviewer_1'); ?></a> ] ( <?php echo $rsForReviewer1->getColumnVal('mscrDateFileReviewer_1'); ?> )</td>
          </tr>
        </table>
      </div>
      <?php
  $rsForReviewer1->moveNext();
}
$rsForReviewer1->moveFirst(); //return RS to first record
unset($wa_startindex);
unset($wa_repeatcount);
?>
Manuscripts:
<?php
for ($i=0; $i <= $totalPages_rsForReviewer1; $i++) {
  $TFM_counter = ($i) * $maxRows_rsForReviewer1 + 1;
  $TFM_endCounter = min($rsForReviewer1->TotalRows,$TFM_counter + $maxRows_rsForReviewer1 - 1);
  if($i != $pageNum_rsForReviewer1) {
    printf('<a href="'."%s?pageNum_rsForReviewer1=%d%s", $currentPage, $i, $queryString_rsForReviewer1.'">');
    echo "$TFM_counter-$TFM_endCounter</a>";
  }else{
    echo "<strong>$TFM_counter-$TFM_endCounter</strong>";
  }
  if($i != $totalPages_rsForReviewer1) echo " | ";
}
?>
  </form>
  <?php } // Show if mysqli recordset not empty ?>
  <?php if ($rsForReviewer1->TotalRows == 0) { // Show if mysqli recordset empty ?>
    No manuscripts as reviewer No 1
  <?php } // Show if mysqli recordset empty ?>
  <br />
       <?php if ($rsForReviewer2->TotalRows > 0) { // Show if mysqli recordset not empty ?>
          <strong>As Reviewer No 2:</strong><br /><br />
<form id="formReviewer2" name="formReviewer2" method="post" action="">
  Manuscripts:
  <?php
for ($i=0; $i <= $totalPages_rsForReviewer2; $i++) {
  $TFM_counter = ($i) * $maxRows_rsForReviewer2 + 1;
  $TFM_endCounter = min($rsForReviewer2->TotalRows,$TFM_counter + $maxRows_rsForReviewer2 - 1);
  if($i != $pageNum_rsForReviewer2) {
    printf('<a href="'."%s?pageNum_rsForReviewer2=%d%s", $currentPage, $i, $queryString_rsForReviewer2.'">');
    echo "$TFM_counter-$TFM_endCounter</a>";
  }else{
    echo "<strong>$TFM_counter-$TFM_endCounter</strong>";
  }
  if($i != $totalPages_rsForReviewer2) echo " | ";
}
?>
    
    <?php
$wa_startindex = 0;
while(!$rsForReviewer2->atEnd()) {
  $wa_startindex = $rsForReviewer2->Index;
?>
      <div id="Reviewer_2">
        
        
        <table width="100%" border="0" cellspacing="5" cellpadding="0">
          <tr>
            <td width="8%" align="center" bgcolor="#FEED77"><?php echo $rsForReviewer2->getColumnVal('mscrCodeU'); ?></td>
            <td width="71%" height="22" bgcolor="#D8D8D8"><?php echo $rsForReviewer2->getColumnVal('mscrFullTitle'); ?></td>
            <td width="9%" align="center"><?php echo $rsForReviewer2->getColumnVal('mscrUpldDate'); ?></td>
            <td width="12%" align="center" bgcolor="#CCCCCC">[ <a href="mscr_UpldFileReviewer_2.php?mnscrpt_id=<?php echo $rsForReviewer2->getColumnVal('mscrID'); ?>&amp;reviewer2=<?php echo $rsForReviewer2->getColumnVal('mscrReviewer_2'); ?>">Upload file</a> ]</td>
            </tr>
          <tr>
            <td colspan="4" align="left">Received: [ <a href="../download/mainManuscriptFile.php?mnscrpt_id=<?php echo $rsForReviewer2->getColumnVal('mscrID'); ?>">Manuscript</a> ] [ <a href="mnsc_PhotographsAndGrapphs.php?mnscrpt_id=<?php echo $rsForReviewer2->getColumnVal('mscrID'); ?>">Photographs and Graphs</a> ] [ <a href="../download/Checlist.php">Checklist</a> ] [ <a href="../download/Instructions.php">Instructions</a> ] [ <?php echo $rsForReviewer2->getColumnVal('mscrUpldDate'); ?> ]</td>
          </tr>
          <tr>
            <td colspan="4" align="left">Confirmed: <?php echo $rsForReviewer2->getColumnVal('mnscrDateConfirm_2'); ?></td>
          </tr>
          <tr>
            <td colspan="4" align="left">Reviewed: [ <a href="../download/mscrFileChecklist_2.php?mnscrpt_id=<?php echo $rsForReviewer2->getColumnVal('mscrID'); ?>"><?php echo $rsForReviewer2->getColumnVal('mscrChecklist_2'); ?></a> ] [ <a href="../download/mnscrFileReviewer_2.php?mnscrpt_id=<?php echo $rsForReviewer2->getColumnVal('mscrID'); ?>"><?php echo $rsForReviewer2->getColumnVal('mscrFileReviewer_2'); ?></a> ] ( <?php echo $rsForReviewer2->getColumnVal('mscrDateFileReviewer_2'); ?> )</td>
            </tr>
          </table>
        
        
        
      </div>
      <?php
  $rsForReviewer2->moveNext();
}
$rsForReviewer2->moveFirst(); //return RS to first record
unset($wa_startindex);
unset($wa_repeatcount);
?>
      Manuscripts:
    <?php
for ($i=0; $i <= $totalPages_rsForReviewer2; $i++) {
  $TFM_counter = ($i) * $maxRows_rsForReviewer2 + 1;
  $TFM_endCounter = min($rsForReviewer2->TotalRows,$TFM_counter + $maxRows_rsForReviewer2 - 1);
  if($i != $pageNum_rsForReviewer2) {
    printf('<a href="'."%s?pageNum_rsForReviewer2=%d%s", $currentPage, $i, $queryString_rsForReviewer2.'">');
    echo "$TFM_counter-$TFM_endCounter</a>";
  }else{
    echo "<strong>$TFM_counter-$TFM_endCounter</strong>";
  }
  if($i != $totalPages_rsForReviewer2) echo " | ";
}
?>           
</form>
  <?php } // Show if mysqli recordset not empty ?>
  <?php if ($rsForReviewer2->TotalRows == 0) { // Show if mysqli recordset empty ?>
    No manuscripts as reviewer No 2
  <?php } // Show if mysqli recordset empty ?>
  <br />
        <?php if ($rsForReviewer3->TotalRows > 0) { // Show if mysqli recordset not empty ?>
          <strong>As Reviewer No 3:</strong><br /><br />
  <form id="formReviewer3" name="formReviewer3" method="post" action="">
  Manuscripts:
    <?php
for ($i=0; $i <= $totalPages_rsForReviewer3; $i++) {
  $TFM_counter = ($i) * $maxRows_rsForReviewer3 + 1;
  $TFM_endCounter = min($rsForReviewer3->TotalRows,$TFM_counter + $maxRows_rsForReviewer3 - 1);
  if($i != $pageNum_rsForReviewer3) {
    printf('<a href="'."%s?pageNum_rsForReviewer3=%d%s", $currentPage, $i, $queryString_rsForReviewer3.'">');
    echo "$TFM_counter-$TFM_endCounter</a>";
  }else{
    echo "<strong>$TFM_counter-$TFM_endCounter</strong>";
  }
  if($i != $totalPages_rsForReviewer3) echo " | ";
}
?>
    <?php
$wa_startindex = 0;
while(!$rsForReviewer3->atEnd()) {
  $wa_startindex = $rsForReviewer3->Index;
?>
      <div id="Reviewer_3">
        <table width="100%" border="0" cellspacing="5" cellpadding="0">
          <tr>
            <td width="8%" align="center" bgcolor="#FEED77"><?php echo $rsForReviewer3->getColumnVal('mscrCodeU'); ?></td>
            <td width="71%" height="22" bgcolor="#D8D8D8"><?php echo $rsForReviewer3->getColumnVal('mscrFullTitle'); ?></td>
            <td width="9%" align="center"><?php echo $rsForReviewer3->getColumnVal('mscrUpldDate'); ?></td>
            <td width="12%" align="center" bgcolor="#CCCCCC">[ <a href="mscr_UpldFileReviewer_3.php?mnscrpt_id=<?php echo $rsForReviewer3->getColumnVal('mscrID'); ?>&amp;reviewer3=<?php echo $rsForReviewer3->getColumnVal('mscrReviewer_3'); ?>">Upload file</a> ]</td>
          </tr>
          <tr>
            <td colspan="4" align="left">Received: [ <a href="../download/mainManuscriptFile.php?mnscrpt_id=<?php echo $rsForReviewer3->getColumnVal('mscrID'); ?>">Manuscript</a> ] [ <a href="mnsc_PhotographsAndGrapphs.php?mnscrpt_id=<?php echo $rsForReviewer3->getColumnVal('mscrID'); ?>">Photographs and Graphs</a> ] [ <a href="../download/Checlist.php">Checklist</a> ] [ <a href="../download/Instructions.php">Instructions</a> ] [ <?php echo $rsForReviewer3->getColumnVal('mscrUpldDate'); ?> ]</td>
          </tr>
          <tr>
            <td colspan="4" align="left">Confirmed: <?php echo $rsForReviewer3->getColumnVal('mnscrDateConfirm_3'); ?></td>
          </tr>
          <tr>
            <td colspan="4" align="left">Reviewed: [ <a href="../download/mscrFileChecklist_3.php?mnscrpt_id=<?php echo $rsForReviewer3->getColumnVal('mscrID'); ?>"><?php echo $rsForReviewer3->getColumnVal('mscrChecklist_3'); ?></a> ] [ <a href="../download/mnscrFileReviewer_3.php?mnscrpt_id=<?php echo $rsForReviewer3->getColumnVal('mscrID'); ?>"><?php echo $rsForReviewer3->getColumnVal('mscrFileReviewer_3'); ?></a> ] ( <?php echo $rsForReviewer3->getColumnVal('mscrDateFileReviewer_3'); ?> )</td>
          </tr>
        </table>
      </div>
      <?php
  $rsForReviewer3->moveNext();
}
$rsForReviewer3->moveFirst(); //return RS to first record
unset($wa_startindex);
unset($wa_repeatcount);
?>
Manuscripts:
<?php
for ($i=0; $i <= $totalPages_rsForReviewer3; $i++) {
  $TFM_counter = ($i) * $maxRows_rsForReviewer3 + 1;
  $TFM_endCounter = min($rsForReviewer3->TotalRows,$TFM_counter + $maxRows_rsForReviewer3 - 1);
  if($i != $pageNum_rsForReviewer3) {
    printf('<a href="'."%s?pageNum_rsForReviewer3=%d%s", $currentPage, $i, $queryString_rsForReviewer3.'">');
    echo "$TFM_counter-$TFM_endCounter</a>";
  }else{
    echo "<strong>$TFM_counter-$TFM_endCounter</strong>";
  }
  if($i != $totalPages_rsForReviewer3) echo " | ";
}
?>
  </form>
  <?php } // Show if mysqli recordset not empty ?>
  <?php if ($rsForReviewer3->TotalRows == 0) { // Show if mysqli recordset empty ?>
    No manuscripts as reviewer No 3
  <?php } // Show if mysqli recordset empty ?>
  <br />
  <br />
[ <a href="javascript:history.back()">Go Back</a> ] </div>
    <!-- InstanceEndEditable --></div>
  </div>
<div id="footer">Journal-POP &copy; 2011- 2015</div>
</div>
</body>
<!-- InstanceEnd --></html>