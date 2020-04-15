<?php
		
	session_start();
	if(isset($_POST["CHECK_PASS"]) && !empty($_POST['pass']) && $_SESSION['email'] )
	{
		include "../connect.php";

		
		$password_user = $_POST['pass'];
		$email = $_SESSION['email'];

		$sql = "SELECT * FROM user WHERE email=?";

	    $stmt = mysqli_stmt_init($conn);
	    if(!mysqli_stmt_prepare($stmt,$sql))
	    {
	    	$err = array("eroare" => "eroare check pass server");
	    	echo json_encode($err);
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
	    			$err = array("eroare" => "nu corespund");
	    		   echo json_encode($err);
	    		}
	    		else if($passwordCheck == true)
	    		{	
	    			$succ = array("success" => "corespund");
				    echo json_encode($succ);
	    		}
	    		else
	    		{
	    			$err = array("eroare" => "nu corespund");
	    			echo json_encode($err);
	    		}
	    	}
	    	
	    }

		

	}
	else
	{
		$err = array("eroare" => "eroare check pass");
	    echo json_encode( $err);
	}

?>