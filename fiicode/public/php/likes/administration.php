<?php

session_start();
	if(isset($_POST['bookid']) && isset($_SESSION['id'])  )
	{

		$iduser = $_SESSION['id'];
		$idbook = $_POST['bookid'];

		include "../connect.php";

		$sql = "SELECT * FROM likes WHERE userid=? AND bookid=?";

	    $stmt = mysqli_stmt_init($conn);
	    if(!mysqli_stmt_prepare($stmt,$sql))
	    {
	    	$err = array("eroare" => "eroare baza de data 1");
	    	echo json_encode($err);
	    }
	    else
	    {

	    	mysqli_stmt_bind_param($stmt, "ii" , $iduser,$idbook);
	    	mysqli_stmt_execute($stmt);
	    	$results = mysqli_stmt_get_result($stmt);

	    	if($row = mysqli_fetch_assoc($results))
	    	{
				//sterge
				$sql = "DELETE FROM likes WHERE userid=? AND bookid=?";

			 	$stmt = mysqli_stmt_init($conn);

			 	$ok1 = 0;
			 	$ok2 = 0;

			 	if(!mysqli_stmt_prepare($stmt,$sql))
			 	{

			 		$error = array("eroare" => "eroare baza de date 2");
					echo JSON_encode($error);
			 	}
			 	else
			 	{
			 		mysqli_stmt_bind_param($stmt, "ii" , $iduser, $idbook);
			 		mysqli_stmt_execute($stmt);
			 		mysqli_stmt_store_result($stmt);
			 		$ok1 = 1;
			 	}

			 	//unlike

	    		$sql = "UPDATE carti SET likes=likes - 1 WHERE id='$idbook'";

	    		if ($conn->query($sql) === TRUE)
	    		{
	    			$ok2 = 1;
				}
				else 
				{
			    	$error = array("eroare" => "eroare unlike");
					echo JSON_encode($error);
				}

				if($ok1 == 1 && $ok2 == 1)
				{
					$success = array("success" => "success unlike/delete");
					echo JSON_encode($success);
				}
	    	}
	    	else
	    	{
//adauga
				$ok1 = 0;
			 	$ok2 = 0;

				$sql = "INSERT INTO likes (userid,bookid) VALUES (?,?)";
			 	$stmt = mysqli_stmt_init($conn);
			 	if(!mysqli_stmt_prepare($stmt,$sql))
			 	{
			 		$error = array("eroare" => "eroare baza de date 3");
					echo JSON_encode($error);
			 	}
			 	else
			 	{
			 		mysqli_stmt_bind_param($stmt, "ii" , $iduser, $idbook);
			 		mysqli_stmt_execute($stmt);
			 		mysqli_stmt_store_result($stmt);
			 		$ok1 = 1;
			 		
			 	}
	    		$sql = "UPDATE carti SET likes=likes + 1 WHERE id='$idbook'";

	    		if ($conn->query($sql) === TRUE)
	    		{
			    	$ok2 = 1;
				}
				else {
			    	$error = array("eroare" => "eroare like");
					echo JSON_encode($error);
				}
				if($ok1 == 1 && $ok2 == 1)
				{
					$success = array("success" => "success like/adauga");
					echo JSON_encode($success);
				}
	    	}
	    }
	}
	else
	{
			$error = array("eroare" => "setare parametri");
			echo JSON_encode($error);
	}
?>