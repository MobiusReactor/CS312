<?php include 'php/header.php'; ?>

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
	
			$query = "SELECT * FROM QUESTS q, USERS u WHERE u.email = \"" . $_SESSION["email"] . "\" AND u.userID = q.createdBy;"; 

			$result = mysqli_query($link, $query) or die(mysqli_error());
				
			echo "<h2>LIST OF YOUR QUESTIONAIRES:</h2>";

			echo "<ul>";

			while($row = mysqli_fetch_array($result)){
				echo "<li>" . $row["questName"] . "</li>";
			}

			echo "</ul>";

		?>
		
		<form action="quizcreator.php">
			<button type="submit" class="btn btn-default">Create New Quiz</button>
		</form>
	</div>
</div>

<?php include 'php/footer.php'; ?>

