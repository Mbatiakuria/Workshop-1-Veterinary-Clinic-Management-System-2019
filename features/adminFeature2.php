<?php
	include "../scripts/db-handler.php";
	session_start();
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
			<div class="admin-feature" style="overflow:auto">
				<h2 class="login-form-header">View User Accounts</h2>
		<table style="border:1px solid black;width:600px;margin:0 auto">
			<tr>
				<th>User ID</th>
				<th>UserType</th>
				<th>Username</th>
				<th>Email</th>
			</tr>
			<?php
				if($conn) {
					$query = "SELECT * FROM users";
					$result = mysqli_query($conn,$query);
					if(mysqli_num_rows($result)>0) {
						while($row = mysqli_fetch_assoc($result)) {
						echo "<tr>";
						echo "<th>".$row['idUsers']."</th>";
						echo "<th>".$row['userType']."</th>";
						echo "<th>".$row['uidUsers']."</th>";
						echo "<th>".$row['emailUsers']."</th>";
						echo"</tr>";
			}
		}
		else
			echo "There are no users registered in the system!";
	}
			?>
		</table>
				<a href="../header.php"><button class="back-to-menu" type="button">Back to menu</button></a>
			</div>
		</div>
	</body>
</html>