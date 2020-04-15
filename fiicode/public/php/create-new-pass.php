<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../css/auth.css" />
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
	<title>Password reset</title>
</head>
<body>
	
<div class="main">
	

	<?php 

		$selector = $_GET["selector"];
		$validator = $_GET["validator"];


		if(empty($selector) || empty($validator))
		{
			header("Location: ../auth.php");
		}
		else
		{
			if(ctype_xdigit($selector) !== false && ctype_xdigit($validator))
			{

				?>

				<form id="passRes" action="confirm-reset.php" method ="POST">
					
					<input type="hidden" name="selector" value ="<?php echo $selector ?>">

					<input type="hidden" name="validator" value ="<?php echo $validator ?>">

					<input id="pass1" type="password" name="pass" placeholder="Enter a New Password" required>

					<input id="pass2" type="password" name="pass-rpt" placeholder="Repeat New Password" required>

					<button type="submit" name= "submit">Reset Password</button>

				</form>

				<?php

			}
		}


	?>


</div>

<script>

document.getElementById('passRes').addEventListener("submit", (e)=>{
	const pass1 = document.getElementById("pass1").value;
	const pass2 = document.getElementById("pass2").value;
	if(pass2 != pass1)
	{
		e.preventDefault();
		Swal.fire({
                    icon: 'Error',
                    text: `Passwords doesn't match.`,
                    confirmButtonColor: '#643754'
                  })
	}
})

</script>
</body>
</html>

