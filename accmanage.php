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

<div class="container" style="margin-top:30px">
	<div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><strong>Change Password</strong></h3>
			</div>
			<div class="panel-body">
			<hr class="colorgraph">
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
					<hr class="colorgraph">
					<button type="submit" class="btn btn-lg btn-success btn-block">Change Password</button>
				</form>
			</div>
		</div>
	</div>
</div>

<script src="js/checkSignUp.js"></script>

<?php include 'php/footer.php'; ?>
