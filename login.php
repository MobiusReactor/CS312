<?php $title = "Login"; include 'php/header.php'; ?>


<div class="container">
<?php
	/*Display error message if user was not authenticated*/
	if(isset($_GET['error'])){
		if($_GET['error']=="incorrectAuth") {
			echo "<div class='alert alert-danger'>
				<strong>Error!</strong> Check your email/password.
			</div>";
		}
	}

?>
<div class="container" style="margin-top:30px">
	<div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><strong>Sign In</strong></h3>
			</div>
			<div class="panel-body">
			<hr class="colorgraph">
				<form role="form" method="post" action="mquiz.php?log=in">
					<div class="form-group">
						<label for="email">Email address:</label>
						<input type="email" class="form-control input-lg" id="email" name="email">
					</div>
					<div class="form-group">
						<label for="pwd">Password:</label>
						<input type="password" class="form-control input-lg" id="pwd" name="password">
					</div>
					<div class="checkbox">
						<label><input type="checkbox" name="rememberMe">Remember me</label>
					</div>
					<hr class="colorgraph">
					<button type="submit" class="btn btn-lg btn-success btn-block">Log In</button>
				</form>	
			</div>
		</div>
	</div>
</div>


<?php include 'php/footer.php'; ?>

