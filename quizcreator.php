<?php include 'header.php'; ?>

<script>
	
	var qArray = new Array();

	function addQuestion(type){
		var ni = document.getElementById('optionList');
		
		// actual quiz options would nominally go here, should probs
		// split into classes or something for ease of addition.
		var newOpt = document.createElement('div');
		newOpt.setAttribute('name', 'question');
		newOpt.setAttribute('type', type);
		newOpt.setAttribute('class', 'row');
		if(type == "text"){
			newOpt.innerHTML = 	'<div class="form-group">' +
							'<label for="question">Text question name:</label>' +
							'<input type="text" class="form-control" id="questionName">' +
						'</div>';

		} else if(type == "mult"){
			newOpt.innerHTML = 	'<div class="form-group">' +
							'<label for="question">Multiple choice question name:</label>' +
							'<input type="text" class="form-control" id="questionName">' +

							'<label for="question">Option (seperated by semicolons eg favourite colours: "red;blue;orange"):</label>' +
							'<input type="text" class="form-control" id="questionOpts">' +
						'</div>';

		} else if(type == "radio"){
			newOpt.innerHTML = 	'<div class="form-group">' +
							'<label for="question">Radio button question name:</label>' +
							'<input type="text" class="form-control" id="questionName">' +

							'<label for="question">Option (seperated by semicolons eg favourite colour: "red;blue;orange"):</label>' +
							'<input type="text" class="form-control" id="questionOpts">' +
						'</div>';

		}
		
		newOpt.innerHTML = newOpt.innerHTML + '<hr>';

		ni.appendChild(newOpt);
	}
	
	function validateEntry(author){
		var qList = document.getElementsByName('question');
		var valid = true;
		
		
		for(var i = 0; i < qList.length; i++){
			var cQuest = qList[i];
			var type = cQuest.getAttribute('type');
			var uSpec = cQuest.getElementsByTagName('input');
		
			
			if(type == "title"){
				var qName = uSpec[0].value;
				if(qName == ""){
					valid = false;
					break;
				} else {
					qArray.push([type, qName, []]);
				}
			} else if(type == "text"){
				var qName = uSpec[0].value;
				if(qName == ""){
					valid = false;
					break;
				} else {
					qArray.push([type, qName, []]);
				}
			} else if(type == "mult" || type == "radio"){
				var qName = uSpec[0];
				var qOpt = uSpec[1];
				if(qName == "" || qOpt == ""){
					valid = false;
					break;
				} else {
					qArray.push([type, qName, qOpt]);
				}
			}
			
			//alert(cQuest.getElementsByTagName('input')[0]);
		}
		
		
		if(valid){

			qArray.push(["author", author, []]);
			
			var sArray = JSON.stringify(qArray);
			
			$.ajax(
			{
				type:'POST',
				url:'submitquiz.php',
				data:{questions:sArray},
				success: function(data){
				}
			});

			window.location.href = "mquiz.php";
			
		} else {
			alert("One or more fields is not set, please ensure all fields selected have text.");
		}
		
		//header("refresh:0.1;url=quizcreator.php");
	}
</script>


<div class="container">
	<div class="jumbotron">
		<div class="row">
			<h1>Quiz creator</h1>
			<p>Placeholder for list of your own quizzes and ability to edit them.</p>
		</div>
		
		<div class="row" name="question" type="title">
			<div class="form-group">
				<label for="question">Questionnaire name:</label>
				<input type="text" class="form-control" id="quizName">
			</div>
		</div>
		
		

		<div class="row">
			<div class="container-fluid" id="optionList"></div>
		</div>
		
		<div class="row">
			<div class="dropdown">
				<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
					Add new element
					<span class="caret"></span>
				</button>
				
				</br>

				<ul class="dropdown-menu" role="menu">
					<li><a onClick="addQuestion('text')">Text field</a></li>
					<li><a onClick="addQuestion('mult')">Multiple choice</a></li>
					<li><a onClick="addQuestion('radio')">Radio button</a></li>
				</ul>
			</div>
			<?php
				echo '<button onclick="validateEntry(\'' . $_SESSION["email"] . '\')" type="submit" class="btn btn-default">Create Quiz</button>';
			?>
		</div>
		
		
	
	</div>
</div>

<?php include 'footer.php'; ?>
