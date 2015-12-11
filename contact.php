<?php $title = "Contact Us"; include 'php/header.php'; ?>
<script src="js/contactformsub.js"></script>

<div class="container">
	<div class="jumbotron">
		<h1>Contact Us!</h1>
		<hr class="colorgraph">
		<p>Here is how you can talk to us.</p>
		<form role="form" id="contactForm" onsubmit="submitForm()">
			<div class="row">
				<div class="form-group col-sm-6">
					<label for="name" class="h4">Name</label>
					<input type="text" class="form-control" id="name" required="true">
				</div>
				<div class="form-group col-sm-6">
					<label for="email" class="h4">Email</label>
					<input type="text" class="form-control" id="email" required="true">
				</div>
			</div>
			<div class="form-group">
				<label for="message" class="h3">Message</label>
				<textarea id="message" class="form-control" rows="6" required="true"></textarea>
			</div>
			<button type="submit" id="form-submit" class="btn btn-success btn-lg pull-right">Submit</button>
			<div id="msgSubmit" class="h4 text-center hidden">Submitted</div>
		</form>
	</div>
</div>

<?php include 'php/footer.php'; ?>
