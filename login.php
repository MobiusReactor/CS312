<?php include 'header.php'; ?>


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
	<div class="jumbotron">
		<h1>Log in here!</h1>
		<form role="form" method="post" action="index.php?log=in">
			<div class="form-group">
				<label for="email">Email address:</label>
				<input type="email" class="form-control" id="email" name="email">
			</div>
			<div class="form-group">
				<label for="pwd">Password:</label>
				<input type="password" class="form-control" id="pwd" name="password">
			</div>
			<div class="checkbox">
				<label><input type="checkbox" name="rememberMe">Remember me</label>
			</div>
			<button type="submit" class="btn btn-default">Log In</button>
		</form>	
	</div>
</div>

<?php include 'footer.php'; ?>

