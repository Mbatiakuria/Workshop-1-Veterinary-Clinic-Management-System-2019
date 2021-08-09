<?php
	session_start();
	if(isset($_GET['error'])&&$_GET['error']=="you-must-login-first") {
		echo '<script>alert("You are not authorized to access that page. Please login as the respective user role.");window.location.href="'.htmlspecialchars($_SERVER['PHP_SELF']).'";</script>';
	}
	else if(isset($_GET['error'])&&$_GET['error']=="wrongpwd") {
		echo '<script>alert("Sorry, the password you entered is incorrect. Please try again.");window.location.href="'.htmlspecialchars($_SERVER['PHP_SELF']).'";</script>';
	}
	else if(isset ($_GET['error'])&&$_GET['error']=="nousername") {
		echo '<script>alert("Sorry, that username is not recognized. Please register an account if you have not done so.");window.location.href="'.htmlspecialchars($_SERVER['PHP_SELF']).'";</script>';
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="style.css">
		<title>Veterinary Clinic Management System</title>
	</head>
	<body>
		<div class="my-header">
			<ul>
				<li><a class="logo" href="header.php">VCMS</a></li>
				<li><a class="header-menu-item" href="aboutUs.php">About us</a> </li>
			</ul>
		</div>
		<div class="my-background">
			
			<div class="bg-left-blur">
				<!-- Background image 1 -->
			</div>
			<div class="bg-right-blur">
				<!-- Background image 2 -->
			</div>
			<div class="login-form" style="min-height:500px">
				<?php
					if(isset($_SESSION['userId'])&&$_SESSION['userType']=='admin') {
						echo '<h2 class="login-form-header">Welcome, Admin.</h2>';
						echo '<a href="features/adminFeature1.php"><button type="button">Manage User Accounts</button></a>';
						echo '<br><a href="features/adminFeature2.php"><button type="button">View User Accounts</button></a>';
						echo '<br><a href="statistictry.php"><button type="button">View User Statistics</button></a>';
						echo '<form action="scripts/logout-script.php" method="post">
								<button type="submit" name="logout-submit">Logout</button>
							</form>';
					}
					else if(isset($_SESSION['userId'])&&$_SESSION['userType']=='doctor') {
						echo '<h2 class="login-form-header">Welcome, Doctor.</h2>';
						echo '<br><a href="features/doctorVisitsJournalMenu.php"><button type="button">Open Visits Journal</button></a>';
						echo '<a href="features/doctorDoseCalculationMenu.php"><button type="button">Manage Dose Calculations</button></a>';
						echo '<form action="scripts/logout-script.php" method="post">
								<button type="submit" name="logout-submit" style="margin-bottom:20px">Logout</button>
							</form>';
					}
					else if(isset($_SESSION['userId'])&&$_SESSION['userType']=='clerk') {
						echo '<h2 class="login-form-header">Welcome, Clerk.</h2>';
						echo '<a href="features/clerkViewPatientCharts.php"><button type="button">View Patient Information</button></a>';
						echo '<br><a href="features/clerkManageBillingInformation.php"><button type="button">Manage Billing Information</button></a>';
						echo '<br><a href="features/clerkViewAnimalInformation.php"><button type="button">View Animal Information</button></a>';
						echo '<form action="scripts/logout-script.php" method="post">
								<button type="submit" name="logout-submit" style="margin-bottom:20px">Logout</button>
							</form>';
					}
					else if(isset($_SESSION['userId'])&&$_SESSION['userType']=='client') {
						echo '<h2 class="login-form-header">Welcome, Client.</h2>';
						echo '<br><a href="features/clientViewAnimalStatus.php"><button type="button">View Animal Status</button></a>';
						echo '<form action="scripts/logout-script.php" method="post">
								<button type="submit" name="logout-submit">Logout</button>
							</form>';
					}
					else
						echo '<form action="scripts/login-script.php" method="post">
					<h2 class="login-form-header">Login</h2>
					<input type="text" name="username" placeholder="username" required> <br>
					<input type="password" name="password" placeholder="password" required> <br>
					<button type="submit" name="login-submit">Login</button>
				</form>
				<p>Don\'t have an account? <a href="signup.php">Sign up.</a></p>';
				?>
			</div>
		</div>
	</body>
</html>
