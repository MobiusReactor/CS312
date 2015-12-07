<?php
	ini_set('display_errors', 'On');
	error_reporting(E_ALL);

	echo dirname(__DIR__);


	$_sname = "devweb2015.cis.strath.ac.uk";
	$_uname = "isb13142";
	$_pword = "eiXaim9ee8mi";
	//$_sname = "localhost";
	//$_uname = "root";
	//$_pword = "12345";
	mysql_connect($_sname, $_uname, $_pword);
	mysql_select_db($_uname) or die(mysql_error());
	//mysql_select_db("SoEDB") or die(mysql_error());

	include "authentication.php";
?>
<!DOCTYPE html>
<html lang='en'>

	<head>
		<meta charset='utf-8'>
		<meta name='viewport' content='width=device-width, initial-scale=1'>

		<!-- Latest compiled JQuery -->
		<script src='js/jquery-1.11.3.min.js'></script>

		<!-- Latest compiled JavaScript -->
		<script src='js/bootstrap.js'></script>

		<script src='js/themeChanger.js'></script>

		<!-- Latest compiled and minified CSS -->
		<link rel='stylesheet' href='css/bootstrap.css'>

		<link rel='stylesheet' href='css/styles.css'>

	</head>

	<body>

		<div class="row">
			<div class="col-sm-9">
				<img src="img/logo.jpg" class="img-rounded" alt="Cinque Terre" width="204" height="166">
			</div>

			<div class="dropdown" align="right">
					<button class='btn btn-default dropdown-toggle' type='button'
					data-toggle='dropdown'>
					<span class='glyphicon glyphicon-picture'></span> Theme
					<span class='caret'></span></button>
					<ul class='dropdown-menu dropdown-menu-right'>
						<li><a href="#" data-theme="default" class="theme-link">Default</a></li>
						<li><a href="#" data-theme="dark" class="theme-link">Dark</a></li>
						<li><a href="#" data-theme="test" class="theme-link">Test</a></li>
					</ul>
			</div>
		</div>


		<nav class="navbar navbar-default">

			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="index.php">CS312 - Quiz</a>
				</div>

				<div>
					<ul class="nav navbar-nav">
						<li><a href="index.php">Home Page</a></li>
						<?php
							if(isset($_SESSION['isLogged'])) {
								echo "<li><a href='aquiz.php'>All Quizes</a></li>";
								echo "<li><a href='mquiz.php'>My Quizes</a></li>";
							}
						?>
						<li><a href="contact.php">Contact Us</a></li>
					</ul>

					<?php
						if(isset($_SESSION['isLogged'])) {
							/*user is logged -> display the account menu*/
							$email = $_SESSION['email'];
							echo " <div class='dropdown rightDiv'>
  								<button class='btn btn-primary dropdown-toggle' type='button'
									 data-toggle='dropdown'>
										$email
								<span class='caret'></span></button>
								<ul class='dropdown-menu'>
									<li><a href='index.php?log=out'>Logout</a></li>
								</ul>
							</div>";

						} else {
							/*user is not logged -> display
							  Sign Up/Login links*/
							echo "<ul class='nav navbar-nav navbar-right'>
								<li><a href='signup.php'>
									<span class='glyphicon glyphicon-user'></span> Sign Up
								</a></li>
								<li><a href='login.php'>
									<span class='glyphicon glyphicon-log-in'></span> Login
								</a></li>
							</ul>";
						}
					?>


				</div>
			</div>

		</nav>
