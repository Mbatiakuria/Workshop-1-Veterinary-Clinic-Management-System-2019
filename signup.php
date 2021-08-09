<?php
	if(isset($_GET['error'])&&($_GET['error']=='usernametaken'||$_GET['error']=='emailtaken')) {
		echo '<script>alert("Error, that username/email is already taken. Please try again.");window.location.href="'.htmlspecialchars($_SERVER['PHP_SELF']).'";</script>';
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="style.css">
		<title>Veterinary Clinic Management System</title>
	</head>
	<body>
		<div class="my-header">
			<ul>
				<li><a class="logo" href="header.php">VCMS</a></li>
				<li><a class="header-menu-item" href="aboutUs.php">About us</a> </li>
			</ul>
		</div>
		<div class="my-background">
			
			<div class="bg-left-special">
				<!-- Background image 1 -->
			</div>
			<div class="bg-right-special">
				<!-- Background image 2 -->
			</div>
			<div class="signup-form" style="width:800px;margin-left:350px">
				<form action="scripts/signup-script.php" method="post">
					<h2 class="signup-form-header">Signup</h2>
					<input type="text" name="username" placeholder="username" maxlength="20" required> <br>
					<input type="email" name="email" placeholder="e-mail" required><br>
					<input type="text" name="name" placeholder="Your name" required><br>
					<input type="textarea" name="address" placeholder="Your address" class="use-for-textarea" required><br>
					<input type="text" name="phoneNo" placeholder="Your phone number" pattern="^6?01\d{8}$" required><br>
					<input type="password" name="password" placeholder="password" minlength="6" required> <br>
					<input type="password" name="password-repeat" placeholder="repeat password"  minlength="6" required> <br>
					<button type="submit" name="signup-submit">Signup</button>
				</form>
			</div>
		</div>
	</body>
</html>