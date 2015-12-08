<?php
	include "php/getBasicData.php";
	/**
	 * This piece of code is dealing with
	 * user authentication processes:
	 * 	cookie setting/usetting, loggin in/out,
	 * 	validating login input etc.
	 */
	$login = false;
	session_start();
	if(isset($_GET['log'])){
		/*user has either tried to log in or out.*/
		if($_GET['log'] == "out") {
			/*user logged out -> end the session and remove cookies*/
			session_unset();
			unset($_COOKIE['email']);
			unset($_COOKIE['password']);
			setcookie("email", "", time() - 3600, "/");
			setcookie("password", "", time() - 3600, "/");
		} else if(($_GET['log'] == "in") && isset($_POST['email'])) {
			/*user logged in -> fetch email/password*/
			$login = true;
			$email = $_POST['email'];
			$password = $_POST['password'];
		} else if(isset($_COOKIE['email'])) {
			/*user has login cookies set -> fetch them*/
			$login = true;
			$email = $_COOKIE['email'];
			$password = $_COOKIE['password'];
		}
	}

	if($login) {
		/*user has tried to authenticate -> compare his input with the input in Database*/
		$result = getBasicData(
				array("email", "password"),
				"USERS",
				array(
					"email"=>$email,
					"password"=>$password
				)
			);
		if (mysqli_num_rows($result) == 1) {
			/*email/password pair is found -> log user in*/
			$row = mysqli_fetch_assoc($result);
			$_SESSION['isLogged'] = true;
			$_SESSION['email'] = $email;
			if(isset($_POST['rememberMe'])) {
				/*user checked the 'Remember Me' box -> set cookies*/
				$cookieEmailN = "email";
				$cookieEmailV = $_POST['email'];
				$cookiePwdN = "password";
				$cookiePwdV = $_POST['password'];
				setcookie($cookieEmailN, $cookieEmailV, time() + (86400 * 30), "/");
				setcookie($cookiePwdN, $cookiePwdV, time() + (86400 * 30), "/");
			}
		} else {
			/*email/password pair is not found -> send user back to login form*/
			header("refresh:0.1;url=login.php?error=incorrectAuth");
		}
	}
	
?>
