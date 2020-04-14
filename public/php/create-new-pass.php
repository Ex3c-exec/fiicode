

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

				<form action="confirm-reset.php" method ="POST">
					
					<input type="hidden" name="selector" value ="<?php echo $selector ?>">

					<input type="hidden" name="validator" value ="<?php echo $validator ?>">

					<input type="password" name="pass" placeholder="Enter a New Password">

					<input type="password" name="pass-rpt" placeholder="Repeat New Password">

					<button type="submit" name= "submit">Reset Password</button>

				</form>

				<?php

			}
		}


	?>


</div>