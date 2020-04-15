<?php

session_start();
if(isset($_POST['UPDATE_BOOK'])  && !empty($_POST['title'])  && !empty($_POST['author'])  && !empty($_POST['description'])  && isset($_POST['available'])  && !empty($_POST['img']) && !empty($_POST['id'])  &&   isset($_SESSION['admin']) && $_SESSION['admin'] == 1 )
{
	include '../connect.php';

	$id = $_POST['id'];
	$title = $_POST['title'];
	$author = $_POST['author'];
	$description = $_POST['description'];
	$available = $_POST['available'];
	$img = $_POST['img'];

	$sql = "UPDATE carti SET title='$title',author='$author',description='$description',available='$available',img='$img' WHERE id='$id'";

	if ($conn->query($sql) === TRUE) {
	    $success = array("success" => "Success Update Book");
		echo JSON_encode($success);
	} else {
	    $error = array("eroare" => "Eroare Update Book");
		echo JSON_encode($error);
	}


}
else
	{
		$error = array("eroare" => "Eroare Update Book");
		echo JSON_encode($error);
	}
