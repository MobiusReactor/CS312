<?php 
	include 'php/header.php';
?>


<div class="container">
	<div class="jumbotron">
		<?php
			if(!($_POST["reg_email"] != "" && $_POST["reg_pword"]  != "" && $_POST["reg_pwordc"]  != "")){
				echo("One or more fields missing data, redirecting back to signup form!");	
				header("refresh:2;url=signup.php");
				die();
			}

			$emailResults = getBasicData(array("email"), "USERS", array("email"=>$_POST['reg_email']));
			if(mysql_num_rows($emailResults) > 0) {
				echo("Email is already taken, choose another one!");	
				header("refresh:2;url=signup.php");
				die();	
			}
			
			if($_POST["reg_pword"] != $_POST["reg_pwordc"]){
				echo("Passwords do not match!");	
				header("refresh:2;url=signup.php");
				die();
			}
			

			
			$query = sprintf("INSERT INTO USERS (email, password) VALUES('%s', '%s') ",
				mysql_real_escape_string($_POST["reg_email"]),
				mysql_real_escape_string($_POST["reg_pwordc"])
			) or die(mysql_error());
			
			
			mysql_query($query) or die(mysql_error()); 
	
			
			$query = "SELECT * FROM USERS"; 

			$result = mysql_query($query) or die(mysql_error());
				
			echo "<h2>LIST OF USERS:</h2>";

			echo "<ul>";

			while($row = mysql_fetch_array($result)){
				echo "<li>" . $row["email"] . "</li>";
			}

			echo "</ul>";

			echo "Account successfully registered";
			header("refresh:2;url=index.php");
		?>
	</div>
</div>

<?php include 'php/footer.php'; ?>

