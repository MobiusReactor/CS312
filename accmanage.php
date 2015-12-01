<?php include 'php/header.php'; ?>

<?php 
	if(!isset($_SESSION["email"])){
			header("Location: index.php");
	}
?>

<div class="container">
	<div class="jumbotron">
		<h1>Welcome!</h1>
		<p>Here is some message explaining what is what over here.</p>
	</div>
</div>

<?php include 'php/footer.php'; ?>

