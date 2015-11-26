<?php

	//Connect to our DB
	/*$_sname = "devweb2015.cis.strath.ac.uk";
	$_uname = "isb13142";
	$_pword = "eiXaim9ee8mi";*/
	$_sname = "localhost";
	$_uname = "root";
	$_pword = "12345";
	$_db = "SoEDB";
	$conn = mysqli_connect($_sname, $_uname, $_pword);
	mysqli_select_db($conn, $_db) or die(mysqli_error());

	
	echo "Connected to MySQL<br/>";
	echo "Connected to Database<br/>";
	
	// Need to kill tables first to avoid conflicts
	$killUsers = "DROP TABLE USERS";
	mysqli_query($conn, $killUsers);
	

	$killQuests = "DROP TABLE QUESTS";
	mysqli_query($conn, $killQuests);
	
	$killQuestions = "DROP TABLE QUESTIONS";
	mysqli_query($conn, $killQuestions);
	



	
	//create table for USERS
	$createUsers = "CREATE TABLE USERS(
				userID INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY(userID),
				email VARCHAR(30) NOT NULL,
				password VARCHAR(30) NOT NULL,
				dateOfBirth DATETIME			
			)";
	mysqli_query($conn, $createUsers) or die(mysql_error());
	echo "Table for users created!<br/>";

	//create table for QUESTIONNAIRES
	$createQuests = "CREATE TABLE QUESTS(
				questID INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY(questID),
				questName VARCHAR(30) NOT NULL,
				createdBy INT,				
				FOREIGN KEY(createdBy) REFERENCES USERS(userID)
			)";
	mysqli_query($conn, $createQuests) or die(mysql_error());
	echo "Table for Questionnaires created!<br/>";

	//create table for QUESTIONS
	$createQuestions = "CREATE TABLE QUESTIONS(
				questionID INT NOT NULL AUTO_INCREMENT,
				questionnaireID INT,
				questionType VARCHAR(100) NOT NULL,
				question VARCHAR(100) NOT NULL,
				PRIMARY KEY(questionID),
				FOREIGN KEY(questionnaireID) REFERENCES QUESTS(questID)  
			)";
	mysqli_query($conn, $createQuestions) or die(mysql_error());
	echo "Table for Questions created!<br/>";
?>
