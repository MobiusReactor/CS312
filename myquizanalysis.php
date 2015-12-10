<?php
	ini_set('display_errors', 'On');
	error_reporting(E_ALL);	
	$title = "Quiz Results";
	include 'php/header.php';
	$toPass = array();
?>
<script>
/**
 * The function below draws a chart by using already created canvas with id (index)
 * and data passed in array (jsonArr)
 */
function drawChart(index, jsonArr) {
	var data = JSON.parse(jsonArr);
	var labels = [];
	var values = [];
	/*reconstruct the data given in jsonArr*/
	for(var k in data) {
		labels.push(k);
		if (data.hasOwnProperty(k)) {
			values.push(data[k]);
		}
	}

	/*init data for Chart*/
	var dataFin = {
    		labels: labels,
   		datasets: [
		{
            		label: "DataSet",
            		fillColor: "rgba(226, 189, 54, 0.2)",
            		strokeColor: "rgba(226, 189, 54 ,1)",
            		pointColor: "rgba(226, 189, 54 ,1)",
            		pointStrokeColor: "#fff",
            		pointHighlightFill: "#fff",
            		pointHighlightStroke: "rgba(226, 189, 54, 1)",
            		data: values
        	}
    		]
	};
	
	/*Launch the chart*/
	var ctx = document.getElementById("myChart"+index).getContext("2d");
	var myLineChart = new Chart(ctx).Line(dataFin, { barShowStroke: false });
}
</script>

<div class="container">
	<div class="jumbotron">
		<div class="row">
      <?php

	if(isset($_GET['quizID'])) {
		/*with quizID, fetch all the questions from DB for that quiz*/
        	$result = getBasicData(
			array("questionID", "question", "options"),
			"QUESTIONS",
			array("questionnaireID" => $_GET['quizID']));
		if(mysqli_num_rows($result) > 0) {
			$i = 0;
			while($row = mysqli_fetch_array($result)){
				/*output questions*/
            			echo "<p>$row[1]</p>";
				$options = explode(";", $row[2]);
				$toPass = array();
				if(($row[2] != "") || ($row[2] != Null)) {
					/*if multiple choice or radio -> gather statistics of answers*/
					foreach($options as $value) {
						$occ = getBasicData(array("COUNT(*)"), "ANSWERS", array("answer"=>$value));
						$occ = mysqli_fetch_array($occ);
						$toPass[$value] = $occ[0];
					}

					/*encode statistics and create chart to display it*/
					$encoded = json_encode($toPass);
					echo '<canvas id="myChart'.$i.'" width="200" height="200"></canvas>';
					echo '<script>drawChart('.$i.', \''.$encoded.'\')</script>';
					$i++;
				} else {
					/*if simple text field -> no statistics*/
					echo "<h7>No statistics</h7>";
				}
          		}  
       	 	}
	}
      ?>




  </div> 
	</div>
</div>

<?php include 'php/footer.php'; ?>

