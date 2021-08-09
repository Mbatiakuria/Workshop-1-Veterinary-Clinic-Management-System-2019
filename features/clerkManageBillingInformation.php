<?php
	include "../scripts/db-handler.php";
	session_start();
	if(!isClerk()) {
		header("Location:../header.php?error=you-must-login-first");
		exit();
	}
	if(isset($_POST['go-generate-receipt'])) {
		$petName = $_POST['petName'];
		$idPatients = $_POST['idPatients'];
		$clientName = $_POST['clientName'];
		$consultationFee = $_POST['consultationFee'];
		$medication = $_POST['medication'];
		$surgery = $_POST['surgery'];
		$takeHomeMedicine = $_POST['takeHomeMedicine'];
		$others=$_POST['others'];
		$receiptGenerated = "yes";
		//Calculation
		$totalPrice = $consultationFee + $medication + $surgery + $takeHomeMedicine + $others;
		
		//Insert
		$sql="INSERT INTO billinginformation (idPatients, consultationFee, medication, surgery, takeHomeMedicine, others, totalPrice) VALUES (?,?,?,?,?,?,?)";
		$stmt=mysqli_stmt_init($conn);
		mysqli_stmt_prepare($stmt, $sql);
		mysqli_stmt_bind_param($stmt, "idddddd", $idPatients, $consultationFee, $medication, $surgery, $takeHomeMedicine, $others, $totalPrice);
		mysqli_stmt_execute($stmt);
		
		//Update
		$sql="UPDATE patientinformation SET receiptGenerated=? WHERE idPatients=?";
		$stmt=mysqli_stmt_init($conn);
		mysqli_stmt_prepare($stmt, $sql);
		mysqli_stmt_bind_param($stmt, "si", $receiptGenerated, $idPatients);
		mysqli_stmt_execute($stmt);
		
		//SELECT
		$sql="SELECT billID FROM billinginformation WHERE idPatients=? AND consultationFee=? AND medication=? AND surgery=? AND takeHomeMedicine=? AND others=? AND totalPrice=?";
		$stmt=mysqli_stmt_init($conn);
		mysqli_stmt_prepare($stmt, $sql);
		mysqli_stmt_bind_param($stmt, "idddddd", $idPatients, $consultationFee, $medication, $surgery, $takeHomeMedicine, $others, $totalPrice);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_store_result($stmt);
		mysqli_stmt_bind_result($stmt, $billID);
		mysqli_stmt_fetch($stmt);
		
		header("Location: ".htmlspecialchars($_SERVER['PHP_SELF'])."?billID=".$billID."&receiptGenerated=yes&petName=".$petName."&clientName=".$clientName);
		exit();
	}
?>
<!DOCTYPE hmtl>
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
			<div class="login-form" style="margin-left:350px;padding-bottom:40px;height:unset;width:unset:min-height:200px;min-width:800px;margin-top:20px">
					<?php
						if(isset($_GET['print-receipt'])){
							$petName=$_GET['petName'];
							$clientName=$_GET['clientName'];
							$idPatients = $_GET['idPatients'];
							
							//select
							$sql="SELECT billID FROM billinginformation WHERE idPatients=?";
							$stmt=mysqli_stmt_init($conn);
							mysqli_stmt_init($conn);
							mysqli_stmt_prepare($stmt, $sql);
							mysqli_stmt_bind_param($stmt, "i", $idPatients);
							mysqli_stmt_execute($stmt);
							mysqli_stmt_store_result($stmt);
							mysqli_stmt_bind_result($stmt,$billID);
							mysqli_stmt_fetch($stmt);
							
							
							header("Location: "."receipt.php"."?billID=".$billID."&receiptGenerated=yes&petName=".$petName."&clientName=".$clientName);
							exit();
							
							
						}
						//OLD DONT USE
						else if(isset($_GET['billID'])&&$_GET['receiptGenerated']=="yes") {
							$clientName = $_GET['clientName'];
							$petName = $_GET['petName'];
							$billID = $_GET['billID'];
							$sql = "SELECT * FROM billinginformation WHERE billID=?";
							$stmt=mysqli_stmt_init($conn);
							mysqli_stmt_prepare($stmt, $sql);
							mysqli_stmt_bind_param($stmt, "i", $billID);
							mysqli_stmt_execute($stmt);
							mysqli_stmt_store_result($stmt);
							mysqli_stmt_bind_result($stmt, $billID, $idPatients, $consultationFee,$medication, $surgery, $takeHomeMedicine, $others, $totalPrice);
							mysqli_stmt_fetch($stmt);
							echo '<h2 class="login-form-header">CHARGE SLIP (ID: '.$billID.')</h2>';
							echo '<table style="width:600px;height:500px;margin:0 auto;margin-top:40px;text-align:center;border:1;">';
							echo '<tr>
								<th style="text-align:left;height:50px;font-size:30px" colspan="2">Patient Name: '.$petName.'</th>
							</tr>
							<tr>
								<th style="text-align:left;height:50px;font-size:30px" colspan="2">Owner Name: '.$clientName.'</th>
							</tr>
							<tr>
								<th style="text-align:center;font-size:25px" colspan="1">Consultation Fee:</th>
								<th style="text-align:center;font-size:25px" colspan="1">RM'.$consultationFee.'</th>
							</tr>
							<tr>
								<th style="text-align:center;font-size:25px" colspan="1">Medication:</th>
								<th style="text-align:center;font-size:25px" colspan="1">RM'.$medication.'</th>
							</tr>
							<tr>
								<th style="text-align:center;font-size:25px" colspan="1">Surgery:</th>
								<th style="text-align:center;font-size:25px" colspan="1">RM'.$surgery.'</th>
							</tr>
							<tr>
								<th style="text-align:center;font-size:25px" colspan="1">Take Home Medicine:</th>
								<th style="text-align:center;font-size:25px" colspan="1">RM'.$takeHomeMedicine.'</th>
							</tr>
							<tr>
								<th style="text-align:center;font-size:25px" colspan="1">Others:</th>
								<th style="text-align:center;font-size:25px" colspan="1">RM'.$others.'</th>
							</tr>
							<tr>
								<th style="text-align:center;height:50px;font-size:30px" colspan="2">Total Price: RM'.$totalPrice.'</th>
							</tr>
							';
							echo '</table>';
							echo '<a href="../header.php"><button type="button" class="back-to-menu">Back to menu</button></a>';
						}
						else if(!isset($_GET['generate-receipt'])&&!isset($_GET['petName'])&&!isset($_GET['idPatients'])&&!isset($_GET['clientName']))
						{	
							echo '<h2 class="login-form-header">Manage Billing Information</h2>';
							$sql = "SELECT patientinformation.receiptGenerated, patientinformation.idPatients, patientinformation.idAnimals, patientinformation.ownerID, patientinformation.petName, client.clientName FROM patientinformation JOIN client ON client.idClients = patientinformation.ownerID";
							$result = mysqli_query($conn,$sql);
							if(mysqli_num_rows($result)>0) {
								echo '<table style="border:1px solid black;margin:0 auto;margin-top:20px;width:800px;text-align:center">';
										echo '<tr>';
										echo '<td>Patient ID</td>';
										echo '<td>Patient Name: </td>';
										echo '<td>Owner: </td>';
										echo '</tr>';
									while($row = mysqli_fetch_assoc($result)) {
										echo '<tr>
												<td>'.$row['idPatients'].'</td>
												<td>'.$row['petName'].'</td>
												<td>'.$row['clientName'].'</td>';
										if($row['receiptGenerated']=="no") {
											echo	'<td>
													<form action="'.htmlspecialchars($_SERVER['PHP_SELF']).'" method="get">
													<input type="hidden" name="petName" value="'.$row['petName'].'">
													<input type="hidden" name="idPatients" value="'.$row['idPatients'].'">
													<input type="hidden" name="clientName" value="'.$row['clientName'].'">
													<button type="submit name="generate-receipt" value="yes">Generate Receipt</button>
													</form>
												</td>';
										}
										else {
											echo	'<td>
													<form action="'.htmlspecialchars($_SERVER['PHP_SELF']).'" method="get">
													<input type="hidden" name="petName" value="'.$row['petName'].'">
													<input type="hidden" name="idPatients" value="'.$row['idPatients'].'">
													<input type="hidden" name="clientName" value="'.$row['clientName'].'">
													<button style="background-color:#7E2573" type="submit" name="print-receipt" value="now">Print Receipt</button>
													</form>
												</td>';
										}
										echo '</tr>
										';
									}
								echo '</table>';
								echo '<a href="../header.php"><button type="button" class="back-to-menu">Back to menu</button></a>';
							}
							else {
								
								echo '<h3>There are no animals registered within the system!</h3>';
							}
						}
						else {
							$petName = $_GET['petName'];
							$idPatients = $_GET['idPatients'];
							$clientName = $_GET['clientName'];
							//set default value to 0 later
							echo '<h2 class="login-form-header">Please enter the billing form</h2>';
							echo '<form action="'.htmlspecialchars($_SERVER['PHP_SELF']).'" method="post">
								<h3>Consultation Fee: RM</h3>
								<input type="number" name="consultationFee" step="0.01">
								<h3>Medication: RM</h3>
								<input type="number" name="medication" step="0.01">
								<h3>Surgery: RM</h3>
								<input type="number" name="surgery" step="0.01">
								<h3>Take Home Medicine: RM</h3>
								<input type="number" name="takeHomeMedicine" step="0.01">
								<h3>Others: RM</h3>
								<input type="number" step="0.01" name="others">
								<input type="hidden" name="petName" value="'.$petName.'">
								<input type="hidden" name="idPatients" value="'.$idPatients.'">
								<input type="hidden" name="clientName" value="'.$clientName.'">
								<button type="submit" name="go-generate-receipt" value="now">Generate Receipt</button>
							</form>';
						}
							
					?>
			
			</div>
		</div>
	</body>
</html>