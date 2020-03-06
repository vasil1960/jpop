<?php require_once('../Connections/localhost_i.php'); ?>
<?php require_once( "../webassist/security_assist/helper_php.php" ); ?>
<?php require_once('../webassist/mysqli/rsobj.php'); ?>
<?php
if (!WA_Auth_RulePasses("Autors_Reviewer_and_Editors")){
	WA_Auth_RestrictAccess("users_LogIn.php?checkout=1");
}

if (!WA_Auth_RulePasses("Editors")){
	WA_Auth_RestrictAccess("users_LogIn.php");
}

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
$rsUsers = new WA_MySQLi_RS("rsUsers",$localhost_i,0);
$rsUsers->setQuery("SELECT users.UserID,users.UserEmail, users.UserFirstName, users.UserLastName, users.UserCity, DATE_FORMAT(users.UserRegistrationDate,'%d.%m.%Y') as DateRegister, users.UserCountry, status.statusName FROM users, status WHERE status.statusUserLave=users.UserLavel ORDER BY users.UserID DESC");
$rsUsers->execute();
?>
<?php
//$query_rsUsers = "SELECT users.UserID,users.UserEmail, users.UserFirstName, users.UserLastName, users.UserCity, DATE_FORMAT(users.UserRegistrationDate,'%d.%m.%Y') as DateRegister, users.UserCountry, status.statusName FROM users, status WHERE status.statusUserLave=users.UserLavel ORDER BY users.UserID DESC";
//$rsUsers = mysql_query($query_rsUsers, $localhost) or die(mysql_error());
//$row_rsUsers = mysql_fetch_assoc($rsUsers);
//$rsUsers->TotalRows = mysql_num_rows($rsUsers);
//
//$maxRows_rsUsersCount = 10;
//$pageNum_rsUsersCount = 0;
//if (isset($_GET['pageNum_rsUsersCount'])) {
//  $pageNum_rsUsersCount = $_GET['pageNum_rsUsersCount'];
//}
//$startRow_rsUsersCount = $pageNum_rsUsersCount * $maxRows_rsUsersCount;
//
//mysql_select_db($database_localhost, $localhost);
//$query_rsUsersCount = "SELECT status.statusName,  COUNT(users.UserLavel) AS UsersCout, status.statusUserLave FROM users, status WHERE status.statusUserLave=users.UserLavel GROUP BY users.UserLavel ORDER BY status.statusUserLave DESC";
//$query_limit_rsUsersCount = sprintf("%s LIMIT %d, %d", $query_rsUsersCount, $startRow_rsUsersCount, $maxRows_rsUsersCount);
//$rsUsersCount = mysql_query($query_limit_rsUsersCount, $localhost) or die(mysql_error());
//$row_rsUsersCount = mysql_fetch_assoc($rsUsersCount);
//
//if (isset($_GET['totalRows_rsUsersCount'])) {
//  $rsUsers->TotalRowsCount = $_GET['totalRows_rsUsersCount'];
//} else {
//  $all_rsUsersCount = mysql_query($query_rsUsersCount, $localhost);
//  $rsUsers->TotalRowsCount = mysql_num_rows($all_rsUsersCount);
//}
//$totalPages_rsUsersCount = ceil($rsUsers->TotalRowsCount/$maxRows_rsUsersCount)-1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/main.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>journal-pop - Users</title>
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
    
<!-- InstanceBeginEditable name="LeftSidebar" --><!-- InstanceEndEditable --></div>
    <div id="content"><!-- InstanceBeginEditable name="mainContent" --> <span class="title">All Users (Editors, Authors and Reviewers) - <?php echo $rsUsers->TotalRows ?></span>
        <div id="mainContent">
          <div id="form1_ProgressWrapper">
            <form id="form1" name="form1" method="post" action="">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="20" colspan="7" align="right">&nbsp;</td>
                </tr>
                <tr>
                  <td height="20" colspan="7" align="right"><span class="bold"><a href="users_Index.php">All Users - <?php echo $rsUsers->TotalRows ?></a></span><br />
                    
                </tr>
                <tr>
                  <td height="20" align="right">&nbsp;</td>
                  <td align="left">&nbsp;</td>
                  <td align="left">&nbsp;</td>
                  <td align="left">&nbsp;</td>
                  <td align="left">&nbsp;</td>
                  <td align="left">&nbsp;</td>
                  <td align="left">&nbsp;</td>
                </tr>
                <?php
$wa_startindex = 0;
while(!$rsUsers->atEnd()) {
  $wa_startindex = $rsUsers->Index;
?>
                <tr>
                  <td width="3%" height="20" align="right" valign="top"><?php echo($rsUsers->getColumnVal("UserID")); ?>. </td>
                  <td width="23%" align="left" valign="top"><?php echo($rsUsers->getColumnVal("UserEmail")); ?></td>
                  <td width="21%" align="left" valign="top"><?php echo($rsUsers->getColumnVal("UserFirstName")); ?> <?php echo($rsUsers->getColumnVal("UserLastName")); ?></td>
                  <td width="31%" align="left" valign="top"><?php echo($rsUsers->getColumnVal("UserCountry")); ?>, <?php echo($rsUsers->getColumnVal("UserCity")); ?></td>
                  <td width="9%" align="left" valign="top"><?php echo($rsUsers->getColumnVal("DateRegister")); ?></td>
                  <td width="7%" align="left" valign="top"><?php echo($rsUsers->getColumnVal("statusName")); ?></td>
                  <td width="5%" align="right" valign="top"><a href="users_ChangeStatus.php?update=<?php echo $rsUsers->getColumnVal('UserID'); ?>">status</a></td>
                </tr>
                <?php
  $rsUsers->moveNext();
}
$rsUsers->moveFirst(); //return RS to first record
unset($wa_startindex);
unset($wa_repeatcount);
?>
              </table>
              <p>&nbsp;</p>
            </form>
          </div>
      </div>
        <div id="form1_ProgressMessageWrapper" class="blockUIOverlay" style="display:none;">
          <script type="text/javascript">
WADFP_SetProgressToForm('form1', 'form1_ProgressMessageWrapper', WADFP_Theme_Options['BigSpin:Poppy']);
        </script>
          <div id="form1_ProgressMessage" >
            <p style="margin:10px; padding:5px;" ><img src="../webassist/progress_bar/images/poppy-largespin.gif" alt="" title="" style="vertical-align:middle;" />&nbsp;&nbsp;Please wait</p>
          </div>
        </div>
    <!-- InstanceEndEditable --></div>
  </div>
<div id="footer">Journal-POP &copy; 2011- 2015</div>
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsUsersCount);
?>
