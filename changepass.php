<?php $title = "Sign Up"; include 'php/header.php'; ?>


<div class="container">
	<div class="jumbotron">
		<?php
			if(!($_POST["reg_pword"]  != "" && $_POST["reg_pwordc"]  != "" && $_POST["reg_oldpword"]  != "")){
				// One or more fields missing data, redirect back to settings form
				header("refresh:0.1;url=accmanage.php?error=missing");
				die();
			}
			
			if($_POST["reg_pword"] != $_POST["reg_pwordc"]){
				// Passwords do not match, redirect back to settings form
				header("refresh:0.1;url=accmanage.php?error=pwds");
				die();
			}
			
			$result = getBasicData(
				array("email", "password"),
				"USERS",
				array(
					"email"=>$_SESSION['email']
				)
			);
		
			$row = mysqli_fetch_assoc($result);
			
			if (password_verify($_POST["reg_oldpword"], $row["password"])){
				$query = sprintf("UPDATE USERS 
							SET password='%s'
							WHERE email='%s'",
					mysqli_real_escape_string($link, password_hash($_POST["reg_pwordc"], PASSWORD_BCRYPT)),
					mysqli_real_escape_string($link, $_SESSION["email"])
				) or die(mysql_error());
			
				mysqli_query($link, $query) or die(mysql_error()); 

				echo "Password changed successfully!";
			} else {
				/*email/password pair is not found -> send user back to login form*/
				header("refresh:3;url=accmanage.php?error=oldpwd");
			}
		?>
	</div>
</div>

<?php include 'php/footer.php'; ?>
