<?php
	if(isset($_POST['signup-submit'])) {
		require "db-handler.php";
		
		$username=$_POST['username'];
		$mail=$_POST['email'];
		$password=$_POST['password'];
		$passwordRepeat=$_POST['password-repeat'];
		$userType="client";
		
		$name=$_POST['name'];
		$address=$_POST['address'];
		$phoneNo=$_POST['phoneNo'];
		
		//Additional error handlers will be implemented at a later date OK?
		//For now I proceed to registration.
		
		if($password!==$passwordRepeat) {
			header("Location: ../signup.php?error=passwordcheck&mail=".$email."&uid=".$username);
			exit();
		}
		else {
			$query="SELECT uidUsers FROM users WHERE uidUsers=?";
			$stmt=mysqli_stmt_init($conn);
			if(!mysqli_stmt_prepare($stmt,$query)) {
				header("Location: ../signup.php?error=sqlerror");
				exit();
			}
			else {
				mysqli_stmt_bind_param($stmt, "s", $username);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);
				$resultCheck=mysqli_stmt_num_rows($stmt);
				
				if($resultCheck>0) {
					header("Location: ../signup.php?error=usernametaken&mail=".$mail);
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
						header("Location: ../features/signup.php?error=emailtaken");
						exit();
					}
					else {
					$sql="INSERT INTO users (uidUsers, emailUsers, pwdUsers, userType) VALUES (?,?,?,?)";
					$stmt=mysqli_stmt_init($conn);
					if(!mysqli_stmt_prepare($stmt,$sql)) {
						header("Location:../signup.php?error=sqlerror");
						exit();
					}
					else {
							$hashedPwd=password_hash($password, PASSWORD_DEFAULT);
							mysqli_stmt_bind_param($stmt,"ssss",$username,$mail,$hashedPwd,$userType);
							mysqli_stmt_execute($stmt);
							mysqli_stmt_store_result($stmt);
							$sql="INSERT INTO client (idUsers) SELECT idUsers FROM users WHERE uidUsers=?";
							$stmt=mysqli_stmt_init($conn);
							if(!mysqli_stmt_prepare($stmt,$sql)) {
								mysqli_report(MYSQLI_REPORT_ALL);
								//header("Location:../signup.php?error=sqlerror2");
								exit();
							}
							else {
								mysqli_stmt_bind_param($stmt, "s", $username);
								mysqli_stmt_execute($stmt);
								mysqli_stmt_store_result($stmt);
								//Second round of SQL
								$sql="UPDATE client SET clientName=?,clientAddress=?,clientPhoneNo=? WHERE idUsers IN (SELECT idUsers FROM users WHERE uidUsers=?)";
								$stmt=mysqli_stmt_init($conn);
								if(!mysqli_stmt_prepare($stmt,$sql)) {
									mysqli_report(MYSQLI_REPORT_ALL);
									//header("Location:../signup.php?error=sqlerror3");
									exit();
								}
								else {
									mysqli_stmt_bind_param($stmt, "ssss", $name, $address, $phoneNo, $username);
									mysqli_stmt_execute($stmt);
									mysqli_stmt_store_result($stmt);
									header("Location:../signup.php?signup=success");
									exit();
								}
							}
						}
					}
				}
			}
		}
		mysqli_stmt_close($stmt);
		mysqli_close($conn);
	}
	else {
	header("Location: ../signup.php");
	exit();
	}