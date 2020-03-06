<?php require_once("webassist/form_validations/wavt_scripts_php.php"); ?>
<?php require_once("webassist/form_validations/wavt_validatedform_php.php"); ?>
<?php 
if ($_SERVER["REQUEST_METHOD"] === "POST")  {
  $WAFV_Redirect = "registration.php";
  $_SESSION['WAVT_registrationok_728_Errors'] = "";
  if ($WAFV_Redirect == "")  {
    $WAFV_Redirect = $_SERVER["PHP_SELF"];
  }
  $WAFV_Errors = "";
  $WAFV_Errors .= WAValidateEM(((isset($_POST["txtEmail"]))?$_POST["txtEmail"]:"") . "",true,1);
  $WAFV_Errors .= WAValidateRQ(((isset($_POST["txtPassword"]))?$_POST["txtPassword"]:"") . "",false,2);
  $WAFV_Errors .= WAValidateLE(((isset($_POST["txtConfirmPassword"]))?$_POST["txtConfirmPassword"]:"") . "",((isset($_POST["txtPassword"]))?$_POST["txtPassword"]:"") . "",true,3);
  $WAFV_Errors .= WAValidateRQ(((isset($_POST["txtFirstName"]))?$_POST["txtFirstName"]:"") . "",false,4);
  $WAFV_Errors .= WAValidateRQ(((isset($_POST["txtLastName"]))?$_POST["txtLastName"]:"") . "",false,5);
  $WAFV_Errors .= WAValidateRQ(((isset($_POST["txtAddress"]))?$_POST["txtAddress"]:"") . "",false,6);
  $WAFV_Errors .= WAValidateRQ(((isset($_POST["txtCity"]))?$_POST["txtCity"]:"") . "",false,7);
  $WAFV_Errors .= WAValidateRQ(((isset($_POST["txtCountry"]))?$_POST["txtCountry"]:"") . "",false,8);
  $WAFV_Errors .= WAValidateLE(((isset($_POST["txtSecurity_Code_1"]))?$_POST["txtSecurity_Code_1"]:"") . "",$_SESSION['captcha_Security_Code_1'] . "",true,9);

  if ($WAFV_Errors != "")  {
    PostResult($WAFV_Redirect,$WAFV_Errors,"registrationok_728");
  }
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
							<!--<small>
								You have to register for work with the system
							</small>-->
						</p>
					</div>
					<!--<img class="card-img-top" src="images/card-img.png" alt="Card image cap">-->
					<div class="card-body">
						Thank you for registation.Now you have to open your mail to confirm the registration.
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