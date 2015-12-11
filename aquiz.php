<?php $title = "All Quizzes"; include 'php/header.php'; ?>

<?php 
	if(!isset($_SESSION["email"])){
		header("Location: index.php");
	}
?>

<div class="container">
	<div class="jumbotron">
		<h1>All Quizzes!</h1>
		<p>Placeholder for list of all quizzes you can fill out when logged in.</p>
		
		<?php

			$query = "SELECT * FROM QUESTS"; 

			$result = mysqli_query($link, $query) or die(mysql_error());
				
			echo "<h2>LIST OF QUESTIONAIRES:</h2>";

			echo "<ul>";

			while($row = mysqli_fetch_array($result)){
				echo "<li><a href='quizviewer.php?quizID=" . $row["questID"] . "'>" . $row["questName"] . "</a></li>";
			}

			echo "</ul>";

		?>
	</div>
</div>

<?php include 'php/footer.php'; ?>

