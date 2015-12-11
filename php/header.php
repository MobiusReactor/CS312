<?php
	ini_set('display_errors', 'On');
	error_reporting(E_ALL);

	$_sname = "devweb2015.cis.strath.ac.uk";
	$_uname = "isb13142";
	$_pword = "eiXaim9ee8mi";

	$link = mysqli_connect($_sname, $_uname, $_pword);
	mysqli_select_db($link, $_uname) or die(mysql_error());

	include "authentication.php";
?>
<!DOCTYPE html>
<html lang='en'>
	<head>
		<?php if (isset($title)) echo "<title>$title</title>" ?>
		<meta charset='utf-8'>
		<meta name='viewport' content='width=device-width, initial-scale=1'>

		<!-- Latest compiled and minified CSS -->
		<link rel='stylesheet' href='css/bootstrap.min.css'>
		<link rel='stylesheet' href='css/datepicker.css'>
		<link rel='stylesheet' href='css/styles.css'>
		<!-- Latest compiled JQuery -->
		<script src='js/jquery-1.11.3.min.js'></script>
		<script src='https://www.google.com/recaptcha/api.js'></script>
		<!-- Latest compiled JavaScript -->
		<script src='js/bootstrap.min.js'></script>
		<script src='js/bootstrap-datepicker.js'></script>
		<!--<script src='https://www.google.com/recaptcha/api.js'></script>-->
		<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.js'></script>

		</head>

	<body>
<div id="wrap">
	<div id="main">
		<nav class="navbar navbar-default" style="margin-bottom: 0;">
			<div class="container-fluid">
				<div class="navbar-header">

					<a class="navbar-brand" href="
					<?php
						if(!isset($_SESSION['isLogged']))
							echo 'index.php';
					?>
					">CS312 - Quiz</a>

				</div>

				<div>
					<ul class="nav navbar-nav">

						<?php
							if(isset($_SESSION['isLogged'])) {
								echo "<li><a href='aquiz.php'>All Quizzes</a></li>";
								echo "<li><a href='mquiz.php'>My Quizzes</a></li>";
							}

							//if(isset($_SESSION['admin'])) {
							//	echo "<li><a href='myadmin.php'>Admin Panel</a></li>";
							//}
						?>
						<li><a href="contact.php">Contact Us</a></li>
					</ul>

					<?php
						if(isset($_SESSION['isLogged'])) {
							/* User is logged in -> display the account menu */
							$email = $_SESSION['email'];
							echo " <div class='dropdown rightDiv'>
  								<button class='btn btn-default dropdown-toggle' type='button'
									 data-toggle='dropdown'>
										$email
								<span class='caret'></span></button>
								<ul class='dropdown-menu'>
									<li><a href='accmanage.php'>Settings</a></li>
								";
							if(isset($_SESSION['admin'])) {
								echo "<li><a href='myadmin.php'>Admin Panel</a></li>";
							}
							echo "<li><a href='index.php?log=out'>Logout</a></li>
								</ul></div>";

						} else {
							/* User is not logged in -> display Sign Up/Login links */
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

		<br/>
		<br/>
