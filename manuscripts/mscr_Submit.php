<?php if (!session_id()) session_start(); ?>
<?php require_once('../Connections/localhost_i.php'); ?>
<?php require_once("../webassist/form_validations/wavt_scripts_php.php"); ?>
<?php require_once("../webassist/form_validations/wavt_validatedform_php.php"); ?>
<?php require_once( "../webassist/security_assist/helper_php.php" ); ?>
<?php require_once('../webassist/mysqli/rsobj.php'); ?>
<?php require_once('../webassist/mysqli/queryobj.php'); ?>
<?php include("../scripts/zeit.php"); ?>
<?php require_once("../webassist/email/WA_Email.php"); ?>
<?php
if (!WA_Auth_RulePasses("Autors_Reviewer_and_Editors")){
	WA_Auth_RestrictAccess("../users/users_LogIn.php?checkout=1");
}
?>
<?php require_once("../webassist/file_manipulation/helperphp.php"); ?>
<?php 
if ($_SERVER["REQUEST_METHOD"] === "POST")  {
  $WAFV_Redirect = "";
  $_SESSION['WAVT_mscrSubmit_Errors'] = "";
  if ($WAFV_Redirect == "")  {
    $WAFV_Redirect = $_SERVER["PHP_SELF"];
  }
  $WAFV_Errors = "";
  $WAFV_Errors .= WAValidateRQ(((isset($_POST["txtFullTitle"]))?$_POST["txtFullTitle"]:"") . "",false,2);
  $WAFV_Errors .= WAValidateRQ(((isset($_POST["txtAbstract"]))?$_POST["txtAbstract"]:"") . "",false,3);
  $WAFV_Errors .= WAValidateRQ(((isset($_POST["txtKeywords"]))?$_POST["txtKeywords"]:"") . "",false,4);
  $WAFV_Errors .= WAValidateRQ(((isset($_FILES["txtMscrptFile"]))?$_FILES["txtMscrptFile"]["name"]:"") . "",false,6);
  $WAFV_Errors .= WAValidateRQ(((isset($_POST["txtCoverLeter"]))?$_POST["txtCoverLeter"]:"") . "",false,7);
  $WAFV_Errors .= WAValidateRQ(((isset($_FILES["txtMscrptFile"]))?$_FILES["txtMscrptFile"]["name"]:"") . "",false,1);

  if ($WAFV_Errors != "")  {
    PostResult($WAFV_Redirect,$WAFV_Errors,"mscrSubmit");
  }
}
?>
<?php
$rsCode = new WA_MySQLi_RS("rsCode",$localhost_i,1);
$rsCode->setQuery("SELECT MAX(mnscrpts.mscrCode)+1 AS code FROM mnscrpts");
$rsCode->execute();
?>
<?php
$rsAutorFullName = new WA_MySQLi_RS("rsAutorFullName",$localhost_i,1);
$rsAutorFullName->setQuery("SELECT CONCAT(users.UserFirstName,' ', users.UserLastName) AS AutorFullName FROM users WHERE users.UserID=?");
$rsAutorFullName->bindParam("i", "".($_SESSION['UserID'])  ."", "-1"); //colname
$rsAutorFullName->execute();
?>
<?php
//$query_rsCode = "SELECT MAX(mnscrpts.mscrCode)+1 AS code FROM mnscrpts";
//$rsCode = mysql_query($query_rsCode, $localhost) or die(mysql_error());
//$row_rsCode = mysql_fetch_assoc($rsCode);
//$rsCode->TotalRows = mysql_num_rows($rsCode);
?>
<?php
if (!session_id()) session_start();
if ("" == "")     {
  $_SESSION["randomConfirm"] = "".$_SESSION['randomConfirm']  ."";
}?>
<?php
// WA_UploadResult1 Params Start
$WA_UploadResult1_Params = array();
// WA_UploadResult1_1 Start
$WA_UploadResult1_Params["WA_UploadResult1_1"] = array(
	'UploadFolder' => "../files/manuscripts/",
	'FileName' => "JPOP".$rsCode->getColumnVal('code')  ."",
	'DefaultFileName' => "",
	'ResizeType' => "0",
	'ResizeWidth' => "0",
	'ResizeHeight' => "0",
	'ResizeFillColor' => "" );
// WA_UploadResult1_1 End
// WA_UploadResult1 Params End?>
<?php
// WA_UploadResult2 Params Start
$WA_UploadResult2_Params = array();
// WA_UploadResult2_1 Start
$WA_UploadResult2_Params["WA_UploadResult2_1"] = array(
	'UploadFolder' => "../files/photographs/",
	'FileName' => "JPOP".$rsCode->getColumnVal('code')  ."_photo1",
	'DefaultFileName' => "",
	'ResizeType' => "0",
	'ResizeWidth' => "0",
	'ResizeHeight' => "0",
	'ResizeFillColor' => "" );
// WA_UploadResult2_1 End
// WA_UploadResult2 Params End?>
<?php
// WA_UploadResult3 Params Start
$WA_UploadResult3_Params = array();
// WA_UploadResult3_1 Start
$WA_UploadResult3_Params["WA_UploadResult3_1"] = array(
	'UploadFolder' => "../files/photographs/",
	'FileName' => "JPOP".$rsCode->getColumnVal('code')  ."_photo2",
	'DefaultFileName' => "",
	'ResizeType' => "0",
	'ResizeWidth' => "0",
	'ResizeHeight' => "0",
	'ResizeFillColor' => "" );
// WA_UploadResult3_1 End
// WA_UploadResult3 Params End?>
<?php
// WA_UploadResult4 Params Start
$WA_UploadResult4_Params = array();
// WA_UploadResult4_1 Start
$WA_UploadResult4_Params["WA_UploadResult4_1"] = array(
	'UploadFolder' => "../files/photographs/",
	'FileName' => "JPOP".$rsCode->getColumnVal('code')  ."_photo3",
	'DefaultFileName' => "",
	'ResizeType' => "0",
	'ResizeWidth' => "0",
	'ResizeHeight' => "0",
	'ResizeFillColor' => "" );
// WA_UploadResult4_1 End
// WA_UploadResult4 Params End?>
<?php
// WA_UploadResult5 Params Start
$WA_UploadResult5_Params = array();
// WA_UploadResult5_1 Start
$WA_UploadResult5_Params["WA_UploadResult5_1"] = array(
	'UploadFolder' => "../files/photographs/",
	'FileName' => "JPOP".$rsCode->getColumnVal('code')  ."_photo4",
	'DefaultFileName' => "",
	'ResizeType' => "0",
	'ResizeWidth' => "0",
	'ResizeHeight' => "0",
	'ResizeFillColor' => "" );
// WA_UploadResult5_1 End
// WA_UploadResult5 Params End?>
<?php
// WA_UploadResult6 Params Start
$WA_UploadResult6_Params = array();
// WA_UploadResult6_1 Start
$WA_UploadResult6_Params["WA_UploadResult6_1"] = array(
	'UploadFolder' => "../files/photographs/",
	'FileName' => "JPOP".$rsCode->getColumnVal('code')  ."_photo5",
	'DefaultFileName' => "",
	'ResizeType' => "0",
	'ResizeWidth' => "0",
	'ResizeHeight' => "0",
	'ResizeFillColor' => "" );
// WA_UploadResult6_1 End
// WA_UploadResult6 Params End?>
<?php
// WA_UploadResult7 Params Start
$WA_UploadResult7_Params = array();
// WA_UploadResult7_1 Start
$WA_UploadResult7_Params["WA_UploadResult7_1"] = array(
	'UploadFolder' => "../files/photographs/",
	'FileName' => "JPOP".$rsCode->getColumnVal('code')  ."_photo6",
	'DefaultFileName' => "",
	'ResizeType' => "0",
	'ResizeWidth' => "0",
	'ResizeHeight' => "0",
	'ResizeFillColor' => "" );
// WA_UploadResult7_1 End
// WA_UploadResult7 Params End?>
<?php
// WA_UploadResult8 Params Start
$WA_UploadResult8_Params = array();
// WA_UploadResult8_1 Start
$WA_UploadResult8_Params["WA_UploadResult8_1"] = array(
	'UploadFolder' => "../files/photographs/",
	'FileName' => "JPOP".$rsCode->getColumnVal('code')  ."_photo7",
	'DefaultFileName' => "",
	'ResizeType' => "0",
	'ResizeWidth' => "0",
	'ResizeHeight' => "0",
	'ResizeFillColor' => "" );
// WA_UploadResult8_1 End
// WA_UploadResult8 Params End?>
<?php
// WA_UploadResult9 Params Start
$WA_UploadResult9_Params = array();
// WA_UploadResult9_1 Start
$WA_UploadResult9_Params["WA_UploadResult9_1"] = array(
	'UploadFolder' => "../files/photographs/",
	'FileName' => "JPOP".$rsCode->getColumnVal('code')  ."_photo8",
	'DefaultFileName' => "",
	'ResizeType' => "0",
	'ResizeWidth' => "0",
	'ResizeHeight' => "0",
	'ResizeFillColor' => "" );
// WA_UploadResult9_1 End
// WA_UploadResult9 Params End?>
<?php
// WA_UploadResult10 Params Start
$WA_UploadResult10_Params = array();
// WA_UploadResult10_1 Start
$WA_UploadResult10_Params["WA_UploadResult10_1"] = array(
	'UploadFolder' => "../files/photographs/",
	'FileName' => "JPOP".$rsCode->getColumnVal('code')  ."_photo9",
	'DefaultFileName' => "",
	'ResizeType' => "0",
	'ResizeWidth' => "0",
	'ResizeHeight' => "0",
	'ResizeFillColor' => "" );
// WA_UploadResult10_1 End
// WA_UploadResult10 Params End?>
<?php
// WA_UploadResult11 Params Start
$WA_UploadResult11_Params = array();
// WA_UploadResult11_1 Start
$WA_UploadResult11_Params["WA_UploadResult11_1"] = array(
	'UploadFolder' => "../files/photographs/",
	'FileName' => "JPOP".$rsCode->getColumnVal('code')  ."_photo10",
	'DefaultFileName' => "",
	'ResizeType' => "0",
	'ResizeWidth' => "0",
	'ResizeHeight' => "0",
	'ResizeFillColor' => "" );
// WA_UploadResult11_1 End
// WA_UploadResult11 Params End?>
<?php
// WA_UploadResult12 Params Start
$WA_UploadResult12_Params = array();
// WA_UploadResult12_1 Start
$WA_UploadResult12_Params["WA_UploadResult12_1"] = array(
	'UploadFolder' => "../files/graphs/",
	'FileName' => "JPOP".$rsCode->getColumnVal('code')  ."_graph1",
	'DefaultFileName' => "",
	'ResizeType' => "0",
	'ResizeWidth' => "0",
	'ResizeHeight' => "0",
	'ResizeFillColor' => "" );
// WA_UploadResult12_1 End
// WA_UploadResult12 Params End?>
<?php
// WA_UploadResult13 Params Start
$WA_UploadResult13_Params = array();
// WA_UploadResult13_1 Start
$WA_UploadResult13_Params["WA_UploadResult13_1"] = array(
	'UploadFolder' => "../files/graphs/",
	'FileName' => "JPOP".$rsCode->getColumnVal('code')  ."_graph2",
	'DefaultFileName' => "",
	'ResizeType' => "0",
	'ResizeWidth' => "0",
	'ResizeHeight' => "0",
	'ResizeFillColor' => "" );
// WA_UploadResult13_1 End
// WA_UploadResult13 Params End?>
<?php
// WA_UploadResult14 Params Start
$WA_UploadResult14_Params = array();
// WA_UploadResult14_1 Start
$WA_UploadResult14_Params["WA_UploadResult14_1"] = array(
	'UploadFolder' => "../files/graphs/",
	'FileName' => "JPOP".$rsCode->getColumnVal('code')  ."_graph3",
	'DefaultFileName' => "",
	'ResizeType' => "0",
	'ResizeWidth' => "0",
	'ResizeHeight' => "0",
	'ResizeFillColor' => "" );
// WA_UploadResult14_1 End
// WA_UploadResult14 Params End?>
<?php
// WA_UploadResult15 Params Start
$WA_UploadResult15_Params = array();
// WA_UploadResult15_1 Start
$WA_UploadResult15_Params["WA_UploadResult15_1"] = array(
	'UploadFolder' => "../files/graphs/",
	'FileName' => "JPOP".$rsCode->getColumnVal('code')  ."_graph4",
	'DefaultFileName' => "",
	'ResizeType' => "0",
	'ResizeWidth' => "0",
	'ResizeHeight' => "0",
	'ResizeFillColor' => "" );
// WA_UploadResult15_1 End
// WA_UploadResult15 Params End?>
<?php
// WA_UploadResult16 Params Start
$WA_UploadResult16_Params = array();
// WA_UploadResult16_1 Start
$WA_UploadResult16_Params["WA_UploadResult16_1"] = array(
	'UploadFolder' => "../files/graphs/",
	'FileName' => "JPOP".$rsCode->getColumnVal('code')  ."_graph5",
	'DefaultFileName' => "",
	'ResizeType' => "0",
	'ResizeWidth' => "0",
	'ResizeHeight' => "0",
	'ResizeFillColor' => "" );
// WA_UploadResult16_1 End
// WA_UploadResult16 Params End
?>
<?php
WA_DFP_SetupUploadStatusStruct("WA_UploadResult1");
if($_SERVER["REQUEST_METHOD"] === "POST"){
	WA_DFP_UploadFiles("WA_UploadResult1", "txtMscrptFile", "0", "", "false", $WA_UploadResult1_Params);
}
?>
<?php
WA_DFP_SetupUploadStatusStruct("WA_UploadResult2");
if($_SERVER["REQUEST_METHOD"] === "POST"){
	WA_DFP_UploadFiles("WA_UploadResult2", "txtPhoto_1", "0", "", "false", $WA_UploadResult2_Params);
}
?>
<?php
WA_DFP_SetupUploadStatusStruct("WA_UploadResult3");
if($_SERVER["REQUEST_METHOD"] == "POST"){
	WA_DFP_UploadFiles("WA_UploadResult3", "txtPhoto_2", "0", "", "false", $WA_UploadResult3_Params);
}
?>
<?php
WA_DFP_SetupUploadStatusStruct("WA_UploadResult4");
if($_SERVER["REQUEST_METHOD"] == "POST"){
	WA_DFP_UploadFiles("WA_UploadResult4", "txtPhoto_3", "0", "", "false", $WA_UploadResult4_Params);
}
?>
<?php
WA_DFP_SetupUploadStatusStruct("WA_UploadResult5");
if($_SERVER["REQUEST_METHOD"] == "POST"){
	WA_DFP_UploadFiles("WA_UploadResult5", "txtPhoto_4", "0", "", "false", $WA_UploadResult5_Params);
}
?>
<?php
WA_DFP_SetupUploadStatusStruct("WA_UploadResult6");
if($_SERVER["REQUEST_METHOD"] == "POST"){
	WA_DFP_UploadFiles("WA_UploadResult6", "txtPhoto_5", "0", "", "false", $WA_UploadResult6_Params);
}
?>
<?php
WA_DFP_SetupUploadStatusStruct("WA_UploadResult7");
if($_SERVER["REQUEST_METHOD"] == "POST"){
	WA_DFP_UploadFiles("WA_UploadResult7", "txtPhoto_6", "0", "", "false", $WA_UploadResult7_Params);
}
?>
<?php
WA_DFP_SetupUploadStatusStruct("WA_UploadResult8");
if($_SERVER["REQUEST_METHOD"] == "POST"){
	WA_DFP_UploadFiles("WA_UploadResult8", "txtPhoto_7", "0", "", "false", $WA_UploadResult8_Params);
}
?>
<?php
WA_DFP_SetupUploadStatusStruct("WA_UploadResult9");
if($_SERVER["REQUEST_METHOD"] == "POST"){
	WA_DFP_UploadFiles("WA_UploadResult9", "txtPhoto_8", "0", "", "false", $WA_UploadResult9_Params);
}
?>
<?php
WA_DFP_SetupUploadStatusStruct("WA_UploadResult10");
if($_SERVER["REQUEST_METHOD"] == "POST"){
	WA_DFP_UploadFiles("WA_UploadResult10", "txtPhoto_9", "0", "", "false", $WA_UploadResult10_Params);
}
?>
<?php
WA_DFP_SetupUploadStatusStruct("WA_UploadResult11");
if($_SERVER["REQUEST_METHOD"] == "POST"){
	WA_DFP_UploadFiles("WA_UploadResult11", "txtPhoto_10", "0", "", "false", $WA_UploadResult11_Params);
}
?>
<?php
WA_DFP_SetupUploadStatusStruct("WA_UploadResult12");
if($_SERVER["REQUEST_METHOD"] == "POST"){
	WA_DFP_UploadFiles("WA_UploadResult12", "txtGraphs_1", "0", "", "false", $WA_UploadResult12_Params);
}
?>
<?php
WA_DFP_SetupUploadStatusStruct("WA_UploadResult13");
if($_SERVER["REQUEST_METHOD"] == "POST"){
	WA_DFP_UploadFiles("WA_UploadResult13", "txtGraphs_2", "0", "", "false", $WA_UploadResult13_Params);
}
?>
<?php
WA_DFP_SetupUploadStatusStruct("WA_UploadResult14");
if($_SERVER["REQUEST_METHOD"] == "POST"){
	WA_DFP_UploadFiles("WA_UploadResult14", "txtGraphs_3", "0", "", "false", $WA_UploadResult14_Params);
}
?>
<?php
WA_DFP_SetupUploadStatusStruct("WA_UploadResult15");
if($_SERVER["REQUEST_METHOD"] == "POST"){
	WA_DFP_UploadFiles("WA_UploadResult15", "txtGraphs_4", "0", "", "false", $WA_UploadResult15_Params);
}
?>
<?php
WA_DFP_SetupUploadStatusStruct("WA_UploadResult16");
if($_SERVER["REQUEST_METHOD"] == "POST"){
	WA_DFP_UploadFiles("WA_UploadResult16", "txtGraphs_5", "0", "", "false", $WA_UploadResult16_Params);
}
?>
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $InsertQuery = new WA_MySQLi_Query($localhost_i);
  $InsertQuery->Action = "insert";
  $InsertQuery->Table = "mnscrpts";
  $InsertQuery->bindColumn("mscrAutorID", "d", "".$_SESSION['UserID']  ."", "WA_BLANK");
  $InsertQuery->bindColumn("mscrCoverLeter", "s", "".((isset($_POST["txtCoverLeter"]))?$_POST["txtCoverLeter"]:"")  ."", "WA_BLANK");
  $InsertQuery->bindColumn("mscrFullTitle", "s", "".((isset($_POST["txtFullTitle"]))?$_POST["txtFullTitle"]:"")  ."", "WA_BLANK");
  $InsertQuery->bindColumn("mscrAbstract", "s", "".((isset($_POST["txtAbstract"]))?$_POST["txtAbstract"]:"")  ."", "WA_BLANK");
  $InsertQuery->bindColumn("mscrKeywords", "s", "".((isset($_POST["txtKeywords"]))?$_POST["txtKeywords"]:"")  ."", "WA_BLANK");
  $InsertQuery->bindColumn("mscrComment", "s", "".((isset($_POST["txtComment"]))?$_POST["txtComment"]:"")  ."", "WA_BLANK");
  $InsertQuery->bindColumn("mscrCode", "d", "".$rsCode->getColumnVal('code')  ."", "WA_BLANK");
  $InsertQuery->bindColumn("mscrCodeU", "s", "JPOP".$rsCode->getColumnVal('code')  ."", "WA_BLANK");
  $InsertQuery->bindColumn("mscrUpldDate", "s", "".((isset($_POST["dateNow"]))?$_POST["dateNow"]:"")  ."", "WA_BLANK");
  $InsertQuery->bindColumn("mscrFileName", "s", "".$WA_DFP_UploadStatus["WA_UploadResult1"]["serverFileName"]  ."", "WA_BLANK");
  $InsertQuery->bindColumn("mscrReviewerFullName_1", "s", "Reviewer No 1", "WA_BLANK");
  $InsertQuery->bindColumn("mscrReviewerFullName_2", "s", "Reviewer No 2", "WA_BLANK");
  $InsertQuery->bindColumn("mscrReviewerFullName_3", "s", "Reviewer No 3", "WA_BLANK");
  $InsertQuery->bindColumn("mscrFotos_1", "s", "".$WA_DFP_UploadStatus["WA_UploadResult2"]["serverFileName"]  ."", "WA_BLANK");
  $InsertQuery->bindColumn("mscrFotos_2", "s", "".$WA_DFP_UploadStatus["WA_UploadResult3"]["serverFileName"]  ."", "WA_BLANK");
  $InsertQuery->bindColumn("mscrFotos_3", "s", "".$WA_DFP_UploadStatus["WA_UploadResult4"]["serverFileName"]  ."", "WA_BLANK");
  $InsertQuery->bindColumn("mscrFotos_4", "s", "".$WA_DFP_UploadStatus["WA_UploadResult5"]["serverFileName"]  ."", "WA_BLANK");
  $InsertQuery->bindColumn("mscrFotos_5", "s", "".$WA_DFP_UploadStatus["WA_UploadResult6"]["serverFileName"]  ."", "WA_BLANK");
  $InsertQuery->bindColumn("mscrFotos_6", "s", "".$WA_DFP_UploadStatus["WA_UploadResult7"]["serverFileName"]  ."", "WA_BLANK");
  $InsertQuery->bindColumn("mscrFotos_7", "s", "".$WA_DFP_UploadStatus["WA_UploadResult8"]["serverFileName"]  ."", "WA_BLANK");
  $InsertQuery->bindColumn("mscrFotos_8", "s", "".$WA_DFP_UploadStatus["WA_UploadResult9"]["serverFileName"]  ."", "WA_BLANK");
  $InsertQuery->bindColumn("mscrFotos_9", "s", "".$WA_DFP_UploadStatus["WA_UploadResult10"]["serverFileName"]  ."", "WA_BLANK");
  $InsertQuery->bindColumn("mscrFotos_10", "s", "".$WA_DFP_UploadStatus["WA_UploadResult11"]["serverFileName"]  ."", "WA_BLANK");
  $InsertQuery->bindColumn("mscrGraph_1", "s", "".$WA_DFP_UploadStatus["WA_UploadResult12"]["serverFileName"]  ."", "WA_BLANK");
  $InsertQuery->bindColumn("mscrGraph_2", "s", "".$WA_DFP_UploadStatus["WA_UploadResult13"]["serverFileName"]  ."", "WA_BLANK");
  $InsertQuery->bindColumn("mscrGraph_3", "s", "".$WA_DFP_UploadStatus["WA_UploadResult14"]["serverFileName"]  ."", "WA_BLANK");
  $InsertQuery->bindColumn("mscrGraph_4", "s", "".$WA_DFP_UploadStatus["WA_UploadResult15"]["serverFileName"]  ."", "WA_BLANK");
  $InsertQuery->bindColumn("mscrGraph_5", "s", "".$WA_DFP_UploadStatus["WA_UploadResult16"]["serverFileName"]  ."", "WA_BLANK");
  $InsertQuery->saveInSession("mnscrpts_mscrID");
  $InsertQuery->execute();
  $InsertGoTo = "";
  if (function_exists("rel2abs")) $InsertGoTo = $InsertGoTo?rel2abs($InsertGoTo,dirname(__FILE__)):"";
  $InsertQuery->redirect($InsertGoTo);
}
?>
<?php
if ("" === "") {
  $InsertQuery = new WA_MySQLi_Query($localhost_i);
  $InsertQuery->Action = "insert";
  $InsertQuery->Table = "log";
  $InsertQuery->bindColumn("logUser", "s", "".$_SESSION['UserFirstName']  ." ".$_SESSION['UserLastName']  .", ".$_SESSION['UserEmail']  ."", "WA_BLANK");
  $InsertQuery->bindColumn("logIP", "s", "".((isset($_SERVER["REMOTE_ADDR"]))?$_SERVER["REMOTE_ADDR"]:"")  ."", "WA_BLANK");
  $InsertQuery->bindColumn("logContent", "s", "Submit manuscript", "WA_BLANK");
  $InsertQuery->saveInSession("log_logID");
  $InsertQuery->execute();
  $InsertGoTo = "";
  if (function_exists("rel2abs")) $InsertGoTo = $InsertGoTo?rel2abs($InsertGoTo,dirname(__FILE__)):"";
  $InsertQuery->redirect($InsertGoTo);
}
?>
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST")     {  //WA Universal Email
  $Email = new WA_Email("waue_mscr_Submit_1");
  $Email->Redirect = "mscr_ThankYou.php";
  $Email->From = "journal POP <ivilievltu@klaro-bg.com>";
  $Email->BurstSize = "200";
  $Email->BurstTime = "1";
  $Email->WaitTime = "1";
  $Email->CharSet = "UTF-8";
  $Email->addTo("".$_SESSION['UserEmail']  ."");
  $Email->addAttachment("../files/attach/CONSENT_for_AUTHORS.doc");
  $Email->BodyFile = "../webassist/email/waue_mscr_Submit_1_body.php";
  if (function_exists("rel2abs") && $Email->Redirect) $Email->Redirect = $Email->Redirect?rel2abs($Email->Redirect,dirname(__FILE__)):"";
  for ($emailGroup=0; $emailGroup<sizeof($Email->To); $emailGroup++) {
    $Email->Subject = "Instructions to  author";
    $Email->send($emailGroup);
  }
  $Email->close();
}
?>
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST")     {  //WA Universal Email
  $Email = new WA_Email("waue_mscr_Submit_2");
  $Email->From = "ivilievltu@klaro-bg.com";
  $Email->BurstSize = "200";
  $Email->BurstTime = "1";
  $Email->WaitTime = "1";
  $Email->CharSet = "UTF-8";
  $Email->addTo("ivilievltu@yahoo.com");
  $Email->addTo("v.tsigov@gmail.com");
  $Email->BodyFile = "../webassist/email/waue_mscr_Submit_2_body.php";
  if (function_exists("rel2abs") && $Email->Redirect) $Email->Redirect = $Email->Redirect?rel2abs($Email->Redirect,dirname(__FILE__)):"";
  for ($emailGroup=0; $emailGroup<sizeof($Email->To); $emailGroup++) {
    $Email->Subject = "Manuscript upload and send to system";
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
<title>Journal-pop - Submit Manuscripts</title>
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
<script src="http://code.jquery.com/jquery-1.6.1.js"></script>

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
<!-- InstanceParam name="submit_manuscript" type="text" value="current" -->
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
    <li><a href="mscr_Submit.php" class="current">Submit Manuscripts</a></li>        <li><a href="mscr_Index.php" class="">Manuscripts</a></li>
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
    <div id="mainContent"> <span class="title">Submit Manuscript</span><hr /><br />
      <div id="form1_ProgressWrapper">
        <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td valign="top"><input name="dateNow" type="hidden" id="dateNow" value="<?php echo $datumZ; ?>" /></td>
              <td class="validation_text"><?php
if (ValidatedField('mscrSubmit','mscrSubmit'))  {
  if ((strpos((",".ValidatedField("mscrSubmit","mscrSubmit").","), "," . "" . ",") !== false || "" == ""))  {
    if (!(false))  {
?>
                Please correct all (in red)
                <?php //WAFV_Conditional mscr_Submit.php mscrSubmit( :)
    }
  }
}
?></td>
            </tr>
            <tr>
              <td width="10%" valign="top"><span class="zvezda">*</span> Cover Letter:</td>
              <td width="90%"><label for="txtCoverLeter"></label>
                <textarea name="txtCoverLeter" cols="60" rows="10" id="txtCoverLeter" ></textarea></td>
            </tr>
            <tr>
              <td height="31" valign="top">&nbsp;</td>
              <td class="validation_text"><?php
if (ValidatedField('mscrSubmit','mscrSubmit'))  {
  if ((strpos((",".ValidatedField("mscrSubmit","mscrSubmit").","), "," . "7" . ",") !== false || "7" == ""))  {
    if (!(false))  {
?>
                Please enter your cover leter.
                <?php //WAFV_Conditional mscr_Submit.php mscrSubmit(7:)
    }
  }
}

?></td>
            </tr>
            <tr>
              <td valign="top"><span class="zvezda">*</span> Full Title:</td>
              <td><label for="txtFullTitle"></label>
                <textarea name="txtFullTitle" id="txtFullTitle" cols="60" rows="10"></textarea></td>
            </tr>
            <tr>
              <td valign="top">&nbsp;</td>
              <td><?php
if (ValidatedField('mscrSubmit','mscrSubmit'))  {
  if ((strpos((",".ValidatedField("mscrSubmit","mscrSubmit").","), "," . "2" . ",") !== false || "2" == ""))  {
    if (!(false))  {
?>
                <span class="validation_text">Please enter your full title.</span>
                <?php //WAFV_Conditional mscr_Submit.php mscrSubmit(2:)
    }
  }
}
?></td>
            </tr>
            <tr>
              <td valign="top"><span class="zvezda">*</span> Abstract:</td>
              <td><label for="txtAbstract"></label>
                <textarea name="txtAbstract" id="txtAbstract" cols="60" rows="10"></textarea></td>
            </tr>
            <tr>
              <td valign="top">&nbsp;</td>
              <td><?php
if (ValidatedField('mscrSubmit','mscrSubmit'))  {
  if ((strpos((",".ValidatedField("mscrSubmit","mscrSubmit").","), "," . "3" . ",") !== false || "3" == ""))  {
    if (!(false))  {
?>
                <span class="validation_text">Please enter your abstact.</span>
                <?php //WAFV_Conditional mscr_Submit.php mscrSubmit(3:)
    }
  }
}
?></td>
            </tr>
            <tr>
              <td valign="top"><span class="zvezda">*</span> Keywords:</td>
              <td><label for="txtKeywords"></label>
                <textarea name="txtKeywords" id="txtKeywords" cols="60" rows="10"></textarea></td>
            </tr>
            <tr>
              <td valign="top">&nbsp;</td>
              <td><?php
if (ValidatedField('mscrSubmit','mscrSubmit'))  {
  if ((strpos((",".ValidatedField("mscrSubmit","mscrSubmit").","), "," . "4" . ",") !== false || "4" == ""))  {
    if (!(false))  {
?>
                <span class="validation_text">Please enter your keywords.</span>
                <?php //WAFV_Conditional mscr_Submit.php mscrSubmit(4:)
    }
  }
}
?></td>
            </tr>
            <tr>
              <td valign="top">Comment:</td>
              <td>
			  
			  <label for="chckComment"></label>
                  <input type="checkbox" name="chckComment" id="chckComment" />
			  <script>				  
			  		$(document).ready(function() {     		
					 $("#Comment").hide();
					});
			  
					$("#chckComment").click(function () {
					if ($('#chckComment:checked').val() !== undefined) {
					//otherInput is the hidden text input
					$("#Comment").show();
					} else {
					$("#Comment").hide();
					}
					});
				</script>
                </td>
            </tr>
            <tr id="Comment">
              <td valign="top">&nbsp;</td>
              <td><label for="txtComment"></label>
                <textarea name="txtComment" id="txtComment" cols="60" rows="10"></textarea></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><span class="zvezda">* </span>File:</td>
              <td><label for="txtMscrptFile"></label>
                <input name="txtMscrptFile" type="file" id="txtMscrptFile" size="50" /></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><?php
if (ValidatedField('mscrSubmit','mscrSubmit'))  {
  if ((strpos((",".ValidatedField("mscrSubmit","mscrSubmit").","), "," . "1" . ",") !== false || "1" == ""))  {
    if (!(false))  {
?>
                <span class="validation_text">Please select your manuscript file.</span>
                <?php //WAFV_Conditional mscr_Submit.php mscrSubmit(1:)
    }
  }
}
?></td>
            </tr>
            <tr>
              <td>Photographs:</td>
              <td valign="middle"><input type="checkbox" name="chckPhotographs" id="chckPhotographs" />
        <script>
            
			$(document).ready(function() {
     		 $("#Photographs").hide();			 
			});
				
			 // 'other' is the checkbox
			$("#chckPhotographs").click(function () {
			if ($('#chckPhotographs:checked').val() !== undefined) {
			//otherInput is the hidden text input
			$("#Photographs").slideDown('slow');
			} else {
			$("#Photographs").slideUp('slow');
			}
			});
		</script>
        (Up to 10 Photographs)</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>
              <div id="Photographs">
                <label for="txtPhoto_1"></label>
                <input name="txtPhoto_1" type="file" id="txtPhoto_1" size="50" />
                <br />
                <label for="txtPhoto_2"></label>
                <input name="txtPhoto_2" type="file" id="txtPhoto_2" size="50" />
                <br />
                <label for="txtPhoto_3"></label>
                <input name="txtPhoto_3" type="file" id="txtPhoto_3" size="50" />
                <br />
                <label for="txtPhoto_4"></label>
                <input name="txtPhoto_4" type="file" id="txtPhoto_4" size="50" />
                <br />
                <label for="txtPhoto_5"></label>
                <input name="txtPhoto_5" type="file" id="txtPhoto_5" size="50" />
                <br />
                <label for="txtPhoto_6"></label>
                <input name="txtPhoto_6" type="file" id="txtPhoto_6" size="50" />
                <br />
                <label for="txtPhoto_7"></label>
                <input name="txtPhoto_7" type="file" id="txtPhoto_7" size="50" />
                <br />
                <label for="txtPhoto_8"></label>
                <input name="txtPhoto_8" type="file" id="txtPhoto_8" size="50" />
                <br />
                <label for="txtPhoto_9"></label>
                <input name="txtPhoto_9" type="file" id="txtPhoto_9" size="50" />
                <br />
                <label for="txtPhoto_10"></label>
                <input name="txtPhoto_10" type="file" id="txtPhoto_10" size="50" />
              </div>
              </td>
            </tr>
            <tr>
              <td>Graphs:</td>
              <td><input type="checkbox" name="chckGraphs" id="chckGraphs" />
              	<script>	
					$(document).ready(function() {     		 
					 $("#Graphs").hide();			 
					});
				
					$("#chckGraphs").click(function () {
					if ($('#chckGraphs:checked').val() !== undefined) {
					//otherInput is the hidden text input
					$("#Graphs").slideDown('slow');
					} else {
					$("#Graphs").slideUp('slow');
					}
					});
				</script>
                <label for="chckGraphs">(Up to 5 Graphs)</label></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>
              <div id="Graphs">
                <label for="txtGraphs_1"></label>
                <input name="txtGraphs_1" type="file" id="txtGraphs_1" size="50" />
                <br />
                <label for="txtGraphs_2"></label>
                <input name="txtGraphs_2" type="file" id="txtGraphs_2" size="50" />
                <br />
                <label for="txtGraphs_3"></label>
                <input name="txtGraphs_3" type="file" id="txtGraphs_3" size="50" />
                <br />
                <label for="txtGraphs_4"></label>
                <input name="txtGraphs_4" type="file" id="txtGraphs_4" size="50" />
                <br />
                <label for="txtGraphs_5"></label>
                <input name="txtGraphs_5" type="file" id="txtGraphs_5" size="50" />
              </div>
              </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><input type="submit" name="btnSubmitMscr" id="btnSubmitMscr" value="Submit Manuscript" /></td>
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