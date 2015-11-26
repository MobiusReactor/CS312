<?php

	mysql_connect("devweb2015.cis.strath.ac.uk", "isb13142", "eiXaim9ee8mi"); //replace function arguments
	echo "Connected to MySQL<br/>";
	mysql_select_db("isb13142") or die(mysql_error());
	echo "Connected to Database<br/>";
	
	// Need to kill tables first to avoid conflicts
	$killUsers = "DROP TABLE USERS";
	mysql_query($killUsers);

	$killQuests = "DROP TABLE QUESTS";
	mysql_query($killQuests);
	
	$killQuestions = "DROP TABLE QUESTIONS";
	mysql_query($killQuestions);
	



	
	//create table for USERS
	$createUsers = "CREATE TABLE USERS(
				userID INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY(userID),
				email VARCHAR(30) NOT NULL UNIQUE,
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
				PRIMARY KEY(questionID),
				FOREIGN KEY(questionnaireID) REFERENCES QUESTS(questID)  
			)";
	mysql_query($createQuestions) or die(mysql_error());
	echo "Table for Questions created!<br/>";
?>
