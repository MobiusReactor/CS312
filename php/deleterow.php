<?php
	include "dbfetcher.php";
	$link = connect();
	if(isset($_REQUEST['ID']) && isset($_REQUEST['DB'])){
		$id = $_REQUEST['ID'];
		$table = $_REQUEST['DB'];
		switch($table){
			case "user":
				deleteUser($id, $link);
				break;
			case "quiz":
				deleteQuiz($id, $link);
				break;
			case "question":
				deleteQuestion($id, $link);
				break;
			case "answer":
				deleteAnswer($id, $link);
				break;
			default:
				echo mysqli_error($link);
		}
		echo "true";
	}
 
	function deleteUser($userID, $link){
		// Delete User's answers to other quizes
		$query = "DELETE FROM ANSWERS WHERE answeredBy = $userID";
		mysqli_query($link, $query) or die(mysqli_error($link));

		// Delete answers to User's quiz questions
		$query = "DELETE FROM ANSWERS WHERE questionID IN (
					SELECT questionID FROM QUESTIONS WHERE questionnaireID IN (
						SELECT questID FROM QUESTS WHERE createdBy = $userID))";
		mysqli_query($link, $query) or die(mysqli_error($link));

		// In order to delete User, first we need to delete questions
		// associated with it.
		$query = "DELETE FROM QUESTIONS WHERE questionnaireID IN (
					SELECT questID FROM QUESTS WHERE createdBy = $userID)";
		mysqli_query($link, $query) or die(mysqli_error($link));

		// After that, Questionnaires needs to be deleted before deleting
		// user.
		$query = "DELETE FROM QUESTS WHERE createdBy = $userID";
		mysqli_query($link, $query)or die(mysqli_error($link));

		// Finally, delete the user.
		$query = "DELETE FROM USERS WHERE userID = $userID";
		mysqli_query($link, $query)or die(mysqli_error($link));
	}

	function deleteQuiz($quizID, $link){
		$query = "DELETE FROM ANSWERS WHERE questionID IN (
					SELECT questionID FROM QUESTIONS WHERE questionnaireID = $quizID)";
		mysqli_query($link, $query) or die(mysqli_error($link));

		$query = "DELETE FROM QUESTIONS WHERE questionnaireID = $quizID";
		mysqli_query($link, $query) or die(mysqli_error($link));

		$query = "DELETE FROM QUESTS WHERE questID = $quizID";
		mysqli_query($link, $query) or die(mysqli_error($link));
	}

	function deleteQuestion($questionID, $link){ 
		$query = "DELETE FROM ANSWERS WHERE questionID = $questionID";
		mysqli_query($link, $query) or die(mysqli_error($link));

		$query = "DELETE FROM QUESTIONS WHERE questionID = $questionID";
		mysqli_query($link, $query) or die(mysqli_error($link));
	}
	
	function deleteAnswer($answerID, $link){
		$query = "DELETE FROM ANSWERS WHERE answerID = $answerID";
		mysqli_query($link, $query) or die(mysqli_error($link));
	} 
?>