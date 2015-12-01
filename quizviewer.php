<?php include 'php/header.php'; ?>

<?php
	
	if(!isset($_GET["quizID"])){
		header("Location: index.php");
	}
	
	$qID = (integer)$_GET["quizID"];

	$query = "SELECT COUNT(*) FROM QUESTS q WHERE q.questID = " . $qID . ";"; 

	$result = mysql_query($query) or die(mysql_error());
	
	$iRes = (integer)(mysql_result($result, 0, 0));
	
	
	if($iRes != 1){
		header("Location: index.php");	
	}
	
	$query = "SELECT questName FROM QUESTS q WHERE q.questID = " . $qID . ";"; 

	$result = mysql_query($query) or die(mysql_error());
	
	$qTitle = (mysql_result($result, 0, 0));

	
	$query = "SELECT u.email FROM QUESTS q, USERS u WHERE q.questID = " . $qID . " AND q.createdBy = u.userID;"; 

	$result = mysql_query($query) or die(mysql_error());
	
	$qAuthor = (mysql_result($result, 0, 0));

?>

<div class="container">
	<div class="jumbotron">
		<div class="row">
			<h1><?php echo $qTitle;?></h1>
			<p>A quiz created by <?php echo $qAuthor;?></p>
		</div>
		



		<?php
		
			$query = "SELECT * FROM QUESTIONS q WHERE q.questionnaireID = " . $qID . ";"; 

			$result = mysql_query($query) or die(mysql_error());
				

			while($row = mysql_fetch_array($result)){

				echo '<div class="form-group" name="question" type="title">';
				echo '	<div>';
				echo '		<label for="question">' . $row["question"] . '</label>';
				
				if($row["questionType"] == "text"){
					echo '		<input type="text" class="form-control" id="question">';
				} else if($row["questionType"] == "radio"){
					$opt = explode(";", $row["options"]);
					echo '<br>';
					$index = 0;
					foreach($opt as $v){
						$index = $index + 1;
						
						echo '<label class="radio-inline">';
						echo '	<input type="radio" name="inlineRadioOptions" id="inlineRadio" value="' . $index . '"> ' . $v;
						echo '</label>';
						
						//echo '<input id="question" class="form-group" value="' . $index . '" type="checkbox">' . $v . '</input>';
					}

				} else if($row["questionType"] == "mult"){
					$opt = explode(";", $row["options"]);
					echo '<br>';
					$index = 0;
					foreach($opt as $v){
						$index = $index + 1;
						
						echo '<label class="checkbox-inline">';
						echo '	<input type="checkbox" name="inlineCheckOptions" id="inlineCheckbox" value="' . $index . '"> ' . $v;
						echo '</label>';
						
						//echo '<input id="question" class="form-group" value="' . $index . '" type="checkbox">' . $v . '</input>';
					}
				}
				
				echo '	</div>';
				echo '</div><hr>';
			}

		?>

		<?php
			echo '<button onclick="validateEntry(\'' . $_SESSION["email"] . '\')" type="submit" class="btn btn-default">Submit Quiz</button>';
		?>

		
		
	
	</div>
</div>

<?php include 'php/footer.php'; ?>
