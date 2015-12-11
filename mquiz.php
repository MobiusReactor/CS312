<?php $title = "My Quizzes"; include 'php/header.php'; ?>


<div class="container">
	<div class="jumbotron">
		<h1>My Quizzes!</h1>
		<p>Placeholder for list of your own quizzes and ability to edit them.</p>
		
		
		<?php
	
			$query = "SELECT * FROM QUESTS q, USERS u WHERE u.email = \"" . $_SESSION["email"] . "\" AND u.userID = q.createdBy;"; 

			$result = mysqli_query($link, $query) or die(mysqli_error());
			
			echo "<h2>LIST OF YOUR QUESTIONAIRES:</h2>";

			?>
			
			<div class="row">
			<?php while($row = mysqli_fetch_array($result)) : ?>
				<div class="col-xs-4">
				<div class="panel panel-default" align="center">
				<a href="myquizanalysis.php?quizID= <?php echo $row["questID"];?>" style=" text-decoration: none;">
				<h2> <?php echo $row["questName"]; ?></h2>
				</a>
				</div>	
				</div>	
			<?php endwhile; ?>
			</div>
		
		
		<form action="quizcreator.php">
			<button type="submit" class="btn btn-default">Create New Quiz</button>
		</form>

	</div>
</div>

<?php include 'php/footer.php'; ?>

