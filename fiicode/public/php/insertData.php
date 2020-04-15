<?php


 	$sql = "INSERT INTO user (first_name,last_name,email,address,password) VALUES (?,?,?,?,?)";
 	$stmt = mysqli_stmt_init($conn);
 	if(!mysqli_stmt_prepare($stmt,$sql))
 	{
 		header("Location: ../auth.php?error=sqlError");
 	}
 	else
 	{
 		$passwordHash = password_hash($password_user, PASSWORD_DEFAULT);
 		mysqli_stmt_bind_param($stmt, "sssss" , $firstname,$lastname,$email,$address,$passwordHash);
 		mysqli_stmt_execute($stmt);
 		mysqli_stmt_store_result($stmt);
 		
 		header("Location: ../auth.php?#login");
 		
 	}

 	

?>