<?php
	include "getBasicData.php";
	$_sname = "devweb2015.cis.strath.ac.uk";
	$_uname = "isb13142";
	$_pword = "eiXaim9ee8mi";
	$_db = "isb13142";

	$link = mysqli_connect($_sname, $_uname, $_pword);
	mysqli_select_db($link, $_db) or die(mysql_error());

	if(isset($_REQUEST['userId'])){
		$id = $_REQUEST['userId'];

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
?>