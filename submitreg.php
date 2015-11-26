<?php include 'header.php'; ?>


<div class="container">
	<div class="jumbotron">
		<?php
			if(!($_POST["reg_email"] != "" && $_POST["reg_pword"]  != "" && $_POST["reg_pwordc"]  != "")){
				echo("One or more fields missing data, redirecting back to signup form!");	
				header("refresh:2;url=signup.php");
				die();
			}
			
			if($_POST["reg_pword"] != $_POST["reg_pwordc"]){
				echo("Passwords do not match!");	
				header("refresh:2;url=signup.php");
				die();
			}
			
			//$_uname = "isb13142";
			//$_pword = "eiXaim9ee8mi";
			$servername = "localhost";
			$username = "root";
			$password = "12345";
			//mysql_connect("devweb2015.cis.strath.ac.uk", $_uname, $_pword);
			mysql_connect($servername, $username, $password);
			//mysql_select_db($_uname) or die(mysql_error());
			mysql_select_db("SoEDB") or die(mysql_error());

			
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
				echo "<li>" . $row["username"] . "</li>";
			}

			echo "</ul>";

			echo "Account successfully registered";
			header("refresh:2;url=index.php");
		?>
	</div>
</div>

<?php include 'footer.php'; ?>

