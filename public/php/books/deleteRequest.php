<?php

	session_start();
	
	if(isset($_POST['DELETE_BOOK']) && !empty($_POST['id']) && isset($_SESSION['admin']) && $_SESSION['admin'] == 1)
	{

		include '../connect.php';

		$id = $_POST['id'];

		$sql = "DELETE FROM carti WHERE id=$id";

		if (mysqli_query($conn, $sql)) {
		    $success = array("success" => "carte stearsa");
			echo JSON_encode($success);
		} else {

			$error = array("eroare" => "Eroare stergere");
			echo JSON_encode($error);
		    
		}

		//DELETE FROM table_name WHERE condition;

	}
	else
	{
		$error = array("eroare" => "Eroare stergere");
		echo JSON_encode($error);
	}

?>