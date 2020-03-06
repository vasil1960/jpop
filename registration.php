<?php require_once("webassist/security_assist/wa_hashencryption.php"); ?>
<?php require_once("webassist/form_validations/wavt_validatedform_php.php"); ?>
<?php require_once('Connections/ltu.php'); ?>
<?php require_once('webassist/mysqli/queryobj.php'); ?>
<?php
if (isset($_POST["btnSubmit"]) || isset($_POST["btnSubmit_x"])) {
  $InsertQuery = new WA_MySQLi_Query($ltu);
  $InsertQuery->Action = "insert";
  $InsertQuery->Table = "users";
  $InsertQuery->bindColumn("UserEmail", "s", "".((isset($_POST["txtEmail"]))?$_POST["txtEmail"]:"")  ."", "WA_DEFAULT");
  $InsertQuery->bindColumn("UserPassword", "s", "".WA_HashEncryption(((isset($_POST["txtPassword"]))?$_POST["txtPassword"]:""))  ."", "WA_DEFAULT");
  $InsertQuery->bindColumn("UserFirstName", "s", "".((isset($_POST["txtFirstName"]))?$_POST["txtFirstName"]:"")  ."", "WA_DEFAULT");
  $InsertQuery->bindColumn("UserLastName", "s", "".((isset($_POST["txtLastName"]))?$_POST["txtLastName"]:"")  ."", "WA_DEFAULT");
  $InsertQuery->bindColumn("UserCity", "s", "".((isset($_POST["txtCity"]))?$_POST["txtCity"]:"")  ."", "WA_DEFAULT");
  $InsertQuery->bindColumn("UserRegistrationDate", "s", "date()", "WA_DEFAULT");
  $InsertQuery->bindColumn("UserIP", "s", "".((isset($_SERVER["REMOTE_ADDR"]))?$_SERVER["REMOTE_ADDR"]:"")  ."", "WA_DEFAULT");
  $InsertQuery->bindColumn("UserCountry", "s", "".((isset($_POST["txtCountry"]))?$_POST["txtCountry"]:"")  ."", "WA_DEFAULT");
  $InsertQuery->bindColumn("UserAddress", "s", "".((isset($_POST["txtAddress"]))?$_POST["txtAddress"]:"")  ."", "WA_DEFAULT");
  $InsertQuery->bindColumn("UserLavel", "i", "0", "WA_DEFAULT");
  $InsertQuery->saveInSession("UsersSessionId");
  $InsertQuery->execute();
  $InsertGoTo = "registration-ok.php";
  if (function_exists("rel2abs")) $InsertGoTo = $InsertGoTo?rel2abs($InsertGoTo,dirname(__FILE__)):"";
  $InsertQuery->redirect($InsertGoTo);
}
?>
<!DOCTYPE html>
<html lang="en"><!-- InstanceBegin template="/Templates/ltu.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- InstanceBeginEditable name="doctitle" -->
	<title>Bootstrap - Prebuilt Layout</title>
	<!-- InstanceEndEditable -->
	<!-- Bootstrap -->
	<link href="css/bootstrap-4.2.1.css" rel="stylesheet">
	<!-- InstanceBeginEditable name="head" -->
	<!-- InstanceEndEditable -->
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<a class="navbar-brand" href="#">
			LTU
		</a>
	
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
	  </button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">

				<li class="nav-item active">
					<a class="nav-link" href="index.php">
						Home 
						<span class="sr-only">(current)</span>
					</a>
				</li>

				<li class="nav-item">
					<a class="nav-link" href="login.php">
						Login
					</a>
				</li>
				
				<li class="nav-item">
					<a class="nav-link" href="manuscripts.php">
						Manuscripts
					</a>
				</li>
				
				<li class="nav-item">
					<a class="nav-link" href="registration.php">
						Registration
					</a>
				</li>
				
				<li class="nav-item">
					<a class="nav-link" href="instructions.php">
						Instructions
					</a>
				</li>
				
				<li class="nav-item">
					<a class="nav-link" href="contacts.php">
						Contacts
					</a>
				</li>

				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Dropdown
					</a>

					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="#">
							Action
						</a>

						<a class="dropdown-item" href="#">
							Another action
						</a>

						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#">
							Something else here
						</a>
					</div>
				</li>
				<li class="nav-item">
					<a class="nav-link disabled" href="#">
						Disabled
					</a>
				

				</li>
			</ul>
			<form class="form-inline my-2 my-lg-0">
				<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
				<button class="btn btn-outline-success my-2 my-sm-0" type="submit">
					Search
				</button>
			

			</form>
		</div>
	</nav>

	<div class="jumbotron jumbotron text-center">
		<p class="display-4">Bootstrap with Dreamweaver</p>
		<p class="lead">Easily build your page using the Bootstrap components from the Insert panel.</p>

	</div>
<div class="container">

		<br>
		<div class="row"><!-- InstanceBeginEditable name="EditRegion1" -->
			<div class="col-md-9">
				<div class="card">
					<div class="card-header">
						<h3>
							Registration
						</h3>
						<p>
							<small>
								You have to register for work with the system
							</small>
						</p>
					</div>
					<!--<img class="card-img-top" src="images/card-img.png" alt="Card image cap">-->
					<div class="card-body">
						
						<form action="registration-ok.php"  method="POST" name="frmRegister"  id="frmRegister" accept-charset="UTF-8" >
							<div class="form-group row">
								<label for="txtEmail" class="col-sm-3 col-form-label">
									Email:
								</label>
								<div class="col-sm-9">
								  <input name="txtEmail" type="email" class="form-control" id="txtEmail" form="frmRegister" placeholder="Email" autocomplete="off" value="<?php echo(ValidatedField("registrationok_728","txtEmail")) ?>">
								</div>
								<div class="text-danger col-sm-9 offset-3"> 
								  <?php
if (ValidatedField('registrationok_728','registrationok_728'))  {
  if ((strpos((",".ValidatedField("registrationok_728","registrationok_728").","), "," . "1" . ",") !== false || "1" == ""))  {
    if (!(false))  {
?>
								    <small> Please enter your email </small>
								    <?php //WAFV_Conditional registration-ok.php registrationok_728(1:)
    }
  }
}?>
								</div>
							</div>

							<div class="form-group row">
								<label for="txtPassword" class="col-sm-3 col-form-label">
									Password:
								</label>
								<div class="col-sm-9">
									<input name="txtPassword" type="password" class="form-control" id="txtPassword" form="frmRegister" placeholder="Password" autocomplete="off" value="<?php echo(ValidatedField("registrationok_728","txtPassword")) ?>">
								</div>
								<div class="text-danger col-sm-9 offset-3"> 
								  <?php
if (ValidatedField('registrationok_728','registrationok_728'))  {
  if ((strpos((",".ValidatedField("registrationok_728","registrationok_728").","), "," . "2" . ",") !== false || "2" == ""))  {
    if (!(false))  {
?>
								    <small> Please enter your password </small>
								    <?php //WAFV_Conditional registration-ok.php registrationok_728(2:)
    }
  }
}?>
								</div>
							</div>

							<div class="form-group row">
								<label for="txtConfirmPassword" class="col-sm-3 col-form-label">
									Confirm Password:
								</label>
								<div class="col-sm-9">
									<input name="txtConfirmPassword" type="password" class="form-control" id="txtConfirmPassword" form="frmRegister" placeholder="ConfirmPassword" autocomplete="off" value="<?php echo(ValidatedField("registrationok_728","txtConfirmPassword")) ?>">
								</div>
								<div class="text-danger col-sm-9 offset-3"> 
								  <?php
if (ValidatedField('registrationok_728','registrationok_728'))  {
  if ((strpos((",".ValidatedField("registrationok_728","registrationok_728").","), "," . "3" . ",") !== false || "3" == ""))  {
    if (!(false))  {
?>
								    <small> Your password entries did not mach </small>
								    <?php //WAFV_Conditional registration-ok.php registrationok_728(3:)
    }
  }
}?>
								</div>
							</div>

							<div class="form-group row">
								<label for="txtFirstName" class="col-sm-3 col-form-label">
										First Name:
								</label>
								<div class="col-sm-9">
									<input name="txtFirstName" type="text" class="form-control" id="txtFirstName" form="frmRegister" placeholder="First Name" autocomplete="off" value="<?php echo(ValidatedField("registrationok_728","txtFirstName")) ?>">
								</div>
								<div class="text-danger col-sm-9 offset-3"> 
								  <?php
if (ValidatedField('registrationok_728','registrationok_728'))  {
  if ((strpos((",".ValidatedField("registrationok_728","registrationok_728").","), "," . "4" . ",") !== false || "4" == ""))  {
    if (!(false))  {
?>
								    <small> Please enter your first name </small>
								    <?php //WAFV_Conditional registration-ok.php registrationok_728(4:)
    }
  }
}?>
								</div>
							</div>

							<div class="form-group row">
								<label for="txtLastName" class="col-sm-3 col-form-label">
									Last Name:
								</label>
								<div class="col-sm-9">
									<input name="txtLastName" type="text" class="form-control" id="txtLastName" form="frmRegister" placeholder="Last Name" autocomplete="off" value="<?php echo(ValidatedField("registrationok_728","txtLastName")) ?>">
								</div>
								<div class="text-danger col-sm-9 offset-3"> 
								  <?php
if (ValidatedField('registrationok_728','registrationok_728'))  {
  if ((strpos((",".ValidatedField("registrationok_728","registrationok_728").","), "," . "5" . ",") !== false || "5" == ""))  {
    if (!(false))  {
?>
								    <small> Please enter your last name </small>
								    <?php //WAFV_Conditional registration-ok.php registrationok_728(5:)
    }
  }
}?>
								</div>
							</div>

							<div class="form-group row">
								<label for="txtAddress" class="col-sm-3 col-form-label">
									Address:
								</label>
								<div class="col-sm-9">
									<input name="txtAddress" type="text" class="form-control" id="txtAddress" form="frmRegister" placeholder="Address" autocomplete="off" value="<?php echo(ValidatedField("registrationok_728","txtAddress")) ?>">
								</div>
								<div class="text-danger col-sm-9 offset-3"> 
								  <?php
if (ValidatedField('registrationok_728','registrationok_728'))  {
  if ((strpos((",".ValidatedField("registrationok_728","registrationok_728").","), "," . "6" . ",") !== false || "6" == ""))  {
    if (!(false))  {
?>
								    <small> Please enter your  addres </small>
								    <?php //WAFV_Conditional registration-ok.php registrationok_728(6:)
    }
  }
}?>
								</div>
							</div>

							<div class="form-group row">
								<label for="txtCity" class="col-sm-3 col-form-label">
									City:
							  </label>
								<div class="col-sm-9">
									<input name="txtCity" type="text" class="form-control" id="txtCity" form="frmRegister" placeholder="City" autocomplete="off" value="<?php echo(ValidatedField("registrationok_728","txtCity")) ?>">
								</div>
								<div class="text-danger col-sm-9 offset-3"> 
								  <?php
if (ValidatedField('registrationok_728','registrationok_728'))  {
  if ((strpos((",".ValidatedField("registrationok_728","registrationok_728").","), "," . "7" . ",") !== false || "7" == ""))  {
    if (!(false))  {
?>
								    <small> Please enter your city </small>
								    <?php //WAFV_Conditional registration-ok.php registrationok_728(7:)
    }
  }
}?>
								</div>
							</div>

							<div class="form-group row">
								<label for="txtCountry" class="col-sm-3 col-form-label">
										Country:
							  </label>
								<div class="col-sm-9">
									<input name="txtCountry" type="text" class="form-control" id="txtCountry" form="frmRegister" placeholder="Country" autocomplete="off" value="<?php echo(ValidatedField("registrationok_728","txtCountry")) ?>">
								</div>
								<div class="text-danger col-sm-9 offset-3"> 
								  <?php
if (ValidatedField('registrationok_728','registrationok_728'))  {
  if ((strpos((",".ValidatedField("registrationok_728","registrationok_728").","), "," . "8" . ",") !== false || "8" == ""))  {
    if (!(false))  {
?>
								    <small> Please enter your country </small>
								    <?php //WAFV_Conditional registration-ok.php registrationok_728(8:)
    }
  }
}?>
								</div>
							</div>

							<div class="form-group row">
								<div class="col-sm-9 offset-3">
									<img id="capt1" src="webassist/captcha/wavt_captchasecurityimages.php?width=200&height=50&field=Security_Code_1&bgcolor=FFFFFF&transparent=0&bgimage=&gridfreq=20&gridcolor=000000&gridorder=behind&noisefreq=20&noisecolor=000000&noiseorder=behind&characters=5&charheight=&font=fonts/MOM_T___.TTF&textcolor=000000" alt="security code" width="200" height="50" />
									<img src="webassist/captcha/images/refresh.png" height="18" onClick="document.getElementById('capt1').src+='&ref=1'">
									<br>
								</div>
							</div>

							<div class="form-group row">
								<label for="txtSecurity_Code_1" class="col-sm-3 col-form-label">
									Security Code:
								</label>
							
								<div class="col-sm-9">
									<input name="txtSecurity_Code_1" type="text" id="txtSecurity_Code_1" form="frmRegister" value="<?php echo(ValidatedField("registrationok_728","txtSecurity_Code_1")) ?>"/>
								</div>
								<div class="text-danger col-sm-9 offset-3"> 
								  <?php
if (ValidatedField('registrationok_728','registrationok_728'))  {
  if ((strpos((",".ValidatedField("registrationok_728","registrationok_728").","), "," . "9" . ",") !== false || "9" == ""))  {
    if (!(false))  {
?>
								    <small> Your security code did not mach the image </small>
								    <?php //WAFV_Conditional registration-ok.php registrationok_728(9:)
    }
  }
}?>
								</div>
							</div>

							<div class="form-group row">
								<div class="offset-3 col-xl-9 col-sm-7">
									<button name="btnSubmit" type="submit" class="btn btn-primary">Register</button>
								</div>
							</div>

						</form>
					</div>
				</div>
			</div>
			
			<!-- InstanceEndEditable -->
			

			<div class="col-md-3">
				<div class="card">
					<img class="card-img-top" src="images/card-img.png" alt="Card image cap">
					<div class="card-body">
						<h5 class="card-title">Card title</h5>
						<p class="card-text">Some text to build on the card's content.</p>
					</div>
					<ul class="list-group list-group-flush">
						<li class="list-group-item">Cras justo odio</li>
						<li class="list-group-item">Dapibus ac facilisis in</li>
					</ul>
					<div class="card-body">
						<a href="#" class="card-link">Card link</a>
						<a href="#" class="card-link">Another link</a>
					</div>
			  </div>
		  </div>
  </div>

		<br>
		<hr>
		<div class="row">
			<div class="text-center col-lg-6 offset-lg-3">
				<h4>Footer </h4>
				<p>Copyright &copy; 2015 &middot; All Rights Reserved &middot; <a href="#">My Website</a>
				</p>
			</div>
		</div>
</div>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery-3.3.1.min.js"></script>

	<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/popper.min.js"></script>
<script src="js/bootstrap-4.2.1.js"></script>
</body>
<!-- InstanceEnd --></html>