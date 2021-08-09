<?php
	include "../scripts/db-handler.php";
	session_start();
	if(!isClerk()) {
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
			
			<div class="bg-left-special">
				<!-- Background image 1 -->
			</div>
			<div class="bg-right-special">
				<!-- Background image 2 -->
			</div>
			<div class="login-form" style="width:800px;margin-left:25%">
				<h2 class="login-form-header">Add New Animal</h2>
				<form action="../scripts/add-new-animal.php" method="post" enctype="multipart/form-data" style="padding-bottom:100px">
					<h3>Species: (Available input are Cat, Dog, Hamster, Sheep, Horse, Cattle)</h3>
					<input type="text" name="species" pattern="Cat|Dog|Hamster|Sheep|Horse|Cattle" required> <br>
					<h3>Breed:</h3>
					<input type="text" name="breed"> <br>
					<h3>Sex:</h3>
					<select name="sex">
						<option value="Male">Male</option>
						<option value="Female">Female</option>
					</select> <br>
					<h3>Color:</h3>
					<input type="text" name="color" required> <br>
					<h3>Weight: (KG)</h3>
					<input type="text" name="weight" required> <br>
					<h3>Age:</h3>
					<input type="number" min="0.1" name="age" step="0.1" required> <br>
					<h3>Upload Image: </h3>
					<input style="margin-top:35px;margin-left:20px" type="file" name="imageToUpload" required> <br>
					<button type="submit" name="add-new-animal-submit">Add</button>
					<a href="../header.php"><button class="back-to-menu" type="button">Back to menu</button></a>
				</form>
			</div>
		</div>
	</body>
</html>