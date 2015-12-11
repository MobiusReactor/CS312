<?php $title = "Viewing Quiz"; include 'php/header.php'; ?>

<?php
	
	if(!isset($_GET["quizID"])){
		header("Location: index.php");
	}
	
	$qID = (integer)$_GET["quizID"];

	$query = "SELECT COUNT(*) FROM QUESTS q WHERE q.questID = " . $qID . ";"; 

	$result = mysqli_query($link, $query) or die(mysql_error());
	
	
	
	if(mysqli_num_rows($result) == 0){
 		header("Location: index.php");	
	}
	
	$query = "SELECT questName FROM QUESTS q WHERE q.questID = " . $qID . ";"; 

	$result = mysqli_query($link, $query) or die(mysql_error());
	
	$qTitle = mysqli_fetch_assoc($result)['questName'];

	$query = "SELECT u.email FROM QUESTS q, USERS u WHERE q.questID = " . $qID . " AND q.createdBy = u.userID;"; 

	$result = mysqli_query($link, $query) or die(mysql_error());
	
	$qAuthor = mysqli_fetch_assoc($result)['email'];

?>





<div class="container">
	<div class="jumbotron">
		<div class="row">
			<h1><?php echo $qTitle;?></h1>
			<p>A quiz created by <?php echo $qAuthor;?></p>
		</div>
		



		<?php
		
			$query = "SELECT * FROM QUESTIONS q WHERE q.questionnaireID = " . $qID . ";"; 

			$result = mysqli_query($link, $query) or die(mysql_error());
			$question_idents = array();
			$i = 0;
			while($row = mysqli_fetch_array($result)){

				echo '<div class="form-group" name="atsakymas" type="title">';
				echo '	<div>';
				echo '		<label for="question">' . $row["question"] . '</label>';
				
				if($row["questionType"] == "text"){
					$question_idents [] = $row["questionID"];
					echo '		<input type="text" class="form-control" id="question" name="answer">';
				} else if($row["questionType"] == "radio"){
					$opt = explode(";", $row["options"]);
					echo '<br>';
					$index = 0;
					foreach($opt as $v){
						$index = $index + 1;
						$question_idents [] = $row["questionID"];
						echo '<label class="radio-inline">';
						//inlineRadioOptions
						echo '	<input type="radio" name="answer" id="inlineRadio" value="' . $v . '"> ' . $v;
						echo '</label>';
					}

				} else if($row["questionType"] == "mult"){
					$opt = explode(";", $row["options"]);
					echo '<br>';
					$index = 0;
					foreach($opt as $v){
						$v = str_replace("\'", "'", $v);
						$question_idents [] = $row["questionID"];
						$index = $index + 1;
						//inlineCheckOptions
						echo '<label class="checkbox-inline">';
						echo '	<input type="checkbox" name="answer" id="inlineCheckbox" value="' . $v . '"> ' . $v;
						echo '</label>';
						
					}
				}
				
				echo '	</div>';
				echo '</div><hr>';
			}

		?>

		<?php
			echo '<button onclick="validateEntry(\'' . $_SESSION["email"] . '\')" type="submit"';
			echo ' class="btn btn-default">Submit Quiz</button>';
		?>

		
	
	</div>

<script type="text/javascript">
	var qArray = new Array();
	function validateEntry(author){
		var ids = jQuery.parseJSON('<?php echo json_encode($question_idents) ?>');
		var aList = document.getElementsByName('answer');
		var valid = true;
		
		for(var i = 0; i < aList.length; i++){
			var cQuest = aList[i];
			var type = cQuest.getAttribute('type');
			var uSpec = cQuest.value;
			
			
			if(type == "text") {
				/*input type -> text*/
				var qName = uSpec;
				if(qName == ""){
					valid = false;
					break;
				} else {
					qArray.push([type,  ids[i], qName]);
				}
			} else if(type == "checkbox" || type == "radio"){
				var qName = uSpec;
				
				//var qOpt = uSpec.value;
				
				if(qName == ""){
					valid = false;
					break;
				} else {
					if(cQuest.checked){
						alert(ids[i]);
						qArray.push([type, ids[i], qName]);
					}
				}
			}
			
		}
		
		
		if(valid){

			qArray.push(["author", author, ""]);
			
			var sArray = JSON.stringify(qArray);
			
			$.ajax(
			{
				type:'POST',
				url:'php/submitanswer.php',
				data:{ answers:sArray },
				success: function(response){
					alert(response);
				},
				async: false
			});

			window.location.href = "mquiz.php";
			
		} else {
			alert("One or more fields is not set, please ensure all fields selected have text.");
		}
		
		//header("refresh:0.1;url=quizcreator.php");
	}
</script>
</div>

<?php include 'php/footer.php'; ?>
