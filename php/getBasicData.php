<?php

function getBasicData($select, $from, $where = NULL){
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
	$result = mysqli_query($conn, $sqlSelect) or die(mysqli_error($conn));
	return $result;
};

?>
