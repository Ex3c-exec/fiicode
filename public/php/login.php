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


	 	if (empty($_POST["email"])) 
		  {
		    $emailErr = "Email is required";
		    header("Location: ../auth.php?error=lemailReq");
		  } 
		  else 
		  {
		    $email = test_input($_POST["email"]);
		    //verifica email
		    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
		    {
		      $emailErr = "Invalid email format";
		      header("Location: ../auth.php?error=lemailFormat");
		    }
		  }

	 	if(empty($_POST['password']))
		  {
		  	$passwordErr = "Password not introduced";
		  	header("Location: ../auth.php?error=lnoPass&lemail=".$email."#login");
		  }
		  else
		  {
		  	$password_user = $_POST['password'];
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
	    			header("Location: ../auth.php?error=lwrongPass&lemail=".$email."#login");
	    		}
	    		else if($passwordCheck == true)
	    		{
	    			session_start();
	    			$_SESSION['email'] = $row['email'];
	    			$_SESSION['first'] = $row['first_name'];
	    			$_SESSION['last'] = $row['last_name'];
	    			$_SESSION['address'] = $row['address'];
	    			$_SESSION['admin'] = $row['admin'];
	    			$_SESSION['id'] = $row['ID'];

	    			if($_SESSION['admin'] == 1)
	    			{
	    				header("Location: ../dashboard-admin.php");
	    			}
	    			else
	    			{
	    				header("Location: ../dashboard.php");
	    			}

	    		}
	    		else
	    		{
	    			header("Location: ../index.php?");
	    		}
	    	}
	    	else
	    	{
	    		header("Location: ../auth.php?error=lnoUser");

	    	}
	    }

		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($results);

	}
	else
	{

	}
	


?>

