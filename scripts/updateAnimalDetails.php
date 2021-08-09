<?php
	include "db-handler.php";
	
	//Fetch the information from the form and put them inside the coressponding variables.
	$idAnimals = $_POST['idAnimals'];
	$species = $_POST['species'];
	$breed = $_POST['breed'];
	$sex = $_POST['sex'];
	$color = $_POST['color'];
	$weight = $_POST['weight'];
	$age = $_POST['age'];
	$imageToUpload = $_FILES['imageToUpload'];
	
	//Handling the file upload.
	$targetDirectory = "../uploads/";
	$targetFile = $targetDirectory . basename($_FILES['imageToUpload']["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));
	
	//Now to check if the image uploaded is actually an image.
	$check = getimagesize($_FILES["imageToUpload"]["tmp_name"]);
	if($check!==false) {
		$uploadOk = 1;
		$imagePath = $targetFile;
		echo "Hooray!"; //Debug purposes.
		if(move_uploaded_file($_FILES["imageToUpload"]["tmp_name"], $imagePath)) {
			echo "The file ".basename($_FILES["imageToUpload"]["name"])." has been uploaded."; //The file is uploaded. Implement error checking later.
		}
	}
	else {
		header("Location:../features/clerkAddNewAnimal.php?error=filetypenotrecognized");
		exit();
	}
	
	
	$sql = "UPDATE animal SET species=?, breed=?, sex=?, color=?, weight=?, age=?, imagePath=? WHERE idAnimals=?";
	$stmt=mysqli_stmt_init($conn);
	mysqli_stmt_prepare($stmt,$sql);
	mysqli_stmt_bind_param($stmt, "ssssdisi", $species, $breed, $sex, $color, $weight, $age, $imagePath, $idAnimals);
	mysqli_stmt_execute($stmt);
	
	header("Location:../header.php?update-animal=successful");
	exit();
	