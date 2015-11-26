<?php
	session_start();
	if(($_GET['log'] == "in") && isset($_POST['email'])) {
		$login = true;
		$email = $_POST['email'];
		$password = $_POST['password'];
	} else if(isset($_COOKIE['email'])) {
		$login = true;
		$email = $_COOKIE['email'];
		$password = $_COOKIE['password'];
	} else if($_GET['log'] == "out") {
		session_unset();
		setcookie("email", "", time() - 3600);
		setcookie("password", "", time() - 3600);
	}

	if($login) {
		/*user has tried to authenticate*/
		include "php/getBasicData.php";
		$result = getBasicData(
				array("email", "password"),
				"USERS",
				array(
					"email"=>$email,
					"password"=>$password
				)
			);
		if (mysqli_num_rows($result) == 1) {
			/*user is authenticated*/
			$row = mysqli_fetch_assoc($result);
			$_SESSION['isLogged'] = true;
			$_SESSION['email'] = $email;
			if(isset($_POST['rememberMe'])) {
				$cookieEmailN = "email";
				$cookieEmailV = $_POST['email'];
				$cookiePwdN = "password";
				$cookiePwdV = $_POST['password'];
				setcookie($cookieEmailN, $cookieEmailV, time() + (86400 * 30), "/");
				setcookie($cookiePwdN, $cookiePwdV, time() + (86400 * 30), "/");
			}
		} else {
			/*user is not authenticated*/
			header("refresh:0.1;url=login.php?error=incorrectAuth");
		}
	}
	
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

		<!-- Latest compiled and minified CSS -->
		<link rel='stylesheet' href='css/bootstrap.css'>


		
		<link rel='stylesheet' href='css/styles.css'>
		
	</head>

	<body>

		<div class="row">
			<div class="col-sm-9">
				<img src="logo.jpg" class="img-rounded" alt="Cinque Terre" width="204" height="166">
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
						<li><a href="aquiz.php">All Quizes</a></li>
						<li><a href="mquiz.php">My Quizes</a></li>
						<li><a href="contact.php">Contact Us</a></li>
					</ul>
			
					<?php
						if($_SESSION['isLogged']) {
							/*user is logged*/
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
							/*user is not logged*/						
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
