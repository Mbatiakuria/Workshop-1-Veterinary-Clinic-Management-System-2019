<?php
	session_start();
	require "db-handler.php";
	$deleteThis = $_SESSION['primedForDelete'];
	$userType = $_SESSION['primedForDeleteUserType'];
	
	if($userType=='admin') {
		$sql="DELETE FROM admins WHERE idUsers=?";
		$stmt=mysqli_stmt_init($conn);
		mysqli_stmt_prepare($stmt,$sql);
		mysqli_stmt_bind_param($stmt, "i",$deleteThis);
		mysqli_stmt_execute($stmt);
	}
	else if($userType=='doctor') {
		//$sql="DELETE FROM doctors WHERE idUsers=?";
		//$stmt=mysqli_stmt_init($conn);
		//mysqli_stmt_prepare($stmt,$sql);
		//mysqli_stmt_bind_param($stmt, "i",$deleteThis);
		//mysqli_stmt_execute($stmt);
		
		header("Location:../features/AdminFeature1Bc.php?error=doctor-cannot-be-deleted");
		exit();
	}
	else if($userType=='client') {
		$sql="DELETE FROM client WHERE idUsers=?";
		$stmt=mysqli_stmt_init($conn);
		mysqli_stmt_prepare($stmt,$sql);
		mysqli_stmt_bind_param($stmt, "i",$deleteThis);
		mysqli_stmt_execute($stmt);
	}
	else if($userType=='clerk') {
		$sql="DELETE FROM clerks WHERE idUsers=?";
		$stmt=mysqli_stmt_init($conn);
		mysqli_stmt_prepare($stmt,$sql);
		mysqli_stmt_bind_param($stmt, "i",$deleteThis);
		mysqli_stmt_execute($stmt);
	}
	//check if need error checking.
	$sql="DELETE FROM users WHERE idUsers=?";
	$stmt=mysqli_stmt_init($conn);
	mysqli_stmt_prepare($stmt, $sql);
	mysqli_stmt_bind_param($stmt, "i", $deleteThis);
	mysqli_stmt_execute($stmt);
	
	header("Location:../features/adminFeature1Bc.php?delete=successful");