<?php 
	$title = "Contact Us"; 
	include 'php/header.php'; 
	
	if(isset($_GET['msg'])){
		switch($_GET['msg']) {
			case "fail":
				echo	"<div class='alert alert-danger'>
							<strong>Error!</strong> Unable to send message.
						</div>";
					break;
					
			case "success":
				echo 	"<div class='alert alert-success'>
							Your message has been sent!
						</div>";
					break;
			default:
		}
	}
?>
<script src="js/contactformsub.js"></script>

<div class="container">
	<div class="jumbotron">
		<h1>Contact Us!</h1>
		<hr class="colorgraph">
		<p>Here is how you can talk to us.</p>
		<form role="form" id="contactForm" method="post" action="php/contactForm-message.php">
			<div class="row">
				<div class="form-group col-sm-6">
					<label for="name" class="h4">Name</label>
					<input type="text" class="form-control" id="name" name="name" required="true">
				</div>
				<div class="form-group col-sm-6">
					<label for="email" class="h4">Email</label>
					<input type="text" class="form-control" id="email" name="email" required="true">
				</div>
			</div>
			<div class="form-group">
				<label for="message" class="h3">Message</label>
				<textarea id="message" class="form-control" rows="6" name="message" required="true"></textarea>
			</div>
			<button type="submit" id="form-submit" class="btn btn-success btn-lg pull-right">Submit</button>
		</form>
	</div>
</div>

<?php include 'php/footer.php'; ?>
