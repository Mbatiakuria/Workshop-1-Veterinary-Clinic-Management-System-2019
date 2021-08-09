<?php
	session_start();
	
	
	if(isset($_POST['new-entry-submit'])) {
		require "db-handler.php";
		//Implement error checking LATER!
		$date=$_POST['date'];
		//$time=$_POST['time'];
		$petName=$_POST['petName'];
		$reason=$_POST['reason-for-visit'];
		$notes=$_POST['notes'];
		$prescriptions=$_POST['prescriptions'];
		$nextAppointment=$_POST['next-appointment'];
		$userID = $_SESSION['userId'];
		$idClients = $_POST['idClients'];
		$idAnimals = $_POST['idAnimals'];
		$status = $_POST['status'];
		if($status == "stay") {
			$stay="true";
			$status = "The animal is staying at the clinic for further treatment";
		}
		else if($status=="discharge") {
			$stay="false";
			$status = "Discharged - Animal brought home";
		}
		$receiptGenerated="no";
		
		$sql="SELECT idDoctors FROM doctors WHERE idUsers=?";
		$stmt=mysqli_stmt_init($conn);
		
		mysqli_stmt_prepare($stmt,$sql);
		mysqli_stmt_bind_param($stmt,"i", $userID);
		mysqli_stmt_execute($stmt);
		
		$result=mysqli_stmt_get_result($stmt);
		if($row=mysqli_fetch_assoc($result)) {
			$doctorID=$row['idDoctors'];
		}
		
		$sql = "SELECT doctorName FROM doctors WHERE idDoctors=?";
		$stmt=mysqli_stmt_init($conn);
		mysqli_stmt_prepare($stmt, $sql);
		mysqli_stmt_bind_param($stmt, "i", $doctorID);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_store_result($stmt);
		mysqli_stmt_bind_result($stmt, $doctorName);
		mysqli_stmt_fetch($stmt);
		
		//After getting the doctor ID, time to insert into database
		$sql="INSERT INTO journal (idDoctors, date,petName, reason, notes, prescriptions, nextAppointment) VALUES (?,?,?,?,?,?,?)";
		$stmt=mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt,$sql)) {
			header("Location:../features/doctorNewEntryForm.php?error=sqlerror");
			exit();
		}
		else {
			mysqli_stmt_bind_param($stmt, "issssss", $doctorID, $date, $petName,$reason,$notes,$prescriptions,$nextAppointment);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			
			//FETCH THE TIME
			$sql="SELECT time FROM journal WHERE idDoctors=? AND date=? AND petName=? AND reason=? AND notes=? AND prescriptions=? AND nextAppointment=?";
			$stmt=mysqli_stmt_init($conn);
			mysqli_stmt_prepare($stmt, $sql);
			mysqli_stmt_bind_param($stmt, "issssss", $doctorID, $date, $petName, $reason, $notes, $prescriptions, $nextAppointment);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			mysqli_stmt_bind_result($stmt, $time);
			mysqli_stmt_fetch($stmt);
			
			//Start
			//Need to fetch that journalID first.
			$sql = "SELECT journalID FROM journal WHERE idDoctors=? AND date=? AND time=? AND petName=? AND reason=? AND notes=? AND prescriptions=? AND nextAppointment=?";
			$stmt=mysqli_stmt_init($conn);
			mysqli_stmt_prepare($stmt, $sql);
			mysqli_stmt_bind_param($stmt, "isssssss", $doctorID, $date, $time, $petName, $reason, $notes, $prescriptions, $nextAppointment);
			mysqli_stmt_execute($stmt);
			mysqli_store_result($stmt);
			mysqli_stmt_bind_result($stmt, $journalID);
			mysqli_stmt_fetch($stmt);
			
			$sql="INSERT INTO patientinformation (idAnimals,ownerID,petName,dateAcquired,veterenarianID,journalID, status, stay, receiptGenerated) VALUES (?,?,?,?,?,?,?,?,?)";
			$stmt=mysqli_stmt_init($conn);
			mysqli_stmt_prepare($stmt, $sql);
			mysqli_stmt_bind_param($stmt, "iissiisss", $idAnimals, $idClients, $petName, $date, $doctorID, $journalID, $status, $stay, $receiptGenerated);
			mysqli_stmt_execute($stmt);
			
			//End
			
			header("Location:../features/doctorVisitsJournalMenu.php?entry-creation=success");
			exit();
		}
	}