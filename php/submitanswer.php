<?php
	
	$_uname = "isb13142";
	$_pword = "eiXaim9ee8mi";
	$link = mysqli_connect("devweb2015.cis.strath.ac.uk", $_uname, $_pword);
	mysqli_select_db($link, $_uname) or die(mysql_error());
	
	$qArray = json_decode(str_replace('\\', '', $_POST['answers']));

	$quizTitle = "";
	$authorEmail = "";
	foreach($qArray as $q){
		$type = $q[0];
		$data = $q[1];
		if($type == "author"){
			$quizResponder = $data;
		} else if($type == "quizID"){
			$quizID = $data;
		}
	}
	
	$queryi = "SELECT userID FROM USERS WHERE email = '$quizResponder'"; 
	$uID = mysqli_query($link, $queryi) or die(mysqli_error($link));
	$uID = mysqli_fetch_array($uID);


	foreach($qArray as $q){
		$type = $q[0];
		if($type == "quizID" || $type == "author"){
			continue;
		}
		$qID = $q[1];
		$data = $q[2];
		
		$query = sprintf("INSERT INTO ANSWERS (answeredBy, questionID, answer) VALUES(%u, %u, '%s') ",
			(integer) $uID['userID'],
			(integer) $qID,
			mysqli_real_escape_string($link, $data)	
		) or die(mysql_error());
		mysqli_query($link, $query) or die(mysqli_error($link));
		
	}
	
	//mysqli_query($link, $query) or die(mysql_error()); 
	
	$qID = mysqli_insert_id($link) or die(mysqli_error($link));
	

?>
