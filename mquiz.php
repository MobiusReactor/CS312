<?php $title = "My Quizzes"; include 'php/header.php'; ?>

<?php
	if(!isset($_SESSION["email"])){
		header("Location: index.php");
	}
?>


<div class="container">
	<div class="jumbotron">
		<h1>My Quizzes!</h1>
		<p>Here's a list of the quizzes you've made!</p>

		<h2>LIST OF YOUR QUESTIONAIRES:</h2>
		<hr class="colorgraph">

		<?php

			$query = "SELECT * FROM QUESTS q, USERS u WHERE u.email = \"" . $_SESSION["email"] . "\" AND u.userID = q.createdBy;";

			$result = mysqli_query($link, $query) or die(mysqli_error());


			?>

			<div class="row">
			<?php while($row = mysqli_fetch_array($result)) : ?>
				<div class="col-xs-4">
					<div class="panel panel-default" align="center">
						<a href="myquizanalysis.php?quizID=<?php echo $row["questID"];?>" style=" text-decoration: none;">
							<h2> <?php echo $row["questName"]; ?></h2>
						</a>
					</div>
					<hr class="colorgraph">
				</div>	
			<?php endwhile; ?>
			</div>
		
		
		<form action="quizcreator.php">
			<button type="submit" class="btn btn-default">Create New Quiz</button>
		</form>

	</div>
</div>

<?php include 'php/footer.php'; ?>

