<?php
	include "php/dbfetcher.php";
	/**
	 * This piece of code is dealing with
	 * user authentication processes:
	 * 	cookie setting/usetting, loggin in/out,
	 * 	validating login input etc.
	 */
	$login = false;
	session_start();

	if (isset($_POST['resetpass'])) {
		$email = $_POST['email'];
		
		if ($email != "") {			
			$result = getBasicData(
				array("userID", "email"),
				"USERS",
				array("email"=>$email)
			);
			
			if (mysqli_num_rows($result) == 1) {
				$row = mysqli_fetch_assoc($result);
				
				// Get token info
			
				$userID = $row['userID'];
				$token = bin2hex(openssl_random_pseudo_bytes(32));
				$expiry = date("Y-m-d H:i:s", strtotime("+6 hours"));
			
			
				// Delete old token, if one exists in the database already
				$query = "DELETE FROM TOKENS WHERE userID = '$userID'";
				mysqli_query($link, $query) or die(mysqli_error($link));
				
				// Add new token to database
				$addToken = "INSERT INTO TOKENS (userID, token, expiry)
				VALUES ('$userID', '$token', '$expiry');";
				mysqli_query($link, $addToken) or die(mysqli_error($link));
			
			
				// Send email containing token to user
			
				$subject = "Password reset link";
				$uri = "https://devweb2015.cis.strath.ac.uk" . dirname($_SERVER['PHP_SELF']) . "/accmanage.php?token=$token";
				$message = "
				<html>
				<head>
				<title>Password reset link for CS312 Quiz System</title>
				</head>
				<body>
				<p>Click on the link below to reset your password: </br></p>
				<a href='$uri'>$uri</a>
				<p>For security, this link will expire in six hours.</p>
				</body>
				</html>
				";
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
				$headers .= 'From: Admin<dsb12180@uni.strath.ac.uk>' . "\r\n";
			
				if(mail($email, $subject, $message, $headers)) {
					echo "A password reset link has been sent to $email";
					header("Location: login.php?msg=emailSent");
					die();
				} else {
					header("Location: login.php?msg=emailNotSent");
					die();
				}
			} else {
				echo "That email address does not belong to a registered user.";
				header("Location: login.php?msg=invalidUser&reset");
				die();
			}
		} else {
			header("Location: login.php?msg=noEmail&reset");
		}
		die();
	}
	
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
				array("email", "password", "isAdmin"),
				"USERS",
				array(
					"email"=>$email
				)
			);
		if (mysqli_num_rows($result) == 1) {
			/*email/password pair is found -> log user in*/
			
			$row = mysqli_fetch_assoc($result);
			
			if (password_verify($password, $row['password'])){
				$_SESSION['isLogged'] = true;
				$_SESSION['email'] = $email;

				if ($row["isAdmin"]=='1') {
					$_SESSION['admin'] = true;
				}

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
				header("Location: login.php?msg=incorrectAuth");
			}
		} else {
			/*email/password pair is not found -> send user back to login form*/
			header("Location: login.php?msg=incorrectAuth");
		}
	}
?>
