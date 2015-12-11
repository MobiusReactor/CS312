<?php $title = "All Quizzes"; include 'php/header.php'; ?>

<?php 
	if(!isset($_SESSION["email"])){
		header("Location: index.php");
	}
?>

<div class="container">
	<div class="jumbotron">
		<h1>All Quizzes!</h1>
		<p>Here's a list of all quizzes you can answer right now!</p>
		
		<?php
			$query = "SELECT * FROM QUESTS"; 
			$result = mysqli_query($link, $query) or die(mysql_error());
		 ?>
				
			<h2>LIST OF QUESTIONAIRES:</h2>
			<hr class="colorgraph">
			<div class="row">
			<?php while($row = mysqli_fetch_array($result)) : ?>
				<div class="col-xs-4">
				<div class="panel panel-default" align="center">
				<a href="quizviewer.php?quizID=<?php echo $row["questID"];?>" style=" text-decoration: none;">
				<h2> <?php echo $row["questName"]; ?></h2>
				</a>
				</div>
				<hr class="colorgraph">	
				</div>	
			<?php endwhile; ?>
			</div>
		
	</div>
</div>

<?php include 'php/footer.php'; ?>
