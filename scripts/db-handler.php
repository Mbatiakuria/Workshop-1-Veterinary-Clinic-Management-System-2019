<?php
	$servername = 'localhost';
	$dbUsername = 'root';
	$dbPassword = '';
	$dbName = 'vcmsdatabase1';
	
	$conn = mysqli_connect($servername,$dbUsername,$dbPassword,$dbName);
	
	if(!$conn) {
		die("Connection:failed".mysqli_connect_error());
	}
	
	
	function isClient() {
		if(isset($_SESSION['userId'])&&$_SESSION['userType']=='client') {
			return true;
		}
		else {
			return false;
		}
	}
	
	function isAdmin() {
		if(isset($_SESSION['userId'])&&$_SESSION['userType']=='admin') {
			return true;
		}
		else {
			return false;
		}
	}
	
	function isClerk() {
		if(isset($_SESSION['userId'])&&$_SESSION['userType']=='clerk') {
			return true;
		}
		else {
			return false;
		}
	}
	
	function isDoctor() {
		if(isset($_SESSION['userId'])&&$_SESSION['userType']=='doctor') {
			return true;
		}
		else {
			return false;
		}
	}