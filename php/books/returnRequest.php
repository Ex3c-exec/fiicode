<?php

if(isset($_GET['ALL_BOOKS']))
{
	include '../connect.php';

	$sql = "SELECT * FROM carti ORDER BY likes DESC";


	$rezultat = mysqli_query($conn, $sql);
	$rezultatCautare  = mysqli_fetch_all($rezultat, MYSQLI_ASSOC);
	echo JSON_encode($rezultatCautare);

}
else
{
	$error = array("eroare" => "Eroare All Books");
	echo JSON_encode($error);
}

