<?php
	if(isset($_POST['adduser-submit'])) {
		require "db-handler.php";
		//Implement error checking LATER!
		$username = $_POST['username'];
		$mail=$_POST['email'];
		$password=$_POST['password'];
		$userType=$_POST['usertype'];
		$name=$_POST['name'];
		$address=$_POST['address'];
		$phoneNo=$_POST['phoneNo'];
		
		
			$query="SELECT uidUsers FROM users WHERE uidUsers=?";
			$stmt=mysqli_stmt_init($conn);
			if(!mysqli_stmt_prepare($stmt,$query)) {
				header("Location: ../features/adminFeature1A.php?error=sqlerror");
				exit();
			}
			else {
				mysqli_stmt_bind_param($stmt, "s", $username);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);
				$resultCheck=mysqli_stmt_num_rows($stmt);
				
				if($resultCheck>0) {
					header("Location: ../features/adminFeature1A.php?error=usernametaken&mail=".$mail);
					exit();
				}
				else {
					//Check if email is taken
					$query = "SELECT emailUsers FROM users WHERE emailUsers=?";
					$stmt=mysqli_stmt_init($conn);
					mysqli_stmt_prepare($stmt,$query);
					mysqli_stmt_bind_param($stmt, "s", $mail);
					mysqli_stmt_execute($stmt);
					mysqli_stmt_store_result($stmt);
					$resultCheck = mysqli_stmt_num_rows($stmt);
					if($resultCheck>0) {
						header("Location: ../features/adminFeature1A.php?error=emailtaken");
						exit();
					}
					else {
						$sql="INSERT INTO users (uidUsers, emailUsers, pwdUsers, userType) VALUES (?,?,?,?)";
					$stmt=mysqli_stmt_init($conn);
					if(!mysqli_stmt_prepare($stmt,$sql)) {
						header("Location:../features/adminFeature1A.php?error=sqlerror");
						exit();
					}
					else {
						$hashedPwd=password_hash($password, PASSWORD_DEFAULT);
						mysqli_stmt_bind_param($stmt,"ssss",$username,$mail,$hashedPwd,$userType);
						mysqli_stmt_execute($stmt);
						mysqli_stmt_store_result($stmt);
						//Adding doctors
						if($userType=="doctor") {
							
							$sql="INSERT INTO doctors (idUsers) SELECT idUsers FROM users WHERE uidUsers=?";
							$stmt = mysqli_stmt_init($conn);
							if(!mysqli_stmt_prepare($stmt,$sql)) {
								header("Location: ../features/adminFeature1A.php?error=sqlerror");
								exit();
							}
							else {
								mysqli_stmt_bind_param($stmt, "s", $username);
								mysqli_stmt_execute($stmt);
								mysqli_stmt_store_result($stmt);
								$sql="UPDATE doctors SET doctorName=?,doctorAddress=?,doctorPhoneNo=? WHERE idUsers IN (SELECT idUsers FROM users WHERE uidUsers=?)";
								$stmt=mysqli_stmt_init($conn);
								if(!mysqli_stmt_prepare($stmt,$sql)) {
									header("Location:../features/adminFeature1A.php?error=sqlerror3");
									exit();
								}
								else {
									mysqli_stmt_bind_param($stmt, "ssss", $name, $address, $phoneNo, $username);
									mysqli_stmt_execute($stmt);
									mysqli_stmt_store_result($stmt);
									header("Location:../features/adminFeature1A.php?signup=success");
									exit();
								}
							}
						}
						//Adding Admins
						else if($userType=="admin") {
							$sql="INSERT INTO admins (idUsers) SELECT idUsers FROM users WHERE uidUsers=?";
							$stmt = mysqli_stmt_init($conn);
							if(!mysqli_stmt_prepare($stmt,$sql)) {
								header("Location: ../features/adminFeature1A.php?error=sqlerror");
								exit();
							}
							else {
								mysqli_stmt_bind_param($stmt, "s", $username);
								mysqli_stmt_execute($stmt);
								mysqli_stmt_store_result($stmt);
								$sql="UPDATE admins SET adminName=?,adminAddress=?,adminPhoneNo=? WHERE idUsers IN (SELECT idUsers FROM users WHERE uidUsers=?)";
								$stmt=mysqli_stmt_init($conn);
								if(!mysqli_stmt_prepare($stmt,$sql)) {
									header("Location:../features/adminFeature1A.php?error=sqlerror3");
									exit();
								}
								else {
									mysqli_stmt_bind_param($stmt, "ssss", $name, $address, $phoneNo, $username);
									mysqli_stmt_execute($stmt);
									mysqli_stmt_store_result($stmt);
									header("Location:../features/adminFeature1A.php?signup=success");
									exit();
								}
							}
						}
						//Adding clients.
						else if($userType=="client") {
							$sql="INSERT INTO client (idUsers) SELECT idUsers FROM users WHERE uidUsers=?";
							$stmt = mysqli_stmt_init($conn);
							if(!mysqli_stmt_prepare($stmt,$sql)) {
								header("Location: ../features/adminFeature1A.php?error=sqlerror");
								exit();
							}
							else {
								mysqli_stmt_bind_param($stmt, "s", $username);
								mysqli_stmt_execute($stmt);
								mysqli_stmt_store_result($stmt);
								$sql="UPDATE client SET clientName=?,clientAddress=?,clientPhoneNo=? WHERE idUsers IN (SELECT idUsers FROM users WHERE uidUsers=?)";
								$stmt=mysqli_stmt_init($conn);
								if(!mysqli_stmt_prepare($stmt,$sql)) {
									header("Location:../features/adminFeature1A.php?error=sqlerror3");
									exit();
								}
								else {
									mysqli_stmt_bind_param($stmt, "ssss", $name, $address, $phoneNo, $username);
									mysqli_stmt_execute($stmt);
									mysqli_stmt_store_result($stmt);
									header("Location:../features/adminFeature1A.php?signup=success");
									exit();
								}
							}
						}
						
						else if($userType=="clerk") {
							$sql="INSERT INTO clerks (idUsers) SELECT idUsers FROM users WHERE uidUsers=?";
							$stmt = mysqli_stmt_init($conn);
							if(!mysqli_stmt_prepare($stmt,$sql)) {
								header("Location: ../features/adminFeature1A.php?error=sqlerror");
								exit();
							}
							else {
								mysqli_stmt_bind_param($stmt, "s", $username);
								mysqli_stmt_execute($stmt);
								mysqli_stmt_store_result($stmt);
								$sql="UPDATE clerks SET clerkName=?,clerkAddress=?,clerkPhoneNo=? WHERE idUsers IN (SELECT idUsers FROM users WHERE uidUsers=?)";
								$stmt=mysqli_stmt_init($conn);
								if(!mysqli_stmt_prepare($stmt,$sql)) {
									header("Location:../features/adminFeature1A.php?error=sqlerror3");
									exit();
								}
								else {
									mysqli_stmt_bind_param($stmt, "ssss", $name, $address, $phoneNo, $username);
									mysqli_stmt_execute($stmt);
									mysqli_stmt_store_result($stmt);
									header("Location:../features/adminFeature1A.php?signup=success");
									exit();
								}
							}
						}
						
						
						header("Location:../features/adminFeature1A.php?signup=success");
						exit();
					}
					}
				}
			}
	}