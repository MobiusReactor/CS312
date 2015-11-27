<?php
	
	$_uname = "isb13142";
	$_pword = "eiXaim9ee8mi";
	mysql_connect("devweb2015.cis.strath.ac.uk", $_uname, $_pword);
	mysql_select_db($_uname) or die(mysql_error());
	
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
	
	$queryi = "SELECT userID FROM USERS WHERE email ='" . $authorEmail . "';"; 

	$uID = (integer)(mysql_query($queryi) or die(mysql_error()));

	$query = sprintf("INSERT INTO QUESTS (questName, createdBy) VALUES('%s', %u) ",
		mysql_real_escape_string($quizTitle),
		$uID
	) or die(mysql_error());
	
	mysql_query($query) or die(mysql_error()); 
	
	foreach($qArray as $q){
		$type = $q[0];
		$data = $q[1];
		$options = $q[2];
		if($type == "text"){
			
		} else if($type == "mult" || $type == "radio"){
			
		}
	}
	
?>