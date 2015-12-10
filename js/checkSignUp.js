/*The actual string which is Error Message*/			
var errorStr;

/*The function which request server to check whether the email is already taken or not*/
function doAjax(email) {
	$.ajax(
	{
		type : 'POST',
		url : './php/checkUser.php',
		data: { userEmail : email },
		success: function(response){
			if(response == "true") {
				/*Email already taken -> write message to errorStr*/
				
				errorStr = "Email is reserved!";


				/*errorStr was produced -> display it*/
			} else {
				/*Otherwise -> clear errorStr*/
				errorStr = "";
			}
		},
		async: false
	});
	return errorStr;
}

function validateEmail() {
	/*Store all needed objects (form-group, glyphicon, value of input etc.) in variables*/	
	var isErrorEmail = false;				
	var regexp = /\S+@\S+\.\S+/;
	var container = document.getElementById("emailDiv");		
	var email = document.getElementById("email").value;
	var icon = document.getElementById("emailStatus");
	var errorMsg = document.getElementById("emailErr");

	if(email.length == 0){
		/*email input clean -> clear message and quit the function*/
		clearMsg(container, errorMsg, icon);
		return;
	} else if(!regexp.test(email)) {
		/*email is not valid -> make proper errorStr*/
		errorStr = "Invalid email!"
	} else {
		/*otherwise -> check if email is reserved*/
		errorStr = doAjax(email);
	}

	if(errorStr.length != 0) {
		/*errorStr was produced -> display it*/
		if(errorMsg == undefined) {
			errorMsg = document.createElement("div");
			errorMsg.setAttribute("id", "emailErr");
			setError(container, errorMsg, icon);
			container.appendChild(errorMsg);
		} else {
			setError(container, errorMsg, icon);
		}					
	} else {
		/*otherwise -> all good, clear and show approval*/
		setSuccess(container, errorMsg, icon);
	}
}

/*Check the strength of password, if password is weak -> display a warning message*/			
function validatePwd() {
	/*Store all needed objects (form-group, glyphicon, value of input etc.) in variables*/
	var regexp = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})");
	var pwd = document.getElementById("pwd").value;
	var icon = document.getElementById("pwdStatus");
	var warningMsg = document.getElementById("pwdErr");
	var container = document.getElementById("pwdDiv");
	if(pwd.length == 0) {
		/*password input is clean -> clear form-group*/
		clearMsg(container, warningMsg, icon);
	} else if(!regexp.test(pwd)) {
		/*password is weak -> display warning*/
		errorStr = "Password is weak. It should contain at least one digit, both upper and lowercase letters and at least 8 chars";
		if(warningMsg == undefined) {
			warningMsg = document.createElement("div");
			warningMsg.setAttribute("id", "pwdErr");
			setWarning(container, warningMsg, icon);
			container.appendChild(warningMsg);	
		} else {
			setWarning(container, warningMsg, icon);
		}
	} else {
		/*all good -> clear warning and show approval*/
		setSuccess(container, warningMsg, icon);
	}
}

/*Function which compares password with password confirmation*/
function validatePwdc() {
	/*Store all needed objects (form-group, glyphicon, value of input etc.) in variables*/
	var Pwd = document.getElementById("pwd").value;
	var Pwdc = document.getElementById("pwdc").value;
	var icon = document.getElementById("pwdcStatus");
	var errorMsg = document.getElementById("pwdcErr");
	var container = document.getElementById("pwdcDiv");

	if(Pwdc.length == 0) {
		/*password confirmation input is clean -> clear the form-group*/
		clearMsg(container, errorMsg, icon);
	} else if(Pwd != Pwdc) {
		/*passwords don't match -> display warning*/
		errorStr = "Passwords do not match!";
		if(errorMsg == undefined) {
			errorMsg = document.createElement("div");
			errorMsg.setAttribute("id", "pwdcErr");						
			setError(container, errorMsg, icon);
			container.appendChild(errorMsg);
		} else {
			setError(container, errorMsg, icon);
		}
	} else {
		/*all good -> clear warning and display approval*/
		setSuccess(container, errorMsg, icon);
	}
}
/**
* All the helper functions below actually modify the error/warning message. They require 3 arguments:
*	1) container -> the div object which actually holds the input ("form-group")
*	2) errorMsg -> the object which holds the errorStr in that container
*	3) icon -> the span object which shows signs of warning or success
*/

/*Function which clears the error/warning message*/
function clearMsg(container, errorMsg, icon) {
	container.setAttribute("class", "form-group");
	container.removeChild(errorMsg);
	icon.setAttribute("class", "");
}

/*Function which sets the error message*/
function setError(container, errorMsg, icon) {
	container.setAttribute("class", "form-group has-error has-feedback");
	errorMsg.setAttribute("class", "alert alert-danger");
	errorMsg.innerHTML = "<strong>Error!</strong> " + errorStr;
	icon.setAttribute("class", "glyphicon glyphicon-remove form-control-feedback");				
}

/*Function which sets the warning message*/
function setWarning(container, errorMsg, icon) {
	container.setAttribute("class", "form-group has-warning has-feedback");
	errorMsg.setAttribute("class", "alert alert-warning");
	errorMsg.innerHTML = "<strong>Warning!</strong> " + errorStr;
	icon.setAttribute("class", "glyphicon glyphicon-warning-sign form-control-feedback");
}

/*Function which sets success message*/
function setSuccess(container, errorMsg, icon) {
		container.setAttribute("class", "form-group has-success has-feedback");
		icon.setAttribute("class", "glyphicon glyphicon-ok form-control-feedback");
		container.removeChild(errorMsg);
}
