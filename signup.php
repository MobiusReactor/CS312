<?php include 'php/header.php'; ?>


<div class="container">
<?php

	if(isset($_GET['error'])) {
		switch($_GET['error']) {
			case "missing":
				echo "<div class='alert alert-danger'>
					<strong>Error!</strong> One or more fields missing data.
				</div>";
				break;

			case "email":
				echo "<div class='alert alert-danger'>
					<strong>Error!</strong> Invalid email.
				</div>";
				break;
			case "taken":
				echo "<div class='alert alert-danger'>
					<strong>Error!</strong> Email is already taken, choose another one.
				</div>";
				break;
			case "pwds":
				echo "<div class='alert alert-danger'>
					<strong>Error!</strong> Passwords do not match.
				</div>";
				break;	
			default:
		}
	}

?>
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
			<div class="form-group" id="pwdcDiv">
				<label for="pwdc">Date of Birth:</label>
				<input type="text" id="datepicker" name="dateOfBirth">
				<span id="pwdcStatus"></span>
			</div>
			<button type="submit" class="btn btn-default">Submit Registration</button>
		</form>	
	</div>
</div>

<script>
$(function(){

$('#datepicker').datepicker({
    
	defaultDate: '01/01/1977',
	startDate: '01/01/1900',
	endDate: '01/01/2010', 
	autoclose: true,

});

});
</script>

<?php include 'php/footer.php'; ?>

