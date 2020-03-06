<?php require_once("../WA_SecurityAssist/WA_RandomPassword.php"); ?>
<?php require_once("../webassist/form_validations/wavt_scripts_php.php"); ?>
<?php require_once("../webassist/form_validations/wavt_validatedform_php.php"); ?>
<?php require_once('../Connections/localhost_i.php'); ?>
<?php require_once( "../webassist/security_assist/helper_php.php" ); ?>
<?php require_once('../webassist/mysqli/rsobj.php'); ?>
<?php require_once('../webassist/mysqli/queryobj.php'); ?>

<?php 
if (!WA_Auth_RulePasses("Autors_Reviewer_and_Editors")){
	WA_Auth_RestrictAccess("../users/users_LogIn.php?checkout=1");
}
?>
<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST")  {
  $WAFV_Redirect = "";
  $_SESSION['WAVT_mscrSendToReviewerNo1_218_Errors'] = "";
  if ($WAFV_Redirect == "")  {
    $WAFV_Redirect = $_SERVER["PHP_SELF"];
  }
  $WAFV_Errors = "";
  $WAFV_Errors .= WAValidateRQ(((isset($_POST["txtReviewer_2"]))?$_POST["txtReviewer_2"]:"") . "",false,2);

  if ($WAFV_Errors != "")  {
    PostResult($WAFV_Redirect,$WAFV_Errors,"mscrSendToReviewerNo1_218");
  }
}
?>
<?php include("../scripts/zeit.php") ; ?>
<?php
$rsMnscrpt = new WA_MySQLi_RS("rsMnscrpt",$localhost_i,1);
$rsMnscrpt->setQuery("SELECT mnscrpts.mscrID,  mnscrpts.mscrFullTitle, mnscrpts.mscrCodeU, mnscrpts.mscrUpldDate, CONCAT(users.UserFirstName,' ', users.UserLastName) AS  AutorFullName,  mnscrpts.mscrReviewerFullName_1, mnscrpts.mscrReviewerFullName_2, mnscrpts.mscrReviewerFullName_3, mnscrpts.mscrAutorID, users.UserEmail, mnscrpts.mscrReviewer_1, mnscrpts.mscrReviewer_2, mnscrpts.mscrReviewer_3, mnscrpts.mscrFileName FROM mnscrpts, users WHERE mnscrpts.mscrID=? AND users.UserID=mnscrpts.mscrAutorID");
$rsMnscrpt->bindParam("i", "".($_GET['mnscrpt_id'])  ."", "-1"); //colname
$rsMnscrpt->execute();
?>
<?php
$rsReviewer_2 = new WA_MySQLi_RS("rsReviewer_2",$localhost_i,1);
$rsReviewer_2->setQuery("SELECT users.UserID,  CONCAT(users.UserFirstName,' ', users.UserLastName,'   ','( ',users.UserEmail ,' ) ') AS FullName, users.UserLavel, status.statusID, users.UserEmail, CONCAT(users.UserFirstName,' ', users.UserLastName) AS ReviewerFullName FROM users, status WHERE status.statusID= users.UserLavel AND status.statusID>=2 AND status.statusID<=3 AND users.UserID=?");
$rsReviewer_2->bindParam("i", "".((isset($_POST["txtReviewer_2"]))?$_POST["txtReviewer_2"]:"")  ."", "-1"); //colname
$rsReviewer_2->execute();
?>
<?php
$rsReviewer = new WA_MySQLi_RS("rsReviewer",$localhost_i,1);
$rsReviewer->setQuery("SELECT users.UserID,  CONCAT(users.UserFirstName,' ', users.UserLastName,'   ','( ',users.UserEmail ,' ) ') AS FullName, users.UserLavel, status.statusID FROM users, status WHERE status.statusID= users.UserLavel AND status.statusID>=2  AND status.statusID<=3 ");
$rsReviewer->execute();
?>
<?php

if (!session_id()) session_start();
if ("" == "")     {
  $_SESSION["randomConfirm"] = "".$_SESSION['randomConfirm']  ."";
}?>
<?php
if (!session_id()) session_start();
if (isset($_POST["button"]))     {
  $_SESSION["confirmYes"] = "".WA_RandomPassword(9, true, true, true, "")  ."";
}?>
<?php
if (!session_id()) session_start();
if (isset($_POST["button"]))     {
  $_SESSION["confirmNo"] = "".WA_RandomPassword(9, true, true, true, "")  ."";
}?>
<?php
if ("" === "") {
  $InsertQuery = new WA_MySQLi_Query($localhost_i);
  $InsertQuery->Action = "insert";
  $InsertQuery->Table = "log";
  $InsertQuery->bindColumn("logUser", "s", "".$_SESSION['UserFirstName']  ." ".$_SESSION['UserLastName']  .", ".$_SESSION['UserEmail']  ."", "WA_BLANK");
  $InsertQuery->bindColumn("logIP", "s", "".((isset($_SERVER["REMOTE_ADDR"]))?$_SERVER["REMOTE_ADDR"]:"")  ."", "WA_BLANK");
  $InsertQuery->bindColumn("logContent", "s", "Send To Reviewer No 2", "WA_BLANK");
  $InsertQuery->saveInSession("log_logID");
  $InsertQuery->execute();
  $InsertGoTo = "";
  if (function_exists("rel2abs")) $InsertGoTo = $InsertGoTo?rel2abs($InsertGoTo,dirname(__FILE__)):"";
  $InsertQuery->redirect($InsertGoTo);
}
?>
<?php
if (($_SERVER["REQUEST_METHOD"] === "POST") && (isset($_SERVER["HTTP_REFERER"]) && strpos(urldecode($_SERVER["HTTP_REFERER"]), urldecode($_SERVER["SERVER_NAME"].$_SERVER["PHP_SELF"])) > 0) && isset($_POST)) {
  $UpdateQuery = new WA_MySQLi_Query($localhost_i);
  $UpdateQuery->Action = "update";
  $UpdateQuery->Table = "mnscrpts";
  $UpdateQuery->bindColumn("mscrDateToReviewer_2", "s", "to reviewer: ".$datumZ  ." ", "WA_BLANK");
  $UpdateQuery->bindColumn("mnscConfirmReviewer_2", "s", "".$null  ."", "WA_BLANK");
  $UpdateQuery->bindColumn("mnscrCodeConfirmYes_2", "s", "".$_SESSION['confirmYes']  ."", "WA_BLANK");
  $UpdateQuery->bindColumn("mnscrCodeConfirmNo_2", "s", "".$_SESSION['confirmNo']  ."", "WA_BLANK");
  $UpdateQuery->bindColumn("mnscrDateConfirm_2", "s", "".$null  ."", "WA_BLANK");
  $UpdateQuery->bindColumn("mscrReviewer_2", "s", "".((isset($_POST["txtReviewer_2"]))?$_POST["txtReviewer_2"]:"")  ."", "WA_BLANK");
  $UpdateQuery->bindColumn("mscrReviewerFullName_2", "s", "".$rsReviewer_2->getColumnVal('ReviewerFullName')  ."", "WA_BLANK");
  $UpdateQuery->bindColumn("mscrDateToReviewer", "s", "".((isset($_POST["dateNow"]))?$_POST["dateNow"]:"")  ."", "WA_BLANK");
  $UpdateQuery->addFilter("mscrID", "=", "d", "".$rsMnscrpt->getColumnVal('mscrID')  ."");
  $UpdateQuery->execute();
  $UpdateGoTo = "";
  if (function_exists("rel2abs")) $UpdateGoTo = $UpdateGoTo?rel2abs($UpdateGoTo,dirname(__FILE__)):"";
  $UpdateQuery->redirect($UpdateGoTo);
}
?>
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST")     {  //WA Universal Email
  $Email = new WA_Email("waue_mscr_SendToReviewerNo2_1");
  $Email->Redirect = "mscr_All.php";
  $Email->From = "Journal POP <ivilievltu@klaro-bg.com>";
  $Email->Importance = "1";
  $Email->BurstSize = "200";
  $Email->BurstTime = "1";
  $Email->WaitTime = "1";
  $Email->addTo("".$rsReviewer_2->getColumnVal('UserEmail')  ."");
  $Email->addTo("ivilievltu@yahoo.com");
  $Email->addTo("v.tsigov@yahoo.com");
  $Email->addTo("v.tsigov@gmail.com");
  $Email->addAttachment("../files/manuscripts/".$row_rsMnscrpt['mscrFileName']  ."");
  $Email->addAttachment("../files/attach/Checklist.doc");
  $Email->addAttachment("../files/attach/Instructions_for_reviewer.doc");
  $Email->BodyFile = "../webassist/email/waue_mscr_SendToReviewerNo2_1_body.php";
  if (function_exists("rel2abs") && $Email->Redirect) $Email->Redirect = $Email->Redirect?rel2abs($Email->Redirect,dirname(__FILE__)):"";
  for ($emailGroup=0; $emailGroup<sizeof($Email->To); $emailGroup++) {
    $Email->Subject = "Manuscript".$row_rsMnscrpt['mscrCodeU']  ." to review";
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

<title>Journal-POP - Select Reviewer No 2</title>
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
<script src="../webassist/progress_bar/jquery-blockui-formprocessing.js" type="text/javascript"></script>
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
      <div id="form1_ProgressWrapper">
        <form id="form1" name="form1" method="post" action="">
          <span class="title">Select Reviewer No 2</span>
          <hr />
          <table width="100%" border="0" cellpadding="0" cellspacing="2">
            <tr>
              <td width="13%" valign="top"><strong>Title:</strong></td>
              <td colspan="7" valign="top"><?php echo $rsMnscrpt->getColumnVal('mscrFullTitle'); ?></td>
              </tr>
            <tr>
              <td><strong>Manuscript No:</strong></td>
              <td colspan="5"><?php echo $rsMnscrpt->getColumnVal('mscrCodeU'); ?></td>
              <td width="33%" colspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td><strong>Autor:</strong></td>
              <td colspan="5"><?php echo $rsMnscrpt->getColumnVal('AutorFullName'); ?> ( <?php echo $rsMnscrpt->getColumnVal('UserEmail'); ?> )</td>
              <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td><strong>Upload Date:</strong></td>
              <td colspan="5"><?php echo $rsMnscrpt->getColumnVal('mscrUpldDate'); ?></td>
              <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan="5">&nbsp;</td>
              <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td><strong>Reviewer No 1:</strong></td>
              <td colspan="3"><?php echo $rsMnscrpt->getColumnVal('mscrReviewerFullName_1'); ?></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td><strong>
                <input name="dateNow" type="hidden" id="dateNow" value="<?php echo $datumZ; ?>" />
                Reviewer No 2:</strong></td>
              <td colspan="3"><select name="txtReviewer_2" id="txtReviewer_2">
                <option value="" <?php if (!(strcmp("", $rsMnscrpt->getColumnVal('mscrReviewer_2')))) {echo "selected=\"selected\"";} ?>>Select reviewer ...</option>
                <?php
while(!$rsReviewer->atEnd()) { //dyn select
?>
                <option value="<?php echo $rsReviewer->getColumnVal('UserID')?>"<?php if (!(strcmp($rsReviewer->getColumnVal('UserID'), $rsMnscrpt->getColumnVal('mscrReviewer_2')))) {echo "selected=\"selected\"";} ?>><?php echo $rsReviewer->getColumnVal('FullName')?></option>
                <?php
  $rsReviewer->moveNext();
} //dyn select
$rsReviewer->moveFirst();
?>
                </select> 
                <?php
if (ValidatedField('mscrSendToReviewerNo1_218','mscrSendToReviewerNo1_218'))  {
  if ((strpos((",".ValidatedField("mscrSendToReviewerNo1_218","mscrSendToReviewerNo1_218").","), "," . "2" . ",") !== false || "2" == ""))  {
    if (!(false))  {
?>
                  <span class="validation_text"> Please  select Reviewer </span>
                <?php //WAFV_Conditional mscr_SendToReviewerNo2.php mscrSendToReviewerNo1_218(2:)
    }
  }
}?></td>
              <td width="1%">&nbsp;</td>
              <td width="1%">&nbsp;</td>
              <td colspan="2"><a href="mscr_Reminder_2.php?mnscrpt_id=<?php echo $rsMnscrpt->getColumnVal('mscrID'); ?>">Reminder</a></td>
            </tr>
            <tr>
              <td><strong>Reviewer No 3:</strong></td>
              <td colspan="3"><?php echo $rsMnscrpt->getColumnVal('mscrReviewerFullName_3'); ?></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td width="8%">&nbsp;</td>
              <td width="13%">&nbsp;</td>
              <td width="31%">&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td><input type="submit" name="button" id="button" value="   Select   " /></td>
              <td><a href="mscr_All.php">Cancel</a></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td>[ <a href="javascript:history.back()">Go Back</a> ]</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td colspan="2">&nbsp;</td>
            </tr>
          </table>
        </form>
      </div>
    </div>
    <div id="form1_ProgressMessageWrapper" class="blockUIOverlay" style="display:none;">
      <script type="text/javascript">
WADFP_SetProgressToForm('form1', 'form1_ProgressMessageWrapper', WADFP_Theme_Options['BigSpin:Moab']);
    </script>
      <div id="form1_ProgressMessage" >
        <p style="margin:10px; padding:5px;" ><img src="../webassist/progress_bar/images/moab-largespin.gif" alt="" title="" style="vertical-align:middle;" />&nbsp;&nbsp;Please wait</p>
      </div>
    </div>
    <!-- InstanceEndEditable --></div>
  </div>
<div id="footer">Journal-POP &copy; 2011- 2015</div>
</div>
</body>
<!-- InstanceEnd --></html>