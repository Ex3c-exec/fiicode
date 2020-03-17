<?php
	
  if ($_SERVER["REQUEST_METHOD"] == "POST") 
  {
  
	  if (empty($_POST["first_name"])) 
	  {
	  	$firstNameErr = "Name is required";
	  }
	  else 
	  {
	    $firstname = test_input($_POST["first_name"]);
	    // verifica nume
	    
	    if (!preg_match("/^[a-zA-Z ]*$/",$firstname)) 
	    {
	      $firstNameErr = "Only letters and white space allowed";
	    }
	  }


	  
	  if (empty($_POST["last_name"])) 
	  {
	    $lastNameErr = "Name is required";
	  }
	 else 
	 {
	    $lastname = test_input($_POST["last_name"]);
	    // verifica nume
	    if (!preg_match("/^[a-zA-Z ]*$/",$lastname)) 
	    {
	      $lastNameErr = "Only letters and white space allowed";
	    }
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



	    
	  if (empty($_POST["address"])) 
	  {
	    $addressErr = "Address is required";
	  }

	  else 
	  {
	    $address = test_input($_POST["address"]);
	  }


	  if(empty($_POST['password']))
	  {
	  	$passwordErr = "Password not introduced";
	  }
	  else
	  {
	  	$password_user = $_POST['password'];
	  }

	  if(empty($_POST["password_rpt"]))
	  {
	  	$passwordErr_rpt = "Password_rpt not introduced";
	  }
	  else
	  {
	  	$password_rpt = $_POST['password_rpt'];
	  	if($password_rpt !== $password_user)
	  	{
	  		$passwordErr_rpt = "Passwords don't match";
	  	}

	  }
  


  }


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


?>