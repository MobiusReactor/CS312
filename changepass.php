<?php $title = "Sign Up"; include 'php/header.php'; ?>


<div class="container">
	<div class="jumbotron">
		<?php
			if (isset($_POST['token'])) {
				$token = $_POST['token'];
				
				if($_POST["reg_pword"] != $_POST["reg_pwordc"]){
					// Passwords do not match, redirect back to settings form
					header("Location: accmanage.php?msg=pwds&token=$token");
					die();
				}
				
				// Double-check token and get email
				$query = "SELECT email FROM TOKENS t, USERS u WHERE u.userID = t.userID AND token = '$token';";
				$result = mysqli_query($link, $query) or die(mysqli_error($link));
				
				if(mysqli_num_rows($result) == 1) {
					$row = mysqli_fetch_assoc($result);
					$email = $row['email'];
				} else {
					// If token is not in database, redirect to login page
					header("Location: login.php?msg=invalidToken");
					die();
				}
				
				// Delete token
				$query = "DELETE FROM TOKENS WHERE token = '$token'";
				mysqli_query($link, $query) or die(mysqli_error($link));
				
				// Set oldpass to a dummy value to avoid error, set skippass to true
				$oldpass = "";
				$skippass = true;
			} else {
				if(!($_POST["reg_pword"]  != "" && $_POST["reg_pwordc"]  != "" && $_POST["reg_oldpword"]  != "")){
					// One or more fields missing data, redirect back to settings form
					header("Location: accmanage.php?msg=missing");
					die();
				}
			
				if($_POST["reg_pword"] != $_POST["reg_pwordc"]){
					// Passwords do not match, redirect back to settings form
					header("Location: accmanage.php?msg=pwds");
					die();
				}
				
				$email = $_SESSION['email'];
				$oldpass = $_POST["reg_oldpword"];
			}
			
			// Get current password
			$result = getBasicData(
				array("email", "password"),
				"USERS",
				array(
					"email"=>$email
				)
			);
			
			$row = mysqli_fetch_assoc($result);
			
			if (password_verify($oldpass, $row["password"]) || $skippass) {
				$query = sprintf("UPDATE USERS 
							SET password='%s'
							WHERE email='%s'",
					mysqli_real_escape_string($link, password_hash($_POST["reg_pwordc"], PASSWORD_BCRYPT)),
					mysqli_real_escape_string($link, $email)
				) or die(mysql_error());
			
				mysqli_query($link, $query) or die(mysql_error()); 
				
				if ($skippass) {
					header("Location: login.php?msg=success");
					die();
				} else {
					header("Location: accmanage.php?msg=success");
					die();
				}
			} else {
				/*email/password pair is not found -> send user back to login form*/
				header("Location: accmanage.php?msg=oldpwd");
			}
		?>
	</div>
</div>

<?php include 'php/footer.php'; ?>
