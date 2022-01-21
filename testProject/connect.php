<?php
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$userName = $_POST['userName'];
	$gender = $_POST['gender'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$number = $_POST['number'];

	// Database connection
	$conn = new mysqli('localhost','root','','nmureport');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		$stmt = $conn->prepare("insert into registration(firstName, lastName, userName, gender, email, password, number) values(?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("ssssssi", $firstName, $lastName, $userName, $gender, $email, $password, $number);
		$execval = $stmt->execute();
		
		$myfile = fopen("index.html", "r") or die("Unable to open file!");
		echo fread($myfile,filesize("index.html"));
		fclose($myfile);

		$stmt->close();
		$conn->close();
	}
?>