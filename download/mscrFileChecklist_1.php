<?php require_once('../Connections/localhost.php'); ?>
<?php require_once("../webassist/file_manipulation/helperphp.php"); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$colname_rsChecklist1 = "-1";
if (isset($_GET['mnscrpt_id'])) {
  $colname_rsChecklist1 = (get_magic_quotes_gpc()) ? $_GET['mnscrpt_id'] : addslashes($_GET['mnscrpt_id']);
}
mysql_select_db($database_localhost, $localhost);
$query_rsChecklist1 = sprintf("SELECT mnscrpts.mscrID, mnscrpts.mnscChecklistFileReviewer_1 FROM mnscrpts WHERE mnscrpts.mscrID=%s", GetSQLValueString($colname_rsChecklist1, "int"));
$rsChecklist1 = mysql_query($query_rsChecklist1, $localhost) or die(mysql_error());
$row_rsChecklist1 = mysql_fetch_assoc($rsChecklist1);
$totalRows_rsChecklist1 = mysql_num_rows($rsChecklist1);?>
<?php
WA_DFP_SetupDownloadStatusStruct("WA_DownloadResult1");
if(!($totalRows_rsChecklist1 == 0)){
	WA_DFP_DownloadFile("WA_DownloadResult1", "../files/checklist/", "".$row_rsChecklist1['mnscChecklistFileReviewer_1']  ."", "[FileName]", false, false, false, "", "", "", "");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>
<?php
mysql_free_result($rsChecklist1);
?>
