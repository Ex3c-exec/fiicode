<?php 
	

	function test_input($data) {
		  $data = trim($data);
		  $data = stripslashes($data);
		  $data = htmlspecialchars($data);
		  return $data;
		}

	if(isset($_POST['submit']))
	{

		include "connect.php";

		$password_user = $email = "";
	 	$emailErr = $passwordErr =  "";


	 	if(empty($_POST['password']))
		  {
		  	$passwordErr = "Password not introduced";
		  }
		  else
		  {
		  	$password_user = $_POST['password'];
		  }

		if (empty($_POST["email"])) 
		  {
		    $emailErr = "Email is required";
		  } 
		  else 
		  {
		    $email = test_input($_POST["email"]);
		    //verifica email
		    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
		    {
		      $emailErr = "Invalid email format";
		    }
		  }




	    $sql = "SELECT * FROM user WHERE email=?";

	    $stmt = mysqli_stmt_init($conn);
	    if(!mysqli_stmt_prepare($stmt,$sql))
	    {

	    }
	    else
	    {
	    	mysqli_stmt_bind_param($stmt, "s" , $email);
	    	mysqli_stmt_execute($stmt);
	    	$results = mysqli_stmt_get_result($stmt);
	    	if($row = mysqli_fetch_assoc($results))
	    	{

	    		$passwordCheck = password_verify($password_user, $row['password']);

	    		if($passwordCheck == false)
	    		{
	    			echo "Wrong pass";
	    		}
	    		else if($passwordCheck == true)
	    		{
	    			session_start();
	    			$_SESSION['email'] = $row['email'];
	    			$_SESSION['first'] = $row['first_name'];
	    			$_SESSION['last'] = $row['last_name'];
	    			$_SESSION['address'] = $row['address'];

	    			header("Location: ../index.php?succes=true");

	    		}
	    		else
	    		{
	    			echo "Eroare";
	    		}
	    	}
	    	else
	    	{
	    		echo "No user"; 
	    	}
	    }

		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($results);

	}
	else
	{

	}
	


?>

