<?php
	if(isset($_POST['search-submit'])) {
		require "db-handler.php";
		$userID = $_POST['userID'];
		
		//Implement error checking later.
		$sql="SELECT idUsers FROM users WHERE idUsers=?";
		$stmt=mysqli_stmt_init($conn);
			if(!mysqli_stmt_prepare($stmt,$sql)) {
				header("Location: ../features/adminFeature1Ba.php?error=sqlerror");
				exit();
			}
			else {
				mysqli_stmt_bind_param($stmt, "i", $userID);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);
				$resultCheck=mysqli_stmt_num_rows($stmt);
				
				if($resultCheck>0) {
					session_start();
					$_SESSION['idSearch']=$userID;
					header("Location: ../features/adminFeature1Bb.php");
				}
				else {
					header("Location: ../features/adminFeature1Ba.php?error=usernamenotfound&mail=".$mail);
					exit();
				}
			}
	}