<?php
	include "dbfetcher.php";
	$link = connect();
	if(isset($_REQUEST['ID']) && isset($_REQUEST['DB'])){
		$id = $_REQUEST['ID'];
		$table = $_REQUEST['DB'];
		// Delete User's answers to other quizes
		$query = "DELETE FROM ANSWERS WHERE answeredBy = $id";
		mysqli_query($link, $query) or die(mysqli_error($link));

		// Delete answers to User's quiz questions
		$query = "DELETE FROM ANSWERS WHERE questionID IN (
					SELECT questionID FROM QUESTIONS WHERE questionnaireID IN (
						SELECT questID FROM QUESTS WHERE createdBy = $id))";
		mysqli_query($link, $query) or die(mysqli_error($link));

		// In order to delete User, first we need to delete questions
		// associated with it.
		$query = "DELETE FROM QUESTIONS WHERE questionnaireID IN (
					SELECT questID FROM QUESTS WHERE createdBy = $id)";
		mysqli_query($link, $query) or die(mysqli_error($link));

		// After that, Questionnaires needs to be deleted before deleting
		// user.
		$query = "DELETE FROM QUESTS WHERE createdBy = $id";
		mysqli_query($link, $query)or die(mysqli_error($link));

		// Finally, delete the user.
		$query = "DELETE FROM USERS WHERE userID = $id";
		if (mysqli_query($link, $query)) {
    		echo "true";
		} else {
    		echo mysqli_error($link);
		}
	}
	echo mysqli_error($link);
	/*
	function deleteUser(){

	}
	function deleteQuiz(){

	}
	function deleteQuestion(){

	}
	function deleteAnswer(){

	} */
?>