<?php

	//Connect to our DB
	$_sname = "devweb2015.cis.strath.ac.uk";
	$_uname = "isb13142";
	$_pword = "eiXaim9ee8mi";
	$_db = "isb13142";
	/*
	$_sname = "localhost";
	$_uname = "root";
	$_pword = "12345";
	$_db = "SoEDB";
	*/
	$conn = mysqli_connect($_sname, $_uname, $_pword);
	mysqli_select_db($conn, $_db) or die(mysql_error());

	
	echo "Connected to MySQL<br/>";
	echo "Connected to Database<br/>";
	
	$fKey = "SET FOREIGN_KEY_CHECKS=0";
	mysqli_query($conn, $fKey) or die(mysql_error());
	
	// Need to kill tables first to avoid conflicts
	$killUsers = "DROP TABLE IF EXISTS USERS";
	mysqli_query($conn, $killUsers) or die(mysql_error());
	echo "User table dropped<br/>";

	$killQuests = "DROP TABLE IF EXISTS QUESTS";
	mysqli_query($conn, $killQuests) or die(mysql_error());
	echo "User table dropped<br/>";
	
	$killQuestions = "DROP TABLE IF EXISTS QUESTIONS";
	mysqli_query($conn, $killQuestions) or die(mysql_error());
	echo "User table dropped<br/>";

	$killQuestions = "DROP TABLE IF EXISTS ANSWERS";
	mysqli_query($conn, $killQuestions) or die(mysql_error());
	echo "User table dropped<br/>";
	
	$fKey = "SET FOREIGN_KEY_CHECKS=1";
	mysqli_query($conn, $fKey) or die(mysql_error());


	
	//create table for USERS
	$createUsers = "CREATE TABLE USERS(
				userID INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY(userID),
				email VARCHAR(30) NOT NULL,
				password VARCHAR(60) NOT NULL,
				dateOfBirth DATETIME,
				isAdmin BOOLEAN DEFAULT FALSE		
			)";
	mysqli_query($conn, $createUsers) or die(mysql_error());
	echo "Table for users created!<br/>";

	//create table for QUESTIONNAIRES
	$createQuests = "CREATE TABLE QUESTS(
				questID INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY(questID),
				questName VARCHAR(30) NOT NULL,
				createdBy INT NOT NULL,				
				FOREIGN KEY(createdBy) REFERENCES USERS(userID)
			)";
	mysqli_query($conn, $createQuests) or die(mysql_error());
	echo "Table for Questionnaires created!<br/>";

	//create table for QUESTIONS
	$createQuestions = "CREATE TABLE QUESTIONS(
				questionID INT NOT NULL AUTO_INCREMENT,
				questionnaireID INT NOT NULL,
				questionType VARCHAR(100) NOT NULL,
				question VARCHAR(100) NOT NULL,
				options VARCHAR(100) NOT NULL,
				PRIMARY KEY(questionID),
				FOREIGN KEY(questionnaireID) REFERENCES QUESTS(questID)  
			)";

	//create table for ANSWERS
	$createAnswers = "CREATE TABLE ANSWERS(
				answerID INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY(answerID),
				answeredBy INT NOT NULL,
				questionID INT NOT NULL,
				answer VARCHAR(100) NOT NULL,
				FOREIGN KEY(questionID) REFERENCES QUESTIONS(questionID),
				FOREIGN KEY(answeredBy) REFERENCES USERS(userID)
	)";
	mysqli_query($conn, $createQuestions) or die(mysqli_error($conn));
	echo "Table for Questions created!<br/>";
	mysqli_query($conn, $createAnswers) or die(mysqli_error($conn));
	echo "Table for Answers created!<br/>";


	$pass = password_hash("12345", PASSWORD_BCRYPT);

	$createAdmin = "INSERT INTO USERS (email, password, isAdmin)
		VALUES ('aaa@aaa.aaa', '".$pass."', TRUE);";
	mysqli_query($conn, $createAdmin) or die(mysqli_error($conn));
	echo "Admin created!<br/>";	

	
?>
