<?php
	/**
	 * This piece of code is simply checking whether the provided
	 * email has been already taken, 
	 */
	include "dbfetcher.php";
	if(isset($_REQUEST['userEmail'])) {
		$result = getBasicData(array("email"), "USERS", array("email"=>$_REQUEST['userEmail']));
		if(mysqli_num_rows($result) != 0) {
			echo "true";
		} else {
			echo "false";
		}
	}
?>
