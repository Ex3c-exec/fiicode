<?php
	
	if(isset($_POST['CREATE_REQUEST']) && !empty($_POST['phone']) && !empty($_POST['book']) && !empty($_POST['email']) )
	{
		$term = $_POST['term'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$book = $_POST['book'];

		include '../connect.php';

		$sql = "INSERT INTO request (phone,book,termen,email) VALUES (?,?,?,?)";
	 	$stmt = mysqli_stmt_init($conn);
	 	if(!mysqli_stmt_prepare($stmt,$sql))
	 	{
	 		$error = array("eroare" => "Eroare creare request la introducerea in baza de date");
			echo JSON_encode($error);
	 	}
	 	else
	 	{
	 		
	 		mysqli_stmt_bind_param($stmt, "ssss" , $phone,$book,$term,$email);
	 		mysqli_stmt_execute($stmt);
	 		mysqli_stmt_store_result($stmt);
	 		$succ = array("success" => "Succes creare request");
			echo JSON_encode($succ);
	 		
	 	}


	}
	else {
		$error = array("eroare" => "Eroare creare request la trimiterea parametrilor");
			echo JSON_encode($error);
	}


?>