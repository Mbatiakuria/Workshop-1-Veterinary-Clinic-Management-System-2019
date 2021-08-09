<?php
	session_start();
	//WIP
	if(isset($_POST['updateuser-submit'])) {
		require "db-handler.php";
		//Implement error checking LATER!
		$username = $_POST['username'];
		$mail=$_POST['email'];
		$password=$_POST['password'];
		$userType=$_POST['usertype'];
		$userID=$_SESSION['idSearch'];
		
		
		$query="SELECT idUsers FROM users WHERE idUsers=?";
			$stmt=mysqli_stmt_init($conn);
			if(!mysqli_stmt_prepare($stmt,$query)) {
				header("Location: ../features/adminFeature1Bb.php?error=sqlerror");
				exit();
			}
			else {
				mysqli_stmt_bind_param($stmt, "i", $userID);
				mysqli_stmt_execute($stmt);
				//DEBUG
				mysqli_stmt_store_result($stmt);
				$resultCheck=mysqli_stmt_num_rows($stmt);
				
				if($resultCheck>0) {
					$sql="UPDATE users SET uidUsers=?, emailUsers=?, pwdUsers=?, userType=? WHERE idUsers=?";
					$stmt=mysqli_stmt_init($conn);
					if(!mysqli_stmt_prepare($stmt,$sql)) {
						header("Location:../features/adminFeature1Bb.php?error=sqlerror");
						exit();
					}
					else {
						$hashedPwd=password_hash($password, PASSWORD_DEFAULT);
						mysqli_stmt_bind_param($stmt,"ssssi",$username,$mail,$hashedPwd,$userType,$userID);
						mysqli_stmt_execute($stmt);
						mysqli_stmt_store_result($stmt);
						header("Location:../features/adminFeature1Ba.php?update=success");
						exit();
					}
				}
				else {
						header("Location: ../features/adminFeature1Bb.php?error=usernametaken&mail=".$mail);
						exit();
				}
			}
		}