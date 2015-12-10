<?php $title = "Create Quiz"; include 'php/header.php'; ?>

<script>
	
	var qArray = new Array();

	/**
	* The structure for creating quizes is VERY complicated, so here I will try to explain it:
	*	1) When creating 'text' inputs, it is all straigthforward -> the form field is located, and that's it
	*	2) When radio or multiple choice buttons are created, it is more complex -> 
	*		A new modal is created, it is being attached to a field.
	*		Then user inputs values in modal, and these values are then saved in hidden field attached to form element
	*	3) The whole communcation is being carried out by using unique IDs such as option3, question5, modal9 etc...
	*
	*/

	/*The function which adds an option to a modal with specified index*/
	function addOption(index) {	
		var ni = document.getElementById('modalOptions'+index);
		var numberOfElements = ni.childNodes.length;
		var newOpt = document.createElement('div');
		newOpt.innerHTML = '<div class="form-group">' +
					'<label for="question">Option ' +(numberOfElements+1)+ '</label>' +
					'<div class="row">' +
						'<div class="col-md-11">' +
							'<input type="text" class="form-control optionAnswer'+index+'">' +
					'</div><div class="col-md-1">' +
					'<button type="button" class="btn btn-xs btn-danger pull-right" ' +
						'onclick="deleteOption('+index+','+numberOfElements+')">Delete</button></div></div>' +
					'</div>';
		ni.appendChild(newOpt);
	}

	/*The function which deletes specified option in specified modal*/
	function deleteOption(modalIndex, optionIndex) {
		var ni = document.getElementById('modalOptions'+modalIndex);
		ni.removeChild(ni.childNodes[optionIndex]);
	}

	/*The function which sends specified modal options to a hidden field of form with same index*/
	function sendOptions(index) {
		/*Get modal fields*/
		var answers = document.getElementsByClassName('optionAnswer'+index);
		var ni = document.getElementById("optionList");

		/*Get hidden field*/
		var hidden = ni.lastChild.firstChild.lastChild;

		/*Now let's loop through modal options*/
		var str = "";
		for(var i = 0; i < answers.length; i++) {
			str += answers[i].value + ";";
		}
		str = str.substring(0, str.length - 1);
		
		/*Send values to hidden*/
		hidden.setAttribute('value', str);
	}

	/*The function which deletes question at specified index*/
	function deleteEntry(entry) {
		var ni = document.getElementById('optionList');
		ni.removeChild(document.getElementById('question'+entry));
	}


	/*The function which finally submits all questions to script which saves them*/
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
					qArray.push([type, qName, ""]);
				}
			} else if(type == "text"){
				var qName = uSpec[0].value;
				if(qName == ""){
					valid = false;
					break;
				} else {
					qArray.push([type, qName, ""]);
				}
			} else if(type == "mult" || type == "radio"){
				var qName = uSpec[0].value;
				var qOpt = uSpec[1].value;
				
				if(qName == "" || qOpt == ""){
					valid = false;
					break;
				} else {
					qArray.push([type, qName, qOpt]);
				}
			}
			
		}
		
		
		if(valid){

			qArray.push(["author", author, []]);
			
			var sArray = JSON.stringify(qArray);
			
			$.ajax(
			{
				type:'POST',
				url:'php/submitquiz.php',
				data:{ questions:sArray },
				success: function(response){

				},
				async: false
			});

			window.location.href = "mquiz.php";
			
		} else {
			alert("One or more fields is not set, please ensure all fields selected have text.");
		}
		
		//header("refresh:0.1;url=quizcreator.php");
	}


	/*The function which adds new question*/
	function addQuestion(type){
		var ni = document.getElementById('optionList');
		var numberOfElements = ni.childNodes.length;
		// actual quiz options would nominally go here, should probs
		// split into classes or something for ease of addition.
		var newOpt = document.createElement('div');
		newOpt.setAttribute('name', 'question');
		newOpt.setAttribute('type', type);
		newOpt.setAttribute('class', 'row');
		newOpt.setAttribute('id', 'question'+numberOfElements);
		if(type == "text"){
			newOpt.innerHTML = 	'<div class="form-group">' +
							'<label for="question">Text question name:</label>' +
							'<div class="row">' +
							'<div class="col-md-11">' +
							'<input type="text" class="form-control" id="questionName">' +
							'</div><div class="col-md-1">' +
							'<button type="button" class="btn btn-xs btn-danger pull-right" onclick="deleteEntry('+numberOfElements+')">' + 
							'Delete</button></div></div>' +
						'</div>';

		} else if(type == "mult"){
			newOpt.innerHTML = 	'<div class="form-group">' +
							'<label for="question">Multiple choice question name:</label>' +
							'<div class="row">' +
								'<div class="col-md-11">' +
									'<input type="text" class="form-control" id="questionName">' +
								'</div><div class="col-md-1">' +
										'<button type="button" class="btn btn-xs btn-danger pull-right" onclick="deleteEntry('+numberOfElements+')">' + 
							'Delete</button></div></div>' +
							'<button type="button" class="btn btn-info btn-md" data-toggle="modal" ' + 
							'data-target="#enterMult'+numberOfElements+'">Configure Options</button>' +
							'<input type="hidden" class="form-control" id="questionOpts">' +
						'</div>' + 
			'<div class="modal fade" id="enterMult'+numberOfElements+'" role="dialog">' +
				'<div class="modal-dialog modal-lg">' +
					'<div class="modal-content">' +
						'<div class="modal-header">' +
							'<button type="button" class="close" data-dismiss="modal">&times;</button>' +
							'<h4 class="modal-title">Write options for your question</h4>' +	
						'</div>' +
						'<div class="modal-body">' +
						'<div class="row"><div class="container-fluid" id="modalOptions'+numberOfElements+'"></div></div>' +
						'<div class="row" id="options">' +
							'<button class="btn btn-primary" type="button" onclick="addOption('+numberOfElements+')">Add Option</button>' +
						'</div>' +
						'<div class="modal-footer">' +
							'<button type="button" class="btn btn-default" data-dismiss="modal" onclick="sendOptions('+numberOfElements+')">Submit</button>' +
						'</div>' +
					'</div>' +
				'</div>' +
			'</div>';

		} else if(type == "radio"){
			newOpt.innerHTML = 	'<div class="form-group">' +
							'<label for="question">Radio button question name:</label>' +
							'<div class="row">' +
							'<div class="col-md-11">' +
							'<input type="text" class="form-control" id="questionName">' +
							'</div><div class="col-md-1">' +
							'<button type="button" class="btn btn-xs btn-danger pull-right" onclick="deleteEntry('+numberOfElements+')">' + 
							'Delete</button></div></div>' +
							'<button type="button" class="btn btn-info btn-md" data-toggle="modal" ' + 
							'data-target="#enterMult'+numberOfElements+'">Configure Options</button>' +
							'<input type="hidden" class="form-control" id="questionOpts">' +
						'</div>' + 
			'<div class="modal fade" id="enterMult'+numberOfElements+'" role="dialog">' +
				'<div class="modal-dialog modal-lg">' +
					'<div class="modal-content">' +
						'<div class="modal-header">' +
							'<button type="button" class="close" data-dismiss="modal">&times;</button>' +
							'<h4 class="modal-title">Write options for your question</h4>' +	
						'</div>' +
						'<div class="modal-body">' +
						'<div class="row"><div class="container-fluid" id="modalOptions'+numberOfElements+'"></div></div>' +
						'<div class="row" id="options">' +
							'<button class="btn btn-primary" type="button" ' +
							'onclick="addOption(' + numberOfElements + ')">Add Option</button>' +
						'</div>' +
						'<div class="modal-footer">' +
							'<button type="button" class="btn btn-default" data-dismiss="modal" onclick="sendOptions('+numberOfElements+')">Submit</button>' +
						'</div>' +
					'</div>' +
				'</div>' +
			'</div>';

		}
		
		newOpt.innerHTML = newOpt.innerHTML + '<hr>';

		ni.appendChild(newOpt);
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

<?php include 'php/footer.php'; ?>
