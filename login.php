<?php include 'header.php'; ?>


<div class="container">
	<div class="jumbotron">
		<h1>Log in here!</h1>
		<form role="form">
			<div class="form-group">
				<label for="email">Email address:</label>
				<input type="email" class="form-control" id="email">
			</div>
			<div class="form-group">
				<label for="pwd">Password:</label>
				<input type="password" class="form-control" id="pwd">
			</div>
			<div class="checkbox">
				<label><input type="checkbox"> Remember me</label>
			</div>
			<button type="submit" class="btn btn-default">Log In</button>
			<button type="submit" class="btn btn-default">Register</button>
		</form>	
	</div>
</div>

<?php include 'footer.php'; ?>

