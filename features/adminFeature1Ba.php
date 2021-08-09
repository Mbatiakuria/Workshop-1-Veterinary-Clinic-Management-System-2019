<?php
	session_start();
	include "../scripts/db-handler.php";
	if(!isAdmin()) {
		header("Location:../header.php?error=you-must-login-first");
		exit();
	}
	if(isset($_GET['error'])&&$_GET['error']=='usernamenotfound') {
		echo '<script>alert("Sorry, user ID not recognized. Please try again.");window.location.href="'.htmlspecialchars($_SERVER['PHP_SELF']).'";</script>';
	}
?>
<!DOCTYPE hmtl>
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
			<div class="login-form">
				<h2 class="login-form-header">Update User</h2>
				<h3 class="login-form-header">Search user by id: </h3>
				<form action="../scripts/search-user.php" method="post">
					<input type="number" min="1" name="userID" placeholder="user id">
					<button type="submit" name="search-submit">Search</button>
					<a href="adminFeature1.php"><button type="button">Back to menu</button></a>
				</form>
			</div>
		</div>
	</body>
</html>