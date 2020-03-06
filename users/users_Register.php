<?php require_once("../WA_SecurityAssist/WA_RandomPassword.php"); ?>
<?php require_once("../WA_SecurityAssist/WA_SHA1Encryption.php"); ?>
<?php require_once('../Connections/localhost_i.php'); ?>
<?php require_once("../webassist/form_validations/wavt_scripts_php.php"); ?>
<?php require_once("../webassist/form_validations/wavt_validatedform_php.php"); ?>
<?php require_once( "../webassist/security_assist/helper_php.php" ); ?>
<?php require_once('../webassist/mysqli/rsobj.php'); ?>
<?php require_once('../webassist/mysqli/queryobj.php'); ?>
<?php
$CheckRepeat = new WA_MySQLi_RS("CheckRepeat",$localhost_i,1);
$CheckRepeat->setQuery("SELECT UserID FROM users WHERE UserEmail = ?");
$CheckRepeat->bindParam("s", "".$_SESSION['UserEmail']  ."", "-1"); //colname
$CheckRepeat->execute();
?>
<?php
@session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST")     {
  $_SESSION["randomConfirm"] = "".WA_RandomPassword(20, true, true, true, "")  ."";
}
?>

<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST")  {
  $WAFV_Redirect = "";
  $_SESSION['WAVT_usersRegister_Errors'] = "";
  if ($WAFV_Redirect == "")  {
    $WAFV_Redirect = $_SERVER["PHP_SELF"];
  }
  $WAFV_Errors = "";
  $WAFV_Errors .= WAValidateNM($CheckRepeat->TotalRows . "",-1,0,"",",.",true,1);
  $WAFV_Errors .= WAValidateEM(((isset($_POST["txtEmail"]))?$_POST["txtEmail"]:"") . "",true,2);
  $WAFV_Errors .= WAValidateRQ(((isset($_POST["txtPassword"]))?$_POST["txtPassword"]:"") . "",false,3);
  $WAFV_Errors .= WAValidateLE(((isset($_POST["txtConfirmPassword"]))?$_POST["txtConfirmPassword"]:"") . "",((isset($_POST["txtPassword"]))?$_POST["txtPassword"]:"") . "",true,4);
  $WAFV_Errors .= WAValidateRQ(((isset($_POST["txtFirstName"]))?$_POST["txtFirstName"]:"") . "",false,5);
  $WAFV_Errors .= WAValidateRQ(((isset($_POST["txtLastName"]))?$_POST["txtLastName"]:"") . "",false,6);
  $WAFV_Errors .= WAValidateRQ(((isset($_POST["txtAddress"]))?$_POST["txtAddress"]:"") . "",false,7);
  $WAFV_Errors .= WAValidateRQ(((isset($_POST["txtCity"]))?$_POST["txtCity"]:"") . "",false,8);
  $WAFV_Errors .= WAValidateRQ(((isset($_POST["txtCountry"]))?$_POST["txtCountry"]:"") . "",false,9);
  $WAFV_Errors .= WAValidateLE(strtolower(((isset($_POST["Security_Code_1"]))?$_POST["Security_Code_1"]:"")) . "",strtolower($_SESSION['captcha_Security_Code_1']) . "",true,10);

  if ($WAFV_Errors != "")  {
    PostResult($WAFV_Redirect,$WAFV_Errors,"usersRegister");
  }
}
?>
<?php
if (isset($_POST["btnRegister"]) || isset($_POST["btnRegister_x"])) {
  $InsertQuery = new WA_MySQLi_Query($localhost_i);
  $InsertQuery->Action = "insert";
  $InsertQuery->Table = "users";
  $InsertQuery->bindColumn("UserEmail", "s", "".((isset($_POST["txtEmail"]))?$_POST["txtEmail"]:"")  ."", "WA_BLANK");
  $InsertQuery->bindColumn("UserPassword", "s", "".WA_SHA1Encryption(((isset($_POST["txtPassword"]))?$_POST["txtPassword"]:""))  ."", "WA_BLANK");
  $InsertQuery->bindColumn("UserFirstName", "s", "".((isset($_POST["txtFirstName"]))?$_POST["txtFirstName"]:"")  ."", "WA_BLANK");
  $InsertQuery->bindColumn("UserLastName", "s", "".((isset($_POST["txtLastName"]))?$_POST["txtLastName"]:"")  ."", "WA_BLANK");
  $InsertQuery->bindColumn("UserCity", "s", "".((isset($_POST["txtCity"]))?$_POST["txtCity"]:"")  ."", "WA_BLANK");
  $InsertQuery->bindColumn("UserVerificationCode", "s", "".$_SESSION['randomConfirm']  ."", "WA_BLANK");
  $InsertQuery->bindColumn("UserIP", "s", "".((isset($_SERVER["REMOTE_ADDR"]))?$_SERVER["REMOTE_ADDR"]:"")  ."", "WA_BLANK");
  $InsertQuery->bindColumn("UserCountry", "s", "".((isset($_POST["txtCountry"]))?$_POST["txtCountry"]:"")  ."", "WA_BLANK");
  $InsertQuery->bindColumn("UserAddress", "s", "".((isset($_POST["txtAddress"]))?$_POST["txtAddress"]:"")  ."", "WA_BLANK");
  $InsertQuery->saveInSession("users_UserID");
  $InsertQuery->execute();
  $InsertGoTo = "";
  if (function_exists("rel2abs")) $InsertGoTo = $InsertGoTo?rel2abs($InsertGoTo,dirname(__FILE__)):"";
  $InsertQuery->redirect($InsertGoTo);
}
?>
<?php
if (($_SERVER["REQUEST_METHOD"] === "POST") && (isset($_SERVER["HTTP_REFERER"]) && strpos(urldecode($_SERVER["HTTP_REFERER"]), urldecode($_SERVER["SERVER_NAME"].$_SERVER["PHP_SELF"])) > 0) && isset($_POST))     {  //WA Universal Email
  $Email = new WA_Email("waue_users_Register_2");
  $Email->Redirect = "users_ThankYou.php";
  $Email->From = "Journal POP <ivilievltu@klaro-bg.com>";
  $Email->BurstSize = "200";
  $Email->BurstTime = "1";
  $Email->WaitTime = "1";
  $Email->addTo("".((isset($_POST["txtEmail"]))?$_POST["txtEmail"]:"")  ."");
  $Email->BodyFile = "../webassist/email/waue_users_Register_2_body.php";
  if (function_exists("rel2abs") && $Email->Redirect) $Email->Redirect = $Email->Redirect?rel2abs($Email->Redirect,dirname(__FILE__)):"";
  for ($emailGroup=0; $emailGroup<sizeof($Email->To); $emailGroup++) {
    $Email->Subject = "Please confirm registration";
    $Email->send($emailGroup);
  }
  $Email->close();
}
?>
<?php
if (($_SERVER["REQUEST_METHOD"] === "POST") && (isset($_SERVER["HTTP_REFERER"]) && strpos(urldecode($_SERVER["HTTP_REFERER"]), urldecode($_SERVER["SERVER_NAME"].$_SERVER["PHP_SELF"])) > 0) && isset($_POST))     {  //WA Universal Email
  $Email = new WA_Email("waue_users_Register_3");
  $Email->From = "Journal POP <ivilievltu@klaro-bg.com>";
  $Email->BurstSize = "200";
  $Email->BurstTime = "1";
  $Email->WaitTime = "1";
  $Email->addTo("ivilievltu@yahoo.com");
  $Email->addTo("v.tsigov@gmail.com");
  $Email->addTo("v.tsigov@abv.bg");
  $Email->BodyFile = "../webassist/email/waue_users_Register_3_body_2.php";
  if (function_exists("rel2abs") && $Email->Redirect) $Email->Redirect = $Email->Redirect?rel2abs($Email->Redirect,dirname(__FILE__)):"";
  for ($emailGroup=0; $emailGroup<sizeof($Email->To); $emailGroup++) {
    $Email->Subject = "New author submit registration form";
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
<title>Journal-pop - Register Form</title>
<!-- InstanceEndEditable -->
<link href="../css/main.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<style type="text/css">
.textfieldServerError {  display:inline;
  margin:0px;
  color:#CC3333;
  border: 1px solid #CC3333;
}
</style>
<!-- InstanceEndEditable -->
<!-- InstanceParam name="home" type="text" value="" -->
<!-- InstanceParam name="contact" type="text" value="" -->
<!-- InstanceParam name="instructions" type="text" value="" -->
<!-- InstanceParam name="submit_paper" type="text" value="" -->
<!-- InstanceParam name="register" type="text" value="current" -->
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
      <li><a href="users_Register.php" class="current" >Register</a></li>
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
    <div id="content"><!-- InstanceBeginEditable name="mainContent" -->
    <span class="title">Register </span>

  <div id="mainContent">
    <?php if(!WA_Auth_RulePasses("Autors_Reviewer_and_Editors")){ // Begin Show Region ?>
      <form action="" method="post" name="frmRegister" id="frmRegister">
        <table width="100%" border="0" cellpadding="0" cellspacing="5">
          <tr>
            <td width="15%" align="left">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="left"><span class="zvezda">*</span> Email:</td>
            <td><label for="txtEmail"></label>
              <input name="txtEmail" type="text" id="txtEmail" value="<?php echo(ValidatedField("usersRegister","txtEmail")) ?>" size="40" />
              <?php
if (ValidatedField('usersRegister','usersRegister'))  {
  if ((strpos((",".ValidatedField("usersRegister","usersRegister").","), "," . "" . ",") !== false || "" == ""))  {
    if (!(false))  {
?>
                <?php
if (ValidatedField('usersRegister','usersRegister'))  {
  if ((strpos((",".ValidatedField("usersRegister","usersRegister").","), "," . "1" . ",") !== false || "1" == ""))  {
    if (!(false))  {
?>
                  <span class="validation_text">That email address is already registered.</span>
                  <?php //WAFV_Conditional users_Register.php usersRegister(1:)
    }
  }
}?>
                <?php
if (ValidatedField('usersRegister','usersRegister'))  {
  if ((strpos((",".ValidatedField("usersRegister","usersRegister").","), "," . "2" . ",") !== false || "2" == ""))  {
    if (!(false))  {
?>
                  <span class="validation_text">Please enter a valid email addres.</span>
                  <?php //WAFV_Conditional users_Register.php usersRegister(2:)
    }
  }
}?>
                <?php //WAFV_Conditional users_Register.php usersRegister( :)
    }
  }
}?></td>
          </tr>
          <tr>
            <td align="left"><span class="zvezda">*</span> Password:</td>
            <td><label for="txtPassword"></label>
              <input name="txtPassword" type="password" id="txtPassword" size="40" />
              <?php
if (ValidatedField('usersRegister','usersRegister'))  {
  if ((strpos((",".ValidatedField("usersRegister","usersRegister").","), "," . "3" . ",") !== false || "3" == ""))  {
    if (!(false))  {
?>
                <span class="validation_text">Please enter your password.</span>
                <?php //WAFV_Conditional users_Register.php usersRegister(3:)
    }
  }
}
?></td>
          </tr>
          <tr>
            <td align="left"><span class="zvezda">*</span> Confirm Password:</td>
            <td><label for="txtConfirmPassword"></label>
              <input name="txtConfirmPassword" type="password" id="txtConfirmPassword" size="40" />
              <?php
if (ValidatedField('usersRegister','usersRegister'))  {
  if ((strpos((",".ValidatedField("usersRegister","usersRegister").","), "," . "4" . ",") !== false || "4" == ""))  {
    if (!(false))  {
?>
                <span class="validation_text">Your password entries did not mach.</span>
                <?php //WAFV_Conditional users_Register.php usersRegister(4:)
    }
  }
}

?></td>
          </tr>
          <tr>
            <td align="left"><span class="zvezda">*</span> First Name:</td>
            <td><label for="txtFirstName"></label>
              <input name="txtFirstName" type="text" id="txtFirstName" value="<?php echo(ValidatedField("usersRegister","txtFirstName")) ?>" size="40" />
              <?php
if (ValidatedField('usersRegister','usersRegister'))  {
  if ((strpos((",".ValidatedField("usersRegister","usersRegister").","), "," . "5" . ",") !== false || "5" == ""))  {
    if (!(false))  {
?>
                <span class="validation_text">Please enter your first name.</span>
                <?php //WAFV_Conditional users_Register.php usersRegister(5:)
    }
  }
}
?></td>
          </tr>
          <tr>
            <td align="left"><span class="zvezda">*</span> Last Name:</td>
            <td><label for="txtLastName"></label>
              <input name="txtLastName" type="text" id="txtLastName" value="<?php echo(ValidatedField("usersRegister","txtLastName")) ?>" size="40" />
              <?php
if (ValidatedField('usersRegister','usersRegister'))  {
  if ((strpos((",".ValidatedField("usersRegister","usersRegister").","), "," . "6" . ",") !== false || "6" == ""))  {
    if (!(false))  {
?>
                <span class="validation_text">Please enter your last name.</span>
                <?php //WAFV_Conditional users_Register.php usersRegister(6:)
    }
  }
}
?></td>
          </tr>
          <tr>
            <td align="left"><span class="zvezda">*</span> Address:</td>
            <td><label for="txtAddress"></label>
              <input name="txtAddress" type="text" id="txtAddress" value="<?php echo(ValidatedField("usersRegister","txtAddress")) ?>" size="40" />
              <?php
if (ValidatedField('usersRegister','usersRegister'))  {
  if ((strpos((",".ValidatedField("usersRegister","usersRegister").","), "," . "7" . ",") !== false || "7" == ""))  {
    if (!(false))  {
?>
                <span class="validation_text">Please enter your address.</span>
                <?php //WAFV_Conditional users_Register.php usersRegister(7:)
    }
  }
}
?></td>
          </tr>
          <tr>
            <td align="left"><span class="zvezda">*</span> City:</td>
            <td><label for="txtCity"></label>
              <input name="txtCity" type="text" id="txtCity" value="<?php echo(ValidatedField("usersRegister","txtCity")) ?>" size="40" />
              <?php
if (ValidatedField('usersRegister','usersRegister'))  {
  if ((strpos((",".ValidatedField("usersRegister","usersRegister").","), "," . "8" . ",") !== false || "8" == ""))  {
    if (!(false))  {
?>
                <span class="validation_text">Please enter your city.</span>
                <?php //WAFV_Conditional users_Register.php usersRegister(8:)
    }
  }
}
?></td>
          </tr>
          <tr>
            <td align="left"><span class="zvezda">*</span> Country:</td>
            <td><label for="txtCountry"></label>
              <input name="txtCountry" type="text" id="txtCountry" value="<?php echo(ValidatedField("usersRegister","txtCountry")) ?>" size="40" />
              <?php
if (ValidatedField('usersRegister','usersRegister'))  {
  if ((strpos((",".ValidatedField("usersRegister","usersRegister").","), "," . "9" . ",") !== false || "9" == ""))  {
    if (!(false))  {
?>
                <span class="validation_text">Please enter your country.</span>
                <?php //WAFV_Conditional users_Register.php usersRegister(9:)
    }
  }
}

?></td>
          </tr>
          <tr>
            <td align="left" valign="middle"><span class="zvezda">*</span> Security code:</td>
            <td><p><img id="capt1" src="../webassist/captcha/wavt_captchasecurityimages.php?width=100&height=25&field=Security_Code_1&bgcolor=FFFFFF&transparent=0&bgimage=&gridfreq=10&gridcolor=000000&gridorder=behind&noisefreq=10&noisecolor=000000&noiseorder=behind&characters=5&charheight=&font=fonts/MOM_T___.TTF&textcolor=000000" alt="security code" width="100" height="25" /> <img src="../webassist/captcha/images/refresh.png" height="18" onclick="document.getElementById('capt1').src+='&ref=1'" /><br />
              <input id="Security_Code_1" name="Security_Code_1" type="text" value="" />
              <?php
if (ValidatedField('usersRegister','usersRegister'))  {
  if ((strpos((",".ValidatedField("usersRegister","usersRegister").","), "," . "10" . ",") !== false || "10" == ""))  {
    if (!(false))  {
?>
                <span class="validation_text">Your cecurity code did not mach the image.</span>
                <?php //WAFV_Conditional users_Register.php usersRegister(10:)
    }
  }
}
?>
              <br />
              Rewrite above letters and digits here.</p></td>
          </tr>
          <tr>
            <td align="left">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="left">&nbsp;</td>
            <td><input type="submit" name="btnRegister" id="btnRegister" value="    Register    " /></td>
          </tr>
          <tr>
            <td align="left">[ <a href="javascript:history.back()">Go Back</a> ]</td>
            <td>&nbsp;</td>
          </tr>
        </table>
      </form>
<?php } // End Show Region ?>      
      <?php if(WA_Auth_RulePasses("Autors_Reviewer_and_Editors")){ // Begin Show Region ?>
        <div id="divRegistered">You are registered as <?php echo $_SESSION['UserFirstName']; ?> <?php echo $_SESSION['UserLastName']; ?> ( <?php echo $_SESSION['UserEmail']; ?> )</div> 
        <?php } // End Show Region ?>

  </div>
  <!-- InstanceEndEditable --></div>
  </div>
<div id="footer">Journal-POP &copy; 2011- 2015</div>
</div>
</body>
<!-- InstanceEnd --></html>