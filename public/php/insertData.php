<?php

	$con = mysqli_connect('localhost','root','');

 	if(!$con)
	{
		echo "Not";
 	}

 	if(!mysqli_select_db($con,"fiicode"))
 	{
 		echo "database not  selected";
 	}

 	$sql = "INSERT INTO user (first_name,last_name,email,address,password) VALUES ('$firstname','$lastname','$email','$address','$password_user')";

 	if(!mysqli_query($con,$sql))
 	{
 		echo "Not inserted";
 	}
 	else
 	{
 		echo "Inserted data";
 	}

?>