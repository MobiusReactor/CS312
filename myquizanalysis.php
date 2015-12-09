<?php
	ini_set('display_errors', 'On');
	error_reporting(E_ALL);	
	include 'php/header.php';
?>


<div class="container">
	<div class="jumbotron">
		<div class="row quest">
    			<table class="table table-condensed">
     				 <thead>
        				<tr>
          					<th>Question</th>
          					<th>Options </th>
        				</tr>
      				</thead>
      <?php
        $result = getBasicData(
		array("questionID", "question", "options"),
		"QUESTIONS",
		array("questionnaireID" => $_GET['quizID']));
        if(mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_array($result)){
		$result2 = getBasicData(
			array("answeredBy", "answer"),
			"ANSWERS",
			array("questionID"=>$row[0]));
            echo "<tr>
                    <td>$row[1]</td>
                    <td><div class='dropdown'>
			<button class='btn btn-primary dropdown-toggle' type='button' data-toggle='dropdown'>
				$row[2]
			<span class='caret'></span></button>
				<ul class='dropdown-menu'>
				<li><a href='#'>HTML</a></li>
				<li><a href='#'>CSS</a></li>
				<li><a href='#'>JavaScript</a></li>
				</ul>
			</div>
		</td>";
                  

		echo "</tr>";"
		
          }  
        }
      ?>
    </table>
  </div> 
	</div>
</div>

<?php include 'php/footer.php'; ?>

