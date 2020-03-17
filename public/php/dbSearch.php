<?php

	$sql = "SELECT * FROM user WHERE email='$email';";
	$result = mysqli_query($conn, $sql);

	$resultCheck = mysqli_num_rows($result);

	if($resultCheck > 0)
	{
		$error = "Already used email";
		echo "Deja exista email"; 
	}
	else
	{
		include "insertData.php";
	}


?>