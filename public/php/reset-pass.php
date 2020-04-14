<?php

if(isset($_POST['submit']))
{

	$selector = bin2hex(random_bytes(8));
	$token = random_bytes(32);


	$url = "http://localhost/fiicode-tertial/public/php/create-new-pass.php?selector=" . $selector . "&validator=" . bin2hex($token);

	$expires = date("U") + 1800;

	include 'connect.php';

	$userEmail = $_POST['email'];

	$sql = "DELETE FROM password_reset WHERE email=?";

	$stmt = mysqli_stmt_init($conn);

	if(!mysqli_stmt_prepare($stmt,$sql))
	{
		echo 1;
		//header("Location: ../auth.php");
	}
	else
	{

		mysqli_stmt_bind_param($stmt, "s" , $userEmail);
		mysqli_stmt_execute($stmt);

	}

	$sql = "INSERT INTO password_reset (email,selector,token,expire) VALUES (?,?,?,?)";


	$stmt = mysqli_stmt_init($conn);

	if(!mysqli_stmt_prepare($stmt,$sql))
	{
		echo 1;
		//header("Location: ./auth.php");
	}
	else
	{

		$hashToken = password_hash($token,PASSWORD_DEFAULT);
		mysqli_stmt_bind_param($stmt, "ssss" , $userEmail,$selector,$hashToken,$expires);
		mysqli_stmt_execute($stmt);

	
		mysqli_stmt_close($stmt);
		mysqli_close($conn);


		// $to = $userEmail;

		// $subject = "Reset your password";

		// $message = "<p>Link to reset your password:</p>" . "<br>";
		// $message .= '<p><a href="' . $url . '">' . $url . '</a></p>'; 

		// $headers = "From: FiiCode <fiicodebooksemail@gmail.com\r\n>";
		// $headers .= "Reply-to: fiicodebooksemail@gmail.com\r\n";
		// $headers .= "Content-type: text/html\r\n";

		require '../phpmailer/PHPMailerAutoload.php';
        $mail = new PHPMailer;
        $mail->isSMTP(); 
        $mail->SMTPDebug = 0; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
        $mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
        $mail->Port = 587; // TLS only
        $mail->SMTPSecure = 'tls'; // ssl is deprecated
        $mail->SMTPAuth = true;
        $mail->Username = 'fiicodebooksemail@gmail.com'; // email
        $mail->Password = 'fiicodeemail'; // password
        $mail->setFrom("fiicodebooksemail@gmail.com", "FiiCode"); // From email and name
        $mail->addAddress( $userEmail, 'FiiCode'); // to email and name
        $mail->Subject = 'Contact@Form';
        $mail->msgHTML("<p><a href=" . $url . ">" . $url . "</a></p>");//$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
        $mail->AltBody = 'HTML messaging not supported'; // If html emails is not supported by the receiver, show this body
        // $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file
        $mail->SMTPOptions = array(
                            'ssl' => array(
                                'verify_peer' => false,
                                'verify_peer_name' => false,
                                'allow_self_signed' => true
                            )
                        );
        if(!$mail->send()){
            //echo "Mailer Error: " . $mail->ErrorInfo;
        }else{
            //echo "Message sent!";
        }
        

		//header("Location: ../auth.php?reset=success");

	}

}
else
{
	//header("Location: ../auth.php");
}


?>