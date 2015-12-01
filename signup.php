<?php include 'php/header.php'; ?>


<div class="container">
	<div class="jumbotron">
		<h1>Sign up here!</h1>
		<form role="form" method="post" action="submitreg.php">
			<div class="form-group">
				<label for="email">Email address:</label>
				<input name="reg_email" type="email" class="form-control" id="email">
			</div>
			<div class="form-group">
				<label for="pwd">Choose a password:</label>
				<input name="reg_pword" type="password" class="form-control" id="pwd">
			</div>
			<div class="form-group">
				<label for="pwdc">Confirm your password:</label>
				<input name="reg_pwordc" type="password" class="form-control" id="pwdc">
			</div>
			<button type="submit" class="btn btn-default">Submit Registration</button>
		</form>	
	</div>
</div>

<?php include 'php/footer.php'; ?>

