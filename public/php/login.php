<?php 
	
	include "connect.php";

	echo 'Login<pre>';
    print_r($_POST);
    echo '</pre>';


	$firstname = $lastname = $password_user = $email = $address = "";
 	$firstNameErr = $lastNameErr = $emailErr = $addressErr = $passwordErr =  "";
 	$error = "";

 	//functie testare date primite de la form
 	include "testDate.php";


 	setcookie("email",$email,time() + (86400 * 30),'/');


    $sql = "SELECT * FROM user WHERE email='$email' AND password ='$password_user';";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);


	if($resultCheck > 0)
	{
		echo "conectat";
	}
	else
	{
		$sql = "SELECT * FROM user WHERE email='$email'";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		if($resultCheck > 0)
		{
			header("Location: ../auth.php?error=2");
		}
		else
		{
			header("Location: ../auth.php?error=1");
		}
	}



?>