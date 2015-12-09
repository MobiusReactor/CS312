<?php
	/* Returns the link to the connection */
 	function connect(){
 		$_sname = "devweb2015.cis.strath.ac.uk";
		$_uname = "isb13142";
		$_pword = "eiXaim9ee8mi";
		$_db = "isb13142";
		$link = mysqli_connect($_sname, $_uname, $_pword);
 		mysqli_select_db($link, $_db) or die(mysql_error());

 		return $link;
 	}
?>