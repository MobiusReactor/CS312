<?php $title = "My Quizzes"; include 'php/header.php'; ?>

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
				$result2 = getBasicData(array("questionID"), "QUESTIONS", array("questionnaireID" => $row['questID']));
			
				$question_idents = array();

				while($row2 = mysqli_fetch_array($result2)) {
					$question_idents[] = $row2['questionID'];
				}

				$question_idents = json_encode($question_idents);

				echo "<li><a href='myquizanalysis.php?quizID=".$row['questID']."'";
				echo " onlick='showQuizStats(".$question_idents.")'>" . $row["questName"] . "</a></li>";
			}

			echo "</ul>";

		?>
		
		<form action="quizcreator.php">
			<button type="submit" class="btn btn-default">Create New Quiz</button>
		</form>

	<script>
		function showQuizStats(quizID){
			var data = JSON.parse(quizID);
			alert(data);
		}
	</script>

	</div>
</div>

<?php include 'php/footer.php'; ?>

