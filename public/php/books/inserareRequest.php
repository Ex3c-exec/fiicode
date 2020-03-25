<?php
	session_start();
	include '../connect.php';

	//if($_SESSION['admin'] == 1)
		//echo 1;

	if(!empty($_POST['title']) && !empty($_POST['author']) && !empty($_POST['description']) && !empty($_POST['img']) && isset($_POST['ADD_BOOK']) &&  isset($_SESSION['admin']) && $_SESSION['admin'] == 1  )
	{

		$author = $_POST['author'];
		$title = $_POST['title'];
		$description = $_POST['description'];
		$img = $_POST['img'];
		$val = "1";

		$sql = "INSERT INTO carti (author,title,img,description,available) VALUES (?,?,?,?,?)";
	 	$stmt = mysqli_stmt_init($conn);
	 	if(!mysqli_stmt_prepare($stmt,$sql))
	 	{
	 		$error = array("eroare" => "Eroare baza de date");
			echo JSON_encode($error);
	 	}
	 	else
	 	{
	 		mysqli_stmt_bind_param($stmt, "sssss" , $author,$title,$img,$description,$val);
	 		mysqli_stmt_execute($stmt);
	 		mysqli_stmt_store_result($stmt);
	 		
	 		$success = array("success" => "carte introdusa");
			echo JSON_encode($success);
	 		
	 	}


	}
	else
	{
		$error = array("eroare" => "Eroare Add Book");
		echo JSON_encode($error);
	}

?>