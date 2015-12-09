<?php
	include "getBasicData.php";
	//ini_set('display_errors', 'On');
	//error_reporting(E_ALL);
	
	//echo dirname(__DIR__);
	if(isset($_REQUEST['userEmail'])) {
		$result = getBasicData(array("email"), "USERS", array("email"=>$_REQUEST['userEmail']));
		if(mysqli_num_rows($result) != 0) {
			echo "true";
		} else {
			echo "false";
		}
	}
?>
