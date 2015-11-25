<?php include 'header.php'; ?>
<script>
	function addQuestion(type){
		var ni = document.getElementById('optionList')
		
		// actual quiz options would nominally go here, should probs
		// split into classes or something for ease of addition.
		var newOpt = document.createElement('div');
		newOpt.setAttribute('id', type);
		newOpt.setAttribute('class', 'row');
		if(type == "text"){
			newOpt.innerHTML = 	'<div class="form-group">' +
							'<label for="question">Text question name:</label>' +
							'<input type="text" class="form-control" id="question">' +
						'</div>';

		} else if(type == "mult"){
			newOpt.innerHTML = 	'<div class="form-group">' +
							'<label for="question">Multiple choice question name:</label>' +
							'<input type="text" class="form-control" id="question">' +

							'<label for="question">Option (seperated by semicolons eg favourite colours: "red;blue;orange"):</label>' +
							'<input type="text" class="form-control" id="question">' +
						'</div>';

		} else if(type == "radio"){
			newOpt.innerHTML = 	'<div class="form-group">' +
							'<label for="question">Radio button question name:</label>' +
							'<input type="text" class="form-control" id="question">' +

							'<label for="question">Option (seperated by semicolons eg favourite colour: "red;blue;orange"):</label>' +
							'<input type="text" class="form-control" id="question">' +
						'</div>';

		}
		
		newOpt.innerHTML = newOpt.innerHTML + '<hr>';
		ni.appendChild(newOpt);
	}
</script>

<div class="container-fluid">
	<div class="jumbotron">
		<h1>Quiz creator</h1>
		<p>Placeholder for list of your own quizzes and ability to edit them.</p>
		
		<div class="container-fluid" id="optionList"></div>
	
		<div class="dropdown">
			<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
				Add new element
				<span class="caret"></span>
			</button>

			<ul class="dropdown-menu" role="menu">
				<li><a onClick="addQuestion('text')">Text field</a></li>
				<li><a onClick="addQuestion('mult')">Multiple choice</a></li>
				<li><a onClick="addQuestion('radio')">Radio button</a></li>
			</ul>
		</div>

		<button type="submit" class="btn btn-default">Create Quiz</button>

	</div>
</div>

<?php include 'footer.php'; ?>

