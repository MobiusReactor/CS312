<?php
/**
 * This function helps to fetch data from database,
 * avoiding repetitive code. It requires 3 arguments:
 * 	$select -> array of columns to be selected e.g. array("FirstName", "SecondName") 
 *	$from -> string with name of table, e.g. "USERS"
 *	$where -> associative array with key representing column name, and values - their values. E. g.
 *		array("FirstName"=>"Johnny", "SecondName"=>"Bravo"). It can also be omitted, if not needed.
 */
function getBasicData($select, $from, $where = Null){
	/*Connect to our DB*/
	$_sname = "devweb2015.cis.strath.ac.uk";
	$_uname = "isb13142";
	$_pword = "eiXaim9ee8mi";
	$_db = "isb13142";
	//$_sname = "localhost";
	//$_uname = "root";
	//$_pword = "12345";
	//$_db = "SoEDB";
	$link = mysqli_connect($_sname, $_uname, $_pword);
	mysqli_select_db($link, $_db) or die(mysql_error());
	
	/*SELECT...*/
	$sqlSelect = "SELECT ";

	/*separate columns with commas*/
	foreach($select as $value){
		$sqlSelect .= $value.",";
	}	
	$sqlSelect = rtrim($sqlSelect, ",");

	/*... FROM ...*/
	$sqlSelect .= " FROM ".$from;
	
	if($where != Null){
		/*...WHERE...*/
		$sqlSelect .= " WHERE ";
		foreach($where as $key => $value){
			/*separate conditions with AND*/
			$sqlSelect .= ($key." = '".$value."' AND ");
		}
		$sqlSelect = substr($sqlSelect, 0, -4);
	}
	/*execute the query and return result*/
	$result = mysqli_query($link, $sqlSelect) or die(mysql_error());
	return $result;
};

?>
