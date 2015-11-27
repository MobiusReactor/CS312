<?php

function getBasicData($select, $from, $where = NULL){
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
	
	
	$sqlSelect = "SELECT ";

	foreach($select as $value){
		$sqlSelect .= $value.",";
	}
	
	$sqlSelect = rtrim($sqlSelect, ",");
	$sqlSelect .= " FROM ".$from;
	if($where != NULL){
		$sqlSelect .= " WHERE ";
		foreach($where as $key => $value){
			$sqlSelect .= ($key." = '".$value."' AND ");
		}
		$sqlSelect = substr($sqlSelect, 0, -4);
	}
	//echo "<strong>".$sqlSelect."</strong>";
	$result = mysql_query($sqlSelect) or die(mysql_error());
	return $result;
};

?>
