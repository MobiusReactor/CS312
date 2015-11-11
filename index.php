<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset='utf-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1'>

	<!-- Latest compiled and minified CSS -->
	<link rel='stylesheet' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'>

	<!-- jQuery library -->
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js'></script>

	<!-- Latest compiled JavaScript -->
	<script src='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script>
	<script src='css/styles.css'></script>
</head>
<body>
<div class="row">
	<div class="col-sm-9">
		<img src="logo.jpg" class="img-rounded" alt="Cinque Terre" width="204" height="166">
	</div>
	<div class="col-sm-3">
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


<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">WebSiteName</a>
    </div>
    <div>
      <ul class="nav navbar-nav">
        <li class="active"><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
        <li><a href="#">Examples</a></li>
        <li><a href="#">FAQ</a></li>
        <li><a href="#">Contact Us</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">
	<div class="jumbotron">
		<h1>Welcome!</h1>
		<p>Here is some message explaining what is what over here.</p>
	</div>
</div>

</body>
</html>

