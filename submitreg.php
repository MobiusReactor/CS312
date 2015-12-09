<?php 
	include 'php/header.php';
?>


<div class="container">
	<div class="jumbotron">
		<?php
			if(!($_POST["reg_email"] != "" && $_POST["reg_pword"]  != "" && $_POST["reg_pwordc"]  != "")){
				//echo("One or more fields missing data, redirecting back to signup form!");	
				//header("refresh:2;url=signup.php");
				header("refresh:0.1;url=signup.php?error=missing");
				die();
			}

			if(!filter_var($_POST["reg_email"], FILTER_VALIDATE_EMAIL)) {
				header("refresh:0.1;url=signup.php?error=email");
				die();
			}

			$emailResults = getBasicData(array("email"), "USERS", array("email"=>$_POST['reg_email']));
			if(mysqli_num_rows($emailResults) > 0) {
				//echo("Email is already taken, choose another one!");	
				//header("refresh:2;url=signup.php");
				header("refresh:0.1;url=signup.php?error=taken");
				die();	
			}
			
			if($_POST["reg_pword"] != $_POST["reg_pwordc"]){
				//echo("Passwords do not match!");	
				//header("refresh:2;url=signup.php");
				header("refresh:0.1;url=signup.php?error=pwds");
				die();
			}
			
			
			$query = sprintf("INSERT INTO USERS (email, password) VALUES('%s', '%s') ",
				mysqli_real_escape_string($link, $_POST["reg_email"]),
				mysqli_real_escape_string($link, $_POST["reg_pwordc"])
				//mysqli_real_escape_string($link, $_POST["dateOfBirth"])
			) or die(mysql_error());
			
			
			mysqli_query($link, $query) or die(mysql_error()); 
	
			
			$query = "SELECT * FROM USERS"; 
			$result = mysqli_query($link, $query) or die(mysql_error());
				
			echo "<h2>LIST OF USERS:</h2>";
			echo "<ul>";
			while($row = mysqli_fetch_array($result)){
				echo "<li>" . $row["email"] . "</li>";
			}
			echo "</ul>";
			echo "Account successfully registered";
			//header("refresh:2;url=index.php");
		?>
	</div>
</div>

<?php include 'php/footer.php'; ?>
