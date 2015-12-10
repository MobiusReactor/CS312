<?php
	/**
	 * The script below saves the users answers from $_POST array to DB
	 */

	/*Connect to DB*/
	$_uname = "isb13142";
	$_pword = "eiXaim9ee8mi";
	$link = mysqli_connect("devweb2015.cis.strath.ac.uk", $_uname, $_pword);
	mysqli_select_db($link, $_uname) or die(mysqli_error($link));
	
	$qArray = json_decode(str_replace('\\', '', $_POST['answers']));

	/*Get the author of answer*/
	$quizTitle = "";
	$authorEmail = "";
	foreach($qArray as $q){
		$type = $q[0];
		$data = $q[1];
		if($type == "author"){
			$quizResponder = $data;
		}
	}
	
	/*Get id of author*/
	$queryi = "SELECT userID FROM USERS WHERE email = '$quizResponder'"; 
	$uID = mysqli_query($link, $queryi) or die(mysqli_error($link));
	$uID = mysqli_fetch_array($uID);

	/*Save the answers*/
	foreach($qArray as $q){
		$type = $q[0];

		if($type == "author"){
			continue;
		}
		/*questionID*/
		$qID = $q[1];
		/*answer*/
		$data = $q[2];
		
		$query = sprintf("INSERT INTO ANSWERS (answeredBy, questionID, answer) VALUES(%u, %u, '%s') ",
			(integer) $uID['userID'],
			(integer) $qID,
			mysqli_real_escape_string($link, $data)	
		) or die(mysqli_error($link));
		mysqli_query($link, $query) or die(mysqli_error($link));
		
	}
	
	$qID = mysqli_insert_id($link) or die(mysqli_error($link));
	

?>
