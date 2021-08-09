<?php
	require "db-handler.php";
	
	if(isset($_POST['confirm-delete-entry'])) {
		$journalID=$_POST['deleteThisEntry'];
		$sql="DELETE FROM journal WHERE journalID=?";
		$stmt=mysqli_stmt_init($conn);
		
		mysqli_stmt_prepare($stmt,$sql);
		mysqli_stmt_bind_param($stmt,"i",$journalID);
		mysqli_stmt_execute($stmt);
		
		header("Location:../features/doctorViewPreviousEntries.php?delete=successful");
	}