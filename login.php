<?php include 'php/header.php'; ?>


<div class="container">
<?php
	/*Display error message if was not authenticated*/
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
			<h2>Please Sign In</h2>
			<hr class="colorgraph">
			<form role="form" method="post" action="index.php?log=in">
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


<?php include 'php/footer.php'; ?>

