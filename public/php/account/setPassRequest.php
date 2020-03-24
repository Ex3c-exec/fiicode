<?php

session_start();

if(isset($_POST["SET_PASS"]) && !empty($_POST['pass'])  && $_SESSION['email'] )
{
	include '../connect.php';

	
	$pass = $_POST['pass'];
	$email = $_SESSION['email'];
	$pass = password_hash($pass, PASSWORD_DEFAULT);

	$sql = "UPDATE user SET password='$pass' WHERE email='$email'";

	if ($conn->query($sql) === TRUE) {
	    $success = array("success" => "success set pass");
		echo JSON_encode($success);
	} else {
	    $error = array("eroare" => "eroare set pass");
		echo JSON_encode($error);
	}


}
else
	{
		$error = array("eroare" => "eroare set pass");
		echo JSON_encode($error);
	}
