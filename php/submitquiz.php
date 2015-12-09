<?php
	
	$_uname = "isb13142";
	$_pword = "eiXaim9ee8mi";
	$link = mysqli_connect("devweb2015.cis.strath.ac.uk", $_uname, $_pword);
	mysqli_select_db($link, $_uname) or die(mysqli_error($link));
	
	$qArray = json_decode(str_replace('\\', '', $_POST['questions']));

	$quizTitle = "";
	$authorEmail = "";
	foreach($qArray as $q){
		$type = $q[0];
		$data = $q[1];
		$options = $q[2];
		if($type == "title"){
			$quizTitle = $data;
		} else if($type == "author"){
			$authorEmail = $data;
		}
	}
	
	$queryi = "SELECT userID FROM USERS WHERE email = '$authorEmail'"; 
	
	$uID = mysqli_query($link, $queryi) or die(mysqli_error($link));
	$uID = mysqli_fetch_array($uID);
	$query = sprintf("INSERT INTO QUESTS (questName, createdBy) VALUES('%s', %u) ",
		mysqli_real_escape_string($link, $quizTitle),
		$uID['userID']
	) or die(mysql_error());
	
	mysqli_query($link, $query) or die(mysqli_error($link)); 
	
	$qID = mysqli_insert_id($link) or die(mysqli_error($link));
	
	foreach($qArray as $q){
		$type = $q[0];
		if($type == "title" || $type == "author"){
			continue;
		}
		$data = $q[1];
		$options = $q[2];
		
		$query = sprintf("INSERT INTO QUESTIONS (questionnaireID, questionType, question, options) VALUES(%u, '%s', '%s', '%s') ",
			$qID,
			mysqli_real_escape_string($link, $type),
			mysqli_real_escape_string($link, $data),
			mysqli_real_escape_string($link, $options)
		) or die(mysql_error());
		
		mysqli_query($link, $query) or die(mysqli_error($link));
	}
	
?>
