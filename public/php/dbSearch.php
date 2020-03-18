<?php

	$sql = "SELECT * FROM user WHERE email=?;";
	$stmt = mysqli_stmt_init($conn);

	//$result = mysqli_query($conn, $sql);
	//$resultCheck = mysqli_num_rows($result);

	if(!mysqli_stmt_prepare($stmt,$sql))
	{
		header("Location: ../auth.php?error=sqlError");
	}
	else
	{
		mysqli_stmt_bind_param($stmt, "s" , $email);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_store_result($stmt);
		$resultCheck = mysqli_stmt_num_rows($stmt);
		if($resultCheck > 0)
		{
			header("Location: ../auth.php?error=emailTaken&first=".$firstname."&last=".$lastname."&address=".$address."#register");

		}
		else
		{
			include "insertData.php";
			mysqli_stmt_close($stmt);
		}
	}

	


?>