<?php
	
		session_start();

		if(isset($_GET['ACCOUNT_REQUEST']) && isset($_SESSION['first']) )
		{
		
			//print_r($_SESSION);

			$first = $_SESSION['first'];
			$last = $_SESSION['last'];
			$email = $_SESSION['email'];
			$addr = $_SESSION['address'];
			
			$arr = array("first" => $first, "last" => $last, "email" => $email, "address" => $addr);

			echo json_encode($arr);

		}
		else
		{
			$err = array("eroare" => "eroare cont request");
			echo json_encode($err);
		}

	

