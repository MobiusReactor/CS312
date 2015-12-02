<?php include 'php/header.php'; ?>


<div class="container">
	<div class="jumbotron">
		<h1>Sign up here!</h1>
		<script src="js/checkSignUp.js">

			
		</script>
		<form role="form" method="post" action="submitreg.php">
			<div class="form-group" id="emailDiv">
				<label for="email">Email address:</label>
				<input name="reg_email" type="email" class="form-control" id="email" onblur="validateEmail()">
				<span id="emailStatus"></span>
			</div>
			<div class="form-group" id="pwdDiv">
				<label for="pwd">Choose a password:</label>
				<input name="reg_pword" type="password" class="form-control" id="pwd" onblur="validatePwd()">
				<span id="pwdStatus"></span>
			</div>
			<div class="form-group" id="pwdcDiv">
				<label for="pwdc">Confirm your password:</label>
				<input name="reg_pwordc" type="password" class="form-control" id="pwdc" onblur="validatePwdc()">
				<span id="pwdcStatus"></span>
			</div>
			<button type="submit" class="btn btn-default">Submit Registration</button>
		</form>	
	</div>
</div>

<?php include 'php/footer.php'; ?>

