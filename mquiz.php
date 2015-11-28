<?php include 'header.php'; ?>

<?php 
	if(!isset($_SESSION["email"])){
			header("Location: index.php");
	}
?>



<div class="container">
	<div class="jumbotron">
		<h1>My Quizzes!</h1>
		<p>Placeholder for list of your own quizzes and ability to edit them.</p>
		
		
		<?php
			
			$_uname = "isb13142";
			$_pword = "eiXaim9ee8mi";
			mysql_connect("devweb2015.cis.strath.ac.uk", $_uname, $_pword);
			mysql_select_db($_uname) or die(mysql_error());
		
				
	
			$query = "SELECT * FROM QUESTS q, USERS u WHERE u.email = \"" . $_SESSION["email"] . "\" AND u.userID = q.createdBy;"; 

			$result = mysql_query($query) or die(mysql_error());
				
			echo "<h2>LIST OF YOUR QUESTIONAIRES:</h2>";

			echo "<ul>";

			while($row = mysql_fetch_array($result)){
				echo "<li>" . $row["questName"] . "</li>";
			}

			echo "</ul>";

		?>
		
		<form action="quizcreator.php">
			<button type="submit" class="btn btn-default">Create New Quiz</button>
		</form>
	</div>
</div>

<?php include 'footer.php'; ?>

