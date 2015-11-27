<?php include 'header.php'; ?>


<div class="container">
	<div class="jumbotron">
		<h1>All Quizzes!</h1>
		<p>Placeholder for list of all quizzes you can fill out when logged in.</p>
		
		<?php
			
			$_uname = "isb13142";
			$_pword = "eiXaim9ee8mi";
			mysql_connect("devweb2015.cis.strath.ac.uk", $_uname, $_pword);
			mysql_select_db($_uname) or die(mysql_error());


			$query = "SELECT * FROM QUESTS"; 

			$result = mysql_query($query) or die(mysql_error());
				
			echo "<h2>LIST OF QUESTIONAIRES:</h2>";

			echo "<ul>";

			while($row = mysql_fetch_array($result)){
				echo "<li>" . $row["questName"] . "</li>";
			}

			echo "</ul>";

		?>
	</div>
</div>

<?php include 'footer.php'; ?>

