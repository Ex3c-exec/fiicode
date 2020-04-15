<?php

	if(isset($_POST['submit']) )
	{
		$selector = $_POST['selector'];
		$validator = $_POST['validator'];
		$password = $_POST['pass'];
		$passwordRepeat = $_POST['pass-rpt'];

		if(empty($password) || empty($passwordRepeat))
		{
			header("Location: ../auth.php");
		}
		else if($password != $passwordRepeat)
		{
			header("Location: ../auth.php");	
		}


		$currentDate = date("U");

		include "connect.php";

		$sql = "SELECT * FROM password_reset WHERE selector =? AND expire >= ?";

		$stmt = mysqli_stmt_init($conn);

		if(!mysqli_stmt_prepare($stmt,$sql))
		{
			header("Location: ../auth.php");
		}
		else
		{

			mysqli_stmt_bind_param($stmt, "ss" , $selector,$currentDate);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			if(!$row = mysqli_fetch_assoc($result))
			{
				//resubmit
				header("Location: ../auth.php");
			}
			else
			{
				$token = hex2bin($validator);
				$tokenCheck = password_verify($token,$row['token']);

				if($tokenCheck === false)
				{

				}
				else if($tokenCheck == true)
				{
					$tokenEmail = $row["email"];

					$sql = "SELECT * FROM user WHERE email =?";

					$stmt = mysqli_stmt_init($conn);

					if(!mysqli_stmt_prepare($stmt,$sql))
					{
						header("Location: ../auth.php");
					}
					else
				    {
				    	mysqli_stmt_bind_param($stmt, "s",$tokenEmail);
				    	mysqli_stmt_execute($stmt);

				    	$result = mysqli_stmt_get_result($stmt);
						if(!$row = mysqli_fetch_assoc($result))
						{
							//resubmit
							header("Location: ../auth.php");
						}
						else
						{
							$sql = "UPDATE user SET password =? WHERE email =?";

							$stmt = mysqli_stmt_init($conn);

							if(!mysqli_stmt_prepare($stmt,$sql))
							{
								header("Location: ../auth.php");
							}
							else
						    {
						    	$hash = password_hash($password, PASSWORD_DEFAULT);

						    	mysqli_stmt_bind_param($stmt, "ss",$hash,$tokenEmail);
						    	mysqli_stmt_execute($stmt);


							$sql = "DELETE FROM password_reset  WHERE email =?";

							$stmt = mysqli_stmt_init($conn);

							if(!mysqli_stmt_prepare($stmt,$sql))
							{
								header("Location: ../auth.php");
							}
							else
						    {

						    	mysqli_stmt_bind_param($stmt, "s",$tokenEmail);
						    	mysqli_stmt_execute($stmt);
						    	header("Location: ../auth.php");

						    	
						    	
						    }

						    }


						}

					}


				}

			}
		}




	}
	else
	{
		header("Location: ../index.php");
	}


?>