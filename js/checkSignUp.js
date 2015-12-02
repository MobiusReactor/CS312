			var errorStr;
			function doAjax(email) {
				$.ajax(
					{
						type : 'POST',
						url : 'php/checkUser.php',
						data: { userEmail : email },
						success: function(response){
							if(response == "true") {
								errorStr = "Email is reserved!";
							} else {
								errorStr = "";
							}
						},
						async: false
					});
				return errorStr;
			}

			function validateEmail() {
				var isErrorEmail = false;				
				var re = /\S+@\S+\.\S+/;
				var container = document.getElementById("emailDiv");		
				var email = document.getElementById("email").value;

				if(!re.test(email)) {
					errorStr = "Invalid email!"
				} else {
					errorStr = doAjax(email);
				}

				var icon = document.getElementById("emailStatus");
				var errorMsg = document.getElementById("emailErr");

				if(errorStr.length != 0) {
					if(errorMsg == undefined) {
						errorMsg = document.createElement("div");
						errorMsg.setAttribute("id", "emailErr");
						
						setError(container, errorMsg, icon);
						container.appendChild(errorMsg);
					} else {
						setError(container, errorMsg, icon);
					}					
				} else {
					setSuccess(container, errorMsg, icon);
				}
			}
			
			function validatePwd() {
				var regexp = new RegExp("^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=\S+$).{8,}$");
				var pwd = document.getElementById("pwd").value;
				var icon = document.getElementById("pwdStatus");
				var warningMsg = document.getElementById("pwdErr");
				var container = document.getElementById("pwdDiv");
				if(!regexp.test(pwd)) {
					errorStr = "Password is weak. It should contain at least one digit, both upper and lowercase letters";
					if(warningMsg == undefined) {
						warningMsg = document.createElement("div");
						warningMsg.setAttribute("id", "pwdErr");
						setWarning(container, warningMsg, icon);
						container.appendChild(warningMsg);	
					} else {
						setWarning(container, warningMsg, icon);
					}
				}
			}

			function validatePwdc() {
				var Pwd = document.getElementById("pwd").value;
				var Pwdc = document.getElementById("pwdc").value;
				var icon = document.getElementById("pwdcStatus");
				var errorMsg = document.getElementById("pwdcErr");
				var container = document.getElementById("pwdcDiv");
				if(Pwd != Pwdc) {
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
					setSuccess(container, document.getElementById("pwdcErr"), icon);
				}
			}


			function setError(container, errorMsg, icon) {
				container.setAttribute("class", "form-group has-error has-feedback");
				errorMsg.setAttribute("class", "alert alert-danger");
				errorMsg.innerHTML = "<strong>Error!</strong>" + errorStr;
				icon.setAttribute("class", "glyphicon glyphicon-remove form-control-feedback");				
			}

			function setWarning(container, errorMsg, icon) {
				container.setAttribute("class", "form-group has-warning has-feedback");
				errorMsg.setAttribute("class", "alert alert-warning");
				errorMsg.innerHTML = "<strong>Warning!</strong>" + errorStr;
				icon.setAttribute("class", "glyphicon glyphicon-warning-sign form-control-feedback");
			}

			function setSuccess(container, errorMsg, icon) {
					container.setAttribute("class", "form-group has-success has-feedback");
					icon.setAttribute("class", "glyphicon glyphicon-ok form-control-feedback");
					container.removeChild(errorMsg);
			}
