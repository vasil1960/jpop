<?php require_once('../Connections/localhost_i.php'); ?>
<?php require_once("../webassist/file_manipulation/helperphp.php"); ?>
<?php require_once('../webassist/mysqli/rsobj.php'); ?>
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

?>
<?php
$rsMainManuscriptFile = new WA_MySQLi_RS("rsMainManuscriptFile",$localhost_i,1);
$rsMainManuscriptFile->setQuery("SELECT mnscrpts.mscrID, mnscrpts.mscrFileName FROM mnscrpts WHERE mnscrpts.mscrID=?");
$rsMainManuscriptFile->bindParam("i", "".($_GET['mnscrpt_id'])  ."", "-1"); //colname
$rsMainManuscriptFile->execute();
?>
<?php
WA_DFP_SetupDownloadStatusStruct("WA_DownloadResult1");
if(!($rsMainManuscriptFile->TotalRows == 0)){
	WA_DFP_DownloadFile("WA_DownloadResult1", "../files/manuscripts/", "".$rsMainManuscriptFile->getColumnVal('mscrFileName')  ."", "[FileName]", false, false, false, "", "", "", "");
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