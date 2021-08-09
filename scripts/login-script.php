<?php

	if(isset($_POST['login-submit'])) {
		require "db-handler.php";
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		//Error handling will be implemented later!
		//For now I just proceed to logging the user in.
		
		$query = "SELECT * FROM users WHERE uidUsers=?";
		$stmt = mysqli_stmt_init($conn);

		mysqli_stmt_prepare($stmt,$query);
		mysqli_stmt_bind_param($stmt, "s", $username);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_store_result($stmt);
		if(mysqli_stmt_num_rows($stmt)>0) {
			$sql2 = "SELECT * FROM users WHERE uidUsers=?";
			$stmt2 = mysqli_stmt_init($conn);
			mysqli_stmt_prepare($stmt2, $sql2);
			mysqli_stmt_bind_param($stmt2, "s", $username);
			mysqli_stmt_execute($stmt2);
			$result=mysqli_stmt_get_result($stmt2);
			if($row = mysqli_fetch_assoc($result)) {
				$passwordCheck=password_verify($password, $row['pwdUsers']);
				if($passwordCheck==false) {
					header("Location: ../index.php?error=wrongpwd");
					exit();
				}
				else if($passwordCheck==true){
					session_start();
					$_SESSION['userId']=$row['idUsers'];
					$_SESSION['userType']=$row['userType'];
					header("Location: ../index.php?login=success");
					exit();
				}
			}	
		}
		else {
			header("Location: ../index.php?error=nousername");
			exit();
		}
	}