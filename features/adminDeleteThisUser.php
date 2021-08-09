<?php
	session_start();
	require "../scripts/db-handler.php";
	if(!isAdmin()) {
		header("Location:../header.php?error=you-must-login-first");
		exit();
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
			<div class="login-form" style="width:34.16%;height:65.81vh">
				<h2 class="login-form-header">Delete this user?</h2>
					<?php
						$sql="SELECT * FROM users WHERE idUsers=?";
						$stmt=mysqli_stmt_init($conn);
						mysqli_stmt_prepare($stmt, $sql);
						mysqli_stmt_bind_param($stmt, "i", $_SESSION['idSearch']);
						mysqli_stmt_execute($stmt);
						mysqli_stmt_store_result($stmt);
						mysqli_stmt_bind_result($stmt, $idUsers, $uidUsers, $emailUsers, $pwdUsers, $userType);
						
						while(mysqli_stmt_fetch($stmt)) {
							echo "<h2 class=\"login-form-header\" style=\"font-size:20px\">User ID:".$idUsers."</h2>";
							echo "<h2 class=\"login-form-header\" style=\"font-size:20px\">Username:".$uidUsers."</h2>";
							echo "<h2 class=\"login-form-header\" style=\"font-size:20px\">User email:".$emailUsers."</h2>";
							echo "<h2 class=\"login-form-header\" style=\"font-size:20px\">User Type:".$userType."</h2>";
						}
						
						$_SESSION['primedForDelete']= $idUsers;
						$_SESSION['primedForDeleteUserType']=$userType;
					?>
				<a href="../scripts/delete-user.php"><button type="button" class="back-to-menu">Yes</button></a>
				<a href="adminFeature1.php"><button type="button" class="back-to-menu">Back to menu</button></a>
			</div>
		</div>
	</body>
</html>