<?php
	
	session_start();
	if(isset($_POST['CREATE_REQUEST']) && !empty($_POST['term']) && !empty($_POST['phone']) && !empty($_POST['book']) /* && isset($_SESSION['email']) */ )
	{
		$term = $_POST['term'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$book = $_POST['book'];

		include '../connect.php';

		$sql = "INSERT INTO request (phone,book,termen,email) VALUES (?,?,?,?,?)";
	 	$stmt = mysqli_stmt_init($conn);
	 	if(!mysqli_stmt_prepare($stmt,$sql))
	 	{
	 		$error = array("eroare" => "Eroare creare");
			echo JSON_encode($error);
	 	}
	 	else
	 	{
	 		$status = 0;
	 		
	 		mysqli_stmt_bind_param($stmt, "isisi" , $phone,$book,$term,$email,$status);
	 		mysqli_stmt_execute($stmt);
	 		mysqli_stmt_store_result($stmt);
	 		$succ = array("success" => "Succes creare request");
			echo JSON_encode($succ);
	 		
	 	}


	}


?>