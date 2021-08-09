<?php
	session_start();
	include "../scripts/db-handler.php";
	if(!isAdmin()) {
		header("Location:../header.php?error=you-must-login-first");
		exit();
	}
	if(isset($_GET['signup'])&&$_GET['signup']=='success') {
		echo '<script>alert("User added successfully.");window.location.href="'.htmlspecialchars($_SERVER['PHP_SELF']).'";</script>';
	}
	
	if(isset($_GET['error'])&&($_GET['error']=='usernametaken'||$_GET['error']=='emailtaken')) {
		echo '<script>alert("Error, that username/email is already taken. Please try again.");window.location.href="'.htmlspecialchars($_SERVER['PHP_SELF']).'";</script>';
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="../style.css">
		<title>Veterinary Clinic Management System</title>
	</head>
	<body>
		<div class="my-header">
			<ul>
				<li><a class="logo" href="../header.php">VCMS</a></li>
				<li><a class="header-menu-item" href="../aboutUs.php">About us</a> </li>
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
				<form action="../scripts/adduser-script.php" method="post">
					<h2 class="signup-form-header">Add User</h2>
					<input type="text" name="username" placeholder="username" maxlength="20" required> <br> <!-- Buang this later -->
					<input type="email" name="email" placeholder="e-mail" required><br>
					<input type="text" name="name" placeholder="The user's name" required><br>
					<input type="textarea" class="use-for-textarea" name="address" placeholder="The user's address" required><br>
					<input type="text" name="phoneNo" pattern="^6?01\d{8}$" placeholder="The user's phone number" required><br>
					<input type="password" name="password" placeholder="password" minlength="6" required> <br>
					<select name="usertype">
						<option value="admin">Admin</option>
						<option value="doctor">Doctor</option>
						<option value="clerk">Clerk</option>
						<option value="client">Client</option>
					</select>
					<button type="submit" name="adduser-submit">Add user</button>
				</form>
			</div>
		</div>
	</body>
</html>