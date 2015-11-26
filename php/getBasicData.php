<?php

function getBasicData($select, $from, $where = NULL){
	//Connect to our DB
	$_sname = "devweb2015.cis.strath.ac.uk";
	$_uname = "isb13142";
	$_pword = "eiXaim9ee8mi";
	//$servername = "localhost";
	//$username = "root";
	//$password = "12345";
	//$database = "SoEDB";
	mysql_connect($servername, $username, $password);
	mysql_select_db("SoEDB") or die(mysql_error());
	
	
	$sqlSelect = "SELECT ";

	foreach($select as $value){
		$sqlSelect .= $value.",";
	}
	
	$sqlSelect = rtrim($sqlSelect, ",");
	$sqlSelect .= " FROM ".$from;
	if($where != Null){
		$sqlSelect .= " WHERE ";
		foreach($where as $key => $value){
			$sqlSelect .= ($key." = '".$value."' AND ");
		}
		$sqlSelect = substr($sqlSelect, 0, -4);
	}
	//echo "<strong>".$sqlSelect."</strong>";
	$result = mysql_query($sqlSelect) or die(mysql_error());;
	return $result;
};

?>
