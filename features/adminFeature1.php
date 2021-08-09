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
			<div class="manage-user-account">
				<h2 class="login-form-header">Manage User Accounts</h2>
				<a href="adminFeature1A.php"><button type="button">Add User</button></a>
				<br><a href="adminFeature1Ba.php"><button type="button">Update User</button></a>
				<br><a href="adminFeature1Bc.php"><button type="button">Delete User</button></a>
				<a href="../header.php"><button class="back-to-menu" type="button">Back to menu</button></a>
			</div>
		</div>
	</body>
</html>