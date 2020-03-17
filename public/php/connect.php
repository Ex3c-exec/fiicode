<?php

	$conn = mysqli_connect('localhost','root','');

 	if(!$conn)
	{
		echo "Not";
 	}

 	if(!mysqli_select_db($conn,"fiicode"))
 	{
 		echo "database not  selected";
 	}
	
?>