<?php
	//This page is for testing purposes. I wanted to see if I could diplay the data in the users table.
	require "scripts/db-handler.php";
	
	if($conn) {
		$query = "SELECT * FROM users";
		$result = mysqli_query($conn,$query);
		if(mysqli_num_rows($result)>0) {
			while($row = mysqli_fetch_assoc($result)) {
				echo "<br>";
				echo "idUsers: ".$row['idUsers']."<br>".
				"Username: ".$row["uidUsers"]."<br>".
				"E-mail: ".$row["emailUsers"]."<br>".
				"Password: ".$row["pwdUsers"]."<br>".
				"Type: ".$row["userType"]."<br>";
			}
		}
		else
			echo "There are no users registered in the system!";
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Dummy page for testing purposes!</title>
	</head>
	<body>
		<h1>Table for users!</h1>
		<table style="border:1px solid black">
			<tr>
				<th>User ID</th>
				<th>Username</th>
				<th>Email</th>
				<th>Password</th>
				<th>UserType</th>
			</tr>
			<?php
				if($conn) {
					$query = "SELECT * FROM users";
					$result = mysqli_query($conn,$query);
					if(mysqli_num_rows($result)>0) {
						while($row = mysqli_fetch_assoc($result)) {
						echo "<tr>";
						echo "<th>".$row['idUsers']."</th>";
						echo "<th>".$row['uidUsers']."</th>";
						echo "<th>".$row['emailUsers']."</th>";
						echo "<th>".$row['pwdUsers']."</th>";
						echo "<th>".$row['userType']."</th>";
						echo"</tr>";
			}
		}
		else
			echo "There are no users registered in the system!";
	}
			?>
		</table>
	</body>
</html>	

