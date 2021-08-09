<?php
	session_start();
	include "../scripts/db-handler.php";
	if(!isAdmin()) {
		header("Location:../header.php?error=you-must-login-first");
		exit();
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
			
			<div class="bg-left-blur">
				<!-- Background image 1 -->
			</div>
			<div class="bg-right-blur">
				<!-- Background image 2 -->
			</div>
			<div class="signup-form">
				<form action="../scripts/updateuser-script.php" method="post">
					<h2 class="signup-form-header">Update User</h2>
					<input type="text" name="username" placeholder="username" required> <br>
					<input type="mail" name="email" placeholder="e-mail" readonly><br>
					<input type="password" name="password" placeholder="password" required> <br>
					<select name="usertype">
						<option value="admin">Admin</option>
						<option value="doctor">Doctor</option>
						<option value="clerk">Clerk</option>
						<option value="client">Client</option>
					</select>
					<button type="submit" name="updateuser-submit">Update user information</button>
				</form>
			</div>
		</div>
	</body>
</html>