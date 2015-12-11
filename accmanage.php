<?php 
	$title = "Account Settings"; 
	include 'php/header.php';

	if(isset($_GET['msg'])) {
		switch($_GET['msg']) {
			case "missing":
				echo "<div class='alert alert-danger'>
					<strong>Error!</strong> One or more fields missing data.
				</div>";
				break;
				
			case "pwds":
				echo "<div class='alert alert-danger'>
					<strong>Error!</strong> Passwords do not match.
				</div>";
				break;	
				
			case "oldpwd":
				echo "<div class='alert alert-danger'>
					<strong>Error!</strong> Old password incorrect.
				</div>";
				break;	
			
			case "success":
				echo "<div class='alert alert-success'>
					Your password has been changed!
				</div>";
				break;	
			default:
		}
	}
	
	if (isset($_GET['token'])) {
		// Check if token is valid
		$query = "SELECT u.userID, u.email, token, expiry FROM TOKENS t, USERS u WHERE u.userID = t.userID AND token = '".$_GET['token']."';";
		$result = mysqli_query($link, $query) or die(mysqli_error($link));
		
		if(mysqli_num_rows($result) == 1) {
			$row = mysqli_fetch_assoc($result);
			
			$token = $row['token'];
			$timediff = strtotime($row['expiry']) - strtotime(date("Y-m-d H:i:s"));
			
			if ($timediff < 0) {
				// If token has expired, delete token and redirect to login page
				$query = "DELETE FROM TOKENS WHERE token = '$token'";
				mysqli_query($link, $query) or die(mysqli_error($link));
				
				header("Location: login.php?msg=invalidToken");
				die();
			}
		} else {
			// If token is not in database, redirect to login page
			header("Location: login.php?msg=invalidToken");
			die();
		}
	}
?>

<div class="container" style="margin-top:30px">
	<div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
		<div class="panel panel-default">
			<div class="panel-heading">
				<?php 
					if (isset($_GET['token'])) {
						echo '<h3 class="panel-title"><strong>Reset Password</strong></h3>';
					} else {
						echo '<h3 class="panel-title"><strong>Change Password</strong></h3>';
					}
			 	?>
			</div>
			<div class="panel-body">
			<hr class="colorgraph">
				<form role="form" method="post" action="changepass.php">
					<div class="form-group" id="pwdDiv">
						<label for="pwd">Choose a new password:</label>
						<input name="reg_pword" type="password" class="form-control" id="pwd" onblur="validatePwd()">
						<span id="pwdStatus"></span>
					</div>
					<div class="form-group" id="pwdcDiv">
						<label for="pwdc">Confirm your new password:</label>
						<input name="reg_pwordc" type="password" class="form-control" id="pwdc" onblur="validatePwdc()">
						<span id="pwdcStatus"></span>
					</div>
					<?php if (!isset($token)) : ?>
					<div class="form-group" id="oldpwdDiv">
						<label for="oldpwd">For security, confirm your old password:</label>
						<input name="reg_oldpword" type="password" class="form-control" id="oldpwd"">
					</div>
					<?php else :
							echo "<input type='hidden' name='token' value='$token'>";
					 	  endif ?>
					<hr class="colorgraph">
					<button type="submit" class="btn btn-lg btn-success btn-block">Change Password</button>
				</form>
			</div>
		</div>
	</div>
</div>

<script src="js/checkSignUp.js"></script>

<?php include 'php/footer.php'; ?>
