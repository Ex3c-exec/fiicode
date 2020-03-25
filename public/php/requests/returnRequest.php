<?php

if(isset($_GET['ALL_REQUESTS'])) {
	include '../connect.php';

	$sql = "SELECT user.first_name,user.last_name,user.email,user.address, request.phone,request.id,request.phone,request.book,request.termen,request.status,request.date FROM request
	 INNER JOIN user ON user.email = request.email ORDER BY request.date DESC";

		$rezultat = mysqli_query($conn, $sql);
		$rezultatLocal  = mysqli_fetch_all($rezultat, MYSQLI_ASSOC);
		echo json_encode($rezultatLocal);
	}
	else
	{
		$error = array("eroare" => "Eroare All Books");
		echo JSON_encode($error);
	}

