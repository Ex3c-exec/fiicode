<?php
	
	
	
	if(isset($_POST['submit']))
	{

		//stabileste conexiunea la server
		//$conn - variabla server
		//$sql - variabila pentru comenzi sql
		include "connect.php";

		$firstname = $lastname = $password_user = $email = $address = $password_user_rpt =  "";
	 	$firstNameErr = $lastNameErr = $emailErr = $addressErr = $passwordErr =  $passwordErr_rpt = "";
	 	



	 	//functie testare date primite de la form
	 	include "testDate.php";




	 	if(!$firstNameErr && !$lastNameErr && !$emailErr && !$addressErr && !$passwordErr && !$error && !$passwordErr_rpt)
	 	{
			//cauta in baza de date prezenta contului
		 	//in caz ca nu exista il adauga in baza de date
		 	//$result - variabila in care se memoreaza rezultatul unui query
		 	//$resultCheck - variabila ce contorizeaza prezenta email-ului in baza de date
		 	//
		 	include "dbSearch.php";

	 	}
	 	else
	 	{

	 		if($firstNameErr == "Name is required" || $lastNameErr == "Name is required" || $emailErr == "Email is required" || $addressErr == "Address is required" || $passwordErr == "Password not introduced" || $passwordErr_rpt == "Password_rpt not introduced")
	 		{

	 			header("Location: ../auth.php?error=emptyfield1&first=".$firstname."&last=".$lastname."&mail=".$email."&address=".$address."#register");
	 		}

	 		if($passwordErr_rpt === "Passwords don't match")
	 		{
	 			
				header("Location: ../auth.php?error=passwordMatch&first=".$firstname."&last=".$lastname."&mail=".$email."&address=".$address."#register");	 	
			}
	 		
	 		if($emailErr == "Invalid email format")
	 		{
	 			header("Location: ../auth.php?error=emailFormat&first=".$firstname."&last=".$lastname."&address=".$address."#register");
	 		}
	 		
	 		if($lastNameErr == "Only letters and white space allowed" || $firstNameErr == "Only letters and white space allowed")
	 		{
	 			header("Location: ../auth.php?error=nameFormat&first=".$firstname."&last=".$lastname."&mail=".$email."&address=".$address."#register");
	 		}


	 	}

	 	
		mysqli_close($conn);
	 	

	}
	else
	{
		header("Location: ../auth.php");
	}





 	

?>