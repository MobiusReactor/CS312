<?php $title = "Login"; include 'php/header.php'; ?>

<div class="container">
<?php
	/*Display error message if user was not authenticated*/
	if(isset($_GET['msg'])){
		switch($_GET['msg']) {
			case "incorrectAuth":
				echo	"<div class='alert alert-danger'>
							<strong>Error!</strong> Check your email/password.
						</div>";
					break;
					
			case "invalidToken":
				echo 	"<div class='alert alert-danger'>
							<strong>Error!</strong> Password reset token not valid.
						</div>";
					break;
					
			case "emailSent":
				echo 	"<div class='alert alert-info'>
							A password reset link has been sent to your email address.
						</div>";
					break;
					
			case "emailNotSent":
				echo 	"<div class='alert alert-danger'>
							<strong>Error!</strong> Unable to send password reset email.
						</div>";
					break;
					
			case "invalidUser":
				echo 	"<div class='alert alert-danger'>
							<strong>Error!</strong> That email address does not belong to a registered user.
						</div>";
					break;
					
			case "noEmail":
				echo 	"<div class='alert alert-warning'>
							Enter your email address to reset your password.
						</div>";
					break;
					
			case "success":
				echo 	"<div class='alert alert-success'>
							Your password has been changed!
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
				<?php 
					if (isset($_GET['reset'])) {
						echo '<h3 class="panel-title"><strong>Reset Password</strong></h3>';
					} else {
						echo '<h3 class="panel-title"><strong>Sign In</strong></h3>';
					}
			 	?>
			</div>
			<div class="panel-body">
			<hr class="colorgraph">
				<form role="form" method="post" action="mquiz.php?log=in">
					<div class="form-group">
						<label for="email">Email address:</label>
						<input type="email" class="form-control input-lg" id="email" name="email">
					</div>
					<?php if (!isset($_GET['reset'])) : ?>
					<div class="form-group">
						<label for="pwd">Password:</label>
						<input type="password" class="form-control input-lg" id="pwd" name="password">
					</div>
					<div class="checkbox">
						<label><input type="checkbox" name="rememberMe">Remember me</label>
					</div>
					<hr class="colorgraph">
					<button type="submit" name="login" class="btn btn-lg btn-success btn-block">Log in</button>
					<?php else : ?>
					<hr class="colorgraph">
					<?php endif ?>
					<button type="submit" name="resetpass" class="btn btn-lg btn-success btn-block">I forgot my password</button>
				</form>	
			</div>
		</div>
	</div>
</div>


<?php include 'php/footer.php'; ?>

