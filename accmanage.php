<?php $title = "Account Settings"; include 'php/header.php'; ?>

<div class="container">
<?php

	if(isset($_GET['error'])) {
		switch($_GET['error']) {
			case "missing":
				echo "<div class='alert alert-danger'>
					<strong>Error!</strong> One or more fields missing data.
				</div>";
				break;
			case "pwds":
				echo "<div class='alert alert-danger'>
					<strong>Error!</strong> Passwords do not match.
				</div>";
				break;	
			case "oldpwd":
				echo "<div class='alert alert-danger'>
					<strong>Error!</strong> Old password incorrect.
				</div>";
				break;	
			default:
		}
	}

?>
	<div class="jumbotron">
		<h1>Account Settings</h1>
		<h2>Change Password:</h2>
		
		<script src="js/checkSignUp.js"></script>
		
		<form role="form" method="post" action="changepass.php">
			<div class="form-group" id="pwdDiv">
				<label for="pwd">Choose a new password:</label>
				<input name="reg_pword" type="password" class="form-control" id="pwd" onblur="validatePwd()">
				<span id="pwdStatus"></span>
			</div>
			<div class="form-group" id="pwdcDiv">
				<label for="pwdc">Confirm your new password:</label>
				<input name="reg_pwordc" type="password" class="form-control" id="pwdc" onblur="validatePwdc()">
				<span id="pwdcStatus"></span>
			</div>
			<div class="form-group" id="oldpwdDiv">
				<label for="oldpwd">For security, confirm your old password:</label>
				<input name="reg_oldpword" type="password" class="form-control" id="oldpwd"">
			</div>

			<button type="submit" class="btn btn-default">Change Password</button>
		</form>
	</div>
</div>

<?php include 'php/footer.php'; ?>
