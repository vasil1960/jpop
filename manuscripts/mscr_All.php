<?php require_once('../Connections/localhost_i.php'); ?>
<?php require_once( "../webassist/security_assist/helper_php.php" ); ?>
<?php require_once('../webassist/mysqli/rsobj.php'); ?>
<?php require_once('../webassist/mysqli/queryobj.php'); ?>
<?php require("../my_functions/my_php_functions.php"); ?>
<?php  
if (!WA_Auth_RulePasses("Autors_Reviewer_and_Editors")){
	WA_Auth_RestrictAccess("../users/users_LogIn.php?checkout=1");
}
?>
<?php
$currentPage = $_SERVER["PHP_SELF"];
?>
<?php
$rsMnscrpt = new WA_MySQLi_RS("rsMnscrpt",$localhost_i,15);
$rsMnscrpt->setQuery("SELECT users.UserID, users.UserEmail, CONCAT(users.UserFirstName,' ', users.UserLastName) AS FullName, mnscrpts.mscrID, mnscrpts.mscrFullTitle, mnscrpts.mscrCodeU, mnscrpts.mscrUpldDate, mnscrpts.mscrReviewerFullName_1, mnscrpts.mscrReviewerFullName_2, mnscrpts.mscrReviewerFullName_3, mnscrpts.mscrDateToReviewer, mnscrpts.mscrReviewer_1, mnscrpts.mscrReviewer_2, mnscrpts.mscrReviewer_3, mnscrpts.mscrFileReviewer_1, mnscrpts.mscrDateFileReviewer_1,  mnscrpts.mscrFileReviewer_2, mnscrpts.mscrDateFileReviewer_2, mnscrpts.mscrFileReviewer_3, mnscrpts.mscrDateFileReviewer_3,  mnscrpts.mnscStatus_1, mnscrpts.mnscStatus_2, mnscrpts.mnscStatus_3, mnscrpts.mnscStatus_4, mnscrpts.mscrFileCorrected, mnscrpts.mscrDateFileCorrected, mnscrpts.mnscConfirmReviewer_1, mnscrpts.mnscConfirmReviewer_2, mnscrpts.mnscConfirmReviewer_3, mnscrpts.mnscrDateConfirm_1, mnscrpts.mnscrDateConfirm_2, mnscrpts.mnscrDateConfirm_3, mnscrpts.mnscChecklistFileReviewer_1, mnscrpts.mnscChecklistFileReviewer_2, mnscrpts.mnscChecklistFileReviewer_3, mnscrpts.mscrChecklist_1, mnscrpts.mscrChecklist_2, mnscrpts.mscrChecklist_3, mnscrpts.mscrDateToReviewer_1, mnscrpts.mscrDateToReviewer_2, mnscrpts.mscrDateToReviewer_3, mnscrpts.mscrRecommendation_1, mnscrpts.mscrRecommendation_2, mnscrpts.mscrRecommendation_3, mnscrpts.mscrCorrected, mnscrpts.mscrMS_1, mnscrpts.mscrMS_2, mnscrpts.mscrMS_3, mnscrpts.mscrEditorsLetter, mnscrpts.mscrDateEditorsLetter, mnscrpts.mscrStatus, mnscrpts.mscrUploadProofFile, mnscrpts.mscrUploadProofDate, mnscrpts.mscrUploadProofEditorsFile, mnscrpts.mscrUploadProofEditorsFileDate FROM mnscrpts INNER JOIN users ON users.UserID= mnscrpts.mscrAutorID WHERE mnscrpts.mscrStatus = 0 ORDER BY mnscrpts.mscrID DESC");
$rsMnscrpt->execute();
?>
<?php
if (!session_id()) session_start();
if ("" == "")     {
  $_SESSION["randomConfirm"] = "".$_SESSION['randomConfirm']  ."";
}

$queryString_rsMnscrpt = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsMnscrpt") == false && 
        stristr($param, "totalRows_rsMnscrpt") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsMnscrpt = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsMnscrpt = sprintf("&totalRows_rsMnscrpt=%d%s", $rsMnscrpt->TotalRows, $queryString_rsMnscrpt);?>
<?php
if ("" === "") {
  $InsertQuery = new WA_MySQLi_Query($localhost_i);
  $InsertQuery->Action = "insert";
  $InsertQuery->Table = "log";
  $InsertQuery->bindColumn("logUser", "s", "".$_SESSION['UserFirstName']  ." ".$_SESSION['UserLastName']  .", ".$_SESSION['UserEmail']  ."", "WA_BLANK");
  $InsertQuery->bindColumn("logIP", "s", "".((isset($_SERVER["REMOTE_ADDR"]))?$_SERVER["REMOTE_ADDR"]:"")  ."", "WA_BLANK");
  $InsertQuery->bindColumn("logContent", "s", "All Manuscripts", "WA_BLANK");
  $InsertQuery->saveInSession("log_logID");
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
<title>Journal-pop - All Manuscripts</title>
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
<style type="text/css">
a:link {
	text-decoration: none;
	color: #666;
}
a:visited {
	text-decoration: none;
	color: #666;
}
a:hover {
	text-decoration: underline;
	color: #333;
}
a:active {
	text-decoration: none;
	color: #333;
}
</style><!-- InstanceEndEditable -->
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
    <?php if ($rsMnscrpt->TotalRows > 0) { // Show if mysqli recordset not empty ?>
  <div id="mainContent"><span class="title">All Manuscripts</span><hr />
    
      <label for="textfield"></label>
      <br />
      Manuscripts: 
      <?php
for ($i=0; $i <= $totalPages_rsMnscrpt; $i++) {
  $TFM_counter = ($i) * $maxRows_rsMnscrpt + 1;
  $TFM_endCounter = min($rsMnscrpt->TotalRows,$TFM_counter + $maxRows_rsMnscrpt - 1);
  if($i != $pageNum_rsMnscrpt) {
    printf('<a href="'."%s?pageNum_rsMnscrpt=%d%s", $currentPage, $i, $queryString_rsMnscrpt.'">');
    echo "$TFM_counter-$TFM_endCounter</a>";
  }else{
    echo "<strong>$TFM_counter-$TFM_endCounter</strong>";
  }
  if($i != $totalPages_rsMnscrpt) echo " | ";
}
?>
      <br />
      <br />
    
    <?php
$wa_startindex = 0;
while(!$rsMnscrpt->atEnd()) {
  $wa_startindex = $rsMnscrpt->Index;
?>
      <div id="all_manuscripts">
        <form id="form1" name="form1" method="post" action="">
          <table width="100%" border="0" cellpadding="0" cellspacing="1" id="tbl_all_manuscript">
          <tr>
            <td width="59" height="20" rowspan="2" align="center" valign="middle" bgcolor="<?php echo colorRecommendation($rsMnscrpt->getColumnVal('mscrRecommendation_1'),$rsMnscrpt->getColumnVal('mscrRecommendation_2'),$rsMnscrpt->getColumnVal('mscrRecommendation_3')); ?>"><a href="mscr_Status.php?manuscript=<?php echo $rsMnscrpt->getColumnVal('mscrID'); ?>"><?php echo $rsMnscrpt->getColumnVal('mscrCodeU'); ?></a></td>
            <td colspan="4" rowspan="2" align="left" valign="middle" bgcolor="#DFDFDF"><?php echo $rsMnscrpt->getColumnVal('mscrFullTitle'); ?></td>
            <td colspan="2" align="center" bgcolor="#DFDFDF"><?php echo $rsMnscrpt->getColumnVal('FullName'); ?></td>
          </tr>
          <tr>
            <td align="center" bgcolor="#DFDFDF"><?php echo $rsMnscrpt->getColumnVal('mscrUpldDate'); ?></td>
            <td align="center" bgcolor="#DFDFDF">[ <a href="../download/mainManuscriptFile.php?mnscrpt_id=<?php echo $rsMnscrpt->getColumnVal('mscrID'); ?>">Mamuscript</a> ]</td>
          </tr>
          <tr>
            <td colspan="2" align="left" valign="middle" bgcolor="#FFFFFF">1. [ <a href="mscr_SendToReviewerNo1.php?mnscrpt_id=<?php echo $rsMnscrpt->getColumnVal('mscrID'); ?>"><?php echo $rsMnscrpt->getColumnVal('mscrReviewerFullName_1'); ?></a> ] </td>
            <td width="122" align="left" valign="middle" bgcolor="#FFFFFF"><?php echo $rsMnscrpt->getColumnVal('mscrDateToReviewer_1'); ?></td>
            <td width="130" align="left" bgcolor="#FFFFFF">( <?php echo $rsMnscrpt->getColumnVal('mnscConfirmReviewer_1'); ?> - <?php echo $rsMnscrpt->getColumnVal('mnscrDateConfirm_1'); ?> )</td>
            <td width="190" align="center" bgcolor="#FFFFFF">[ <a href="../download/mscrFileChecklist_1.php?mnscrpt_id=<?php echo $rsMnscrpt->getColumnVal('mscrID'); ?>"><?php echo $rsMnscrpt->getColumnVal('mscrChecklist_1'); ?></a> ] [ <a href="../download/mnscrFileReviewer_1.php?mnscrpt_id=<?php echo $rsMnscrpt->getColumnVal('mscrID'); ?>"><?php echo $rsMnscrpt->getColumnVal('mscrMS_1'); ?></a> ] ( <?php echo $rsMnscrpt->getColumnVal('mscrDateFileReviewer_1'); ?> ) </td>
            <td width="90" align="left" bgcolor="#FFFFFF"><?php echo $rsMnscrpt->getColumnVal('mscrRecommendation_1'); ?></td>
            <td width="104" align="center" bgcolor="#FFFFFF">[ <a href="../coverLeter/coverLeter_Index.php?mnscrpt_id=<?php echo $rsMnscrpt->getColumnVal('mscrID'); ?>">Cover Letter</a> ]</td>
          </tr>
          <tr>
            <td colspan="2" align="left" valign="middle" bgcolor="#FFFFFF">2. [ <a href="mscr_SendToReviewerNo2.php?mnscrpt_id=<?php echo $rsMnscrpt->getColumnVal('mscrID'); ?>"><?php echo $rsMnscrpt->getColumnVal('mscrReviewerFullName_2'); ?></a> ] </td>
            <td align="left" valign="middle" bgcolor="#FFFFFF"><?php echo $rsMnscrpt->getColumnVal('mscrDateToReviewer_2'); ?></td>
            <td align="left" bgcolor="#FFFFFF">( <?php echo $rsMnscrpt->getColumnVal('mnscConfirmReviewer_2'); ?> - <?php echo $rsMnscrpt->getColumnVal('mnscrDateConfirm_2'); ?> )</td>
            <td align="center" bgcolor="#FFFFFF">[ <a href="../download/mscrFileChecklist_2.php?mnscrpt_id=<?php echo $rsMnscrpt->getColumnVal('mscrID'); ?>"><?php echo $rsMnscrpt->getColumnVal('mscrChecklist_2'); ?></a>  ] [ <a href="../download/mnscrFileReviewer_2.php?mnscrpt_id=<?php echo $rsMnscrpt->getColumnVal('mscrID'); ?>"><?php echo $rsMnscrpt->getColumnVal('mscrMS_2'); ?></a> ] ( <?php echo $rsMnscrpt->getColumnVal('mscrDateFileReviewer_2'); ?> ) </td>
            <td width="90" align="left" bgcolor="#FFFFFF"><?php echo $rsMnscrpt->getColumnVal('mscrRecommendation_2'); ?></td>
            <td width="104" align="center" bgcolor="#FFFFFF">[ <a href="../abstract/abstract_Index.php?mnscrpt_id=<?php echo $rsMnscrpt->getColumnVal('mscrID'); ?>">Abstract</a> ]</td>
          </tr>
          <tr>
            <td colspan="2" align="left" valign="middle" bgcolor="#FFFFFF">3. [ <a href="mscr_SendToReviewerNo3.php?mnscrpt_id=<?php echo $rsMnscrpt->getColumnVal('mscrID'); ?>"><?php echo $rsMnscrpt->getColumnVal('mscrReviewerFullName_3'); ?></a> ] </td>
            <td align="left" valign="middle" bgcolor="#FFFFFF"><?php echo $rsMnscrpt->getColumnVal('mscrDateToReviewer_3'); ?></td>
            <td align="left" bgcolor="#FFFFFF">( <?php echo $rsMnscrpt->getColumnVal('mnscConfirmReviewer_3'); ?> - <?php echo $rsMnscrpt->getColumnVal('mnscrDateConfirm_3'); ?> )</td>
            <td align="center" bgcolor="#FFFFFF">[ <a href="../download/mscrFileChecklist_3.php?mnscrpt_id=<?php echo $rsMnscrpt->getColumnVal('mscrID'); ?>"><?php echo $rsMnscrpt->getColumnVal('mscrChecklist_3'); ?></a> ] [ <a href="../download/mnscrFileReviewer_3.php?mnscrpt_id=<?php echo $rsMnscrpt->getColumnVal('mscrID'); ?>"><?php echo $rsMnscrpt->getColumnVal('mscrMS_3'); ?></a> ] ( <?php echo $rsMnscrpt->getColumnVal('mscrDateFileReviewer_3'); ?> ) </td>
            <td width="90" align="left" bgcolor="#FFFFFF"><?php echo $rsMnscrpt->getColumnVal('mscrRecommendation_3'); ?></td>
            <td width="104" align="center" bgcolor="#FFFFFF">[ <a href="mnsc_PhotographsAndGrapphs.php?mnscrpt_id=<?php echo $rsMnscrpt->getColumnVal('mscrID'); ?>">Figures</a> ]</td>
          </tr>
          <tr>
            <td height="14" colspan="4" align="left" valign="middle" bgcolor="#FFFFFF"></td>
            <td colspan="3" align="right" valign="middle" bgcolor="#FFFFFF">[ <a href="mscr_DirectReject.php?mnscrpt_id=<?php echo $rsMnscrpt->getColumnVal('mscrID'); ?>">Reject Manuscript</a> ]</td>
          </tr>
          <tr>
            <td height="14" colspan="3" align="left" valign="middle" bgcolor="#FFFFFF"><a href="mscr_UpldEditorsLeter.php?mnscrpt_id=<?php echo $rsMnscrpt->getColumnVal('mscrID'); ?>">Editor's Decision Commen</a><a href="mscr_UpldEditorsLeter.php?mnscrpt_id=<?php echo $rsMnscrpt->getColumnVal('mscrID'); ?>">t</a></td>
            <td height="14" colspan="2" align="left" valign="middle" bgcolor="#FFFFFF"><a href="../download/mscrEditorsLetter.php?download=<?php echo $rsMnscrpt->getColumnVal('mscrID'); ?>"><?php echo $rsMnscrpt->getColumnVal('mscrEditorsLetter'); ?></a> (<?php echo $rsMnscrpt->getColumnVal('mscrDateEditorsLetter'); ?>)</td>
            <td align="right" valign="middle" bgcolor="#FFFFFF">&nbsp;</td>
            <td align="center" valign="middle" bgcolor="#FFFFFF"><a href="mscr_UploadProofFile.php?mscr_id=<?php echo $rsMnscrpt->getColumnVal('mscrID'); ?>"></a></td>
          </tr>
          <tr>
            <td height="14" colspan="5" align="left" valign="middle" bgcolor="#FFFFFF">Corrected manuscript: <a href="../download/mnscrCorrectedFile.php?mnscrpt_id=<?php echo $rsMnscrpt->getColumnVal('mscrID'); ?>"> <?php echo $rsMnscrpt->getColumnVal('mscrCorrected'); ?></a> ( <?php echo $rsMnscrpt->getColumnVal('mscrDateFileCorrected'); ?> )</td>
            <td align="right" valign="middle" bgcolor="#FFFFFF">&nbsp;</td>
            <td align="center" valign="middle" bgcolor="#FFFFFF">&nbsp;</td>
          </tr>
          <tr>
            <td height="14" colspan="7" align="left" valign="middle" bgcolor="#FFFFFF"><a href="mscr_UploadProofFile.php?mscr_id=<?php echo $rsMnscrpt->getColumnVal('mscrID'); ?>">Proof</a>: <a href="../download/mscrProofFile.php?download=<?php echo $rsMnscrpt->getColumnVal('mscrID'); ?>"><?php echo $rsMnscrpt->getColumnVal('mscrUploadProofFile'); ?></a> (  <?php echo $rsMnscrpt->getColumnVal('mscrUploadProofDate'); ?> ) Editors Letter: <a href="../download/mscrProofEditorsLetter.php?download=<?php echo $rsMnscrpt->getColumnVal('mscrID'); ?>"><?php echo $rsMnscrpt->getColumnVal('mscrUploadProofEditorsFile'); ?></a> (<?php echo $rsMnscrpt->getColumnVal('mscrUploadProofEditorsFileDate'); ?>)</td>
            </tr>
          </table>
        </form>
      </div>
      <?php
  $rsMnscrpt->moveNext();
}
$rsMnscrpt->moveFirst(); //return RS to first record
unset($wa_startindex);
unset($wa_repeatcount);
?>
  </div>Manuscripts: 
      <?php
for ($i=0; $i <= $totalPages_rsMnscrpt; $i++) {
  $TFM_counter = ($i) * $maxRows_rsMnscrpt + 1;
  $TFM_endCounter = min($rsMnscrpt->TotalRows,$TFM_counter + $maxRows_rsMnscrpt - 1);
  if($i != $pageNum_rsMnscrpt) {
    printf('<a href="'."%s?pageNum_rsMnscrpt=%d%s", $currentPage, $i, $queryString_rsMnscrpt.'">');
    echo "$TFM_counter-$TFM_endCounter</a>";
  }else{
    echo "<strong>$TFM_counter-$TFM_endCounter</strong>";
  }
  if($i != $totalPages_rsMnscrpt) echo " | ";
}
?>
      <?php } // Show if mysqli recordset not empty ?>
      <?php if ($rsMnscrpt->TotalRows == 0) { // Show if mysqli recordset empty ?>
        No manuscripts
  <?php } // Show if mysqli recordset empty ?>
    <!-- InstanceEndEditable --></div>
  </div>
<div id="footer">Journal-POP &copy; 2011- 2015</div>
</div>
</body>
<!-- InstanceEnd --></html>