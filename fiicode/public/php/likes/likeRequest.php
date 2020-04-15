<?php

session_start();
	if(isset($_SESSION['id']) )
	{
		include '../connect.php';

		$id = $_SESSION['id'];

		$sql = "SELECT likes.bookid FROM likes WHERE userid = '$id' ";


		$rezultat = mysqli_query($conn, $sql);
		$rezultatCautare  = mysqli_fetch_all($rezultat, MYSQLI_ASSOC);
		echo JSON_encode($rezultatCautare);
		

	}
	else
	{
		$error = array("eroare" => "eroare la primirea likeurilor");
		echo JSON_encode($error);
	}



?>