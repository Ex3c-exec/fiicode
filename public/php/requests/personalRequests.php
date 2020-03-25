<?php

if(isset($_GET['PERS_REQUESTS']) && !empty($_GET['email'])){
	include '../connect.php';

    $email = $_GET['email'];
	$sql = "SELECT request.book,request.termen,request.status,request.date FROM request WHERE email='$email' ORDER BY request.date DESC";

		$rezultat = mysqli_query($conn, $sql);
		$rezultatLocal  = mysqli_fetch_all($rezultat, MYSQLI_ASSOC);
		echo json_encode($rezultatLocal);
	}
	else
	{
		$error = array("eroare" => "Eroare la trimiterea parametrilor");
		echo JSON_encode($error);
	}

