<?php


	if(isset($_GET['LIKE_REQUEST']) && isset($_SESSION['id']) )
	{
		include '../connect.php';

		$id = $_SESSION['id'];

		$sql = "SELECT * FROM likes WHERE userid = '$id' ";


		$rezultat = mysqli_query($conn, $sql);
		$rezultatCautare  = mysqli_fetch_all($rezultat, MYSQLI_ASSOC);
		echo JSON_encode($rezultatCautare);
		

	}
	else
	{
		$error = array("eroare" => "eroare like");
		echo JSON_encode($error);
	}



?>