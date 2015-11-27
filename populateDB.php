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
	$conn = mysql_connect($_sname, $_uname, $_pword);
	mysql_select_db($_db) or die(mysql_error());

	
	echo "Connected to MySQL<br/>";
	echo "Connected to Database<br/>";
	
	$fKey = "SET FOREIGN_KEY_CHECKS=0";
	mysql_query($fKey) or die(mysql_error());
	
	// Need to kill tables first to avoid conflicts
	$killUsers = "DROP TABLE IF EXISTS USERS";
	mysql_query($killUsers) or die(mysql_error());
	echo "User table dropped<br/>";

	$killQuests = "DROP TABLE IF EXISTS QUESTS";
	mysql_query($killQuests) or die(mysql_error());
	echo "User table dropped<br/>";
	
	$killQuestions = "DROP TABLE IF EXISTS QUESTIONS";
	mysql_query($killQuestions) or die(mysql_error());
	echo "User table dropped<br/>";
	
	$fKey = "SET FOREIGN_KEY_CHECKS=1";
	mysql_query($fKey) or die(mysql_error());


	
	//create table for USERS
	$createUsers = "CREATE TABLE USERS(
				userID INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY(userID),
				email VARCHAR(30) NOT NULL,
				password VARCHAR(30) NOT NULL,
				dateOfBirth DATETIME			
			)";
	mysql_query($createUsers) or die(mysql_error());
	echo "Table for users created!<br/>";

	//create table for QUESTIONNAIRES
	$createQuests = "CREATE TABLE QUESTS(
				questID INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY(questID),
				questName VARCHAR(30) NOT NULL,
				createdBy INT,				
				FOREIGN KEY(createdBy) REFERENCES USERS(userID)
			)";
	mysql_query($createQuests) or die(mysql_error());
	echo "Table for Questionnaires created!<br/>";

	//create table for QUESTIONS
	$createQuestions = "CREATE TABLE QUESTIONS(
				questionID INT NOT NULL AUTO_INCREMENT,
				questionnaireID INT,
				questionType VARCHAR(100) NOT NULL,
				question VARCHAR(100) NOT NULL,
				options VARCHAR(100) NOT NULL,
				PRIMARY KEY(questionID),
				FOREIGN KEY(questionnaireID) REFERENCES QUESTS(questID)  
			)";
	mysql_query($createQuestions) or die(mysql_error());
	echo "Table for Questions created!<br/>";
?>
