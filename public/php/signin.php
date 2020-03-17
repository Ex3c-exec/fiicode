<?php
	
	//stabileste conexiunea la server
	//$conn - variabla server
	//$sql - variabila pentru comenzi sql
	include "connect.php";


	echo 'Login<pre>';
    print_r($_POST);
    echo '</pre>';


	$firstname = $lastname = $password_user = $email = $address = "";
 	$firstNameErr = $lastNameErr = $emailErr = $addressErr = $passwordErr =  "";
 	$error = "";


 	//functie testare date primite de la form
 	include "testDate.php";


 	//cauta in baza de date prezenta contului
 	//in caz ca nu exista il adauga in baza de date
 	//$result - variabila in care se memoreaza rezultatul unui query
 	//$resultCheck - variabila ce contorizeaza prezenta email-ului in baza de date
 	//
 	include "dbSearch.php";


 	

?>