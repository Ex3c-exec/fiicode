<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/auth.css" />
    <title>Authentication</title>
</head>
<body>

    <?php

        $errorMail ="";
        $errorPass ="";
        $email = "";

        if(isset($_GET['error']))
        {
            
            $val = $_GET['error'];
            
            if($val === '1')
            {
                $errorMail = "Email doesn't exist";
            }
            else if($val === '2' )
            {
                $errorPass = "Wrong Password";
            }
        }
        if(isset($_COOKIE['email']))
        {
            echo "1";
            $email = $_COOKIE['email']; 
            setcookie('email','',time()-1);
        }

    ?>

    <div id="login">
        <h1>Login</h1>



        <form method="post" action="php/login.php">

            <p>Email</p>
            <p><?php echo $errorMail?></p>
            <input type="email" name = "email" value="<?php echo $email ?>" required> 
            <p>Password</p>
            <p><?php echo $errorPass?></p>
            <input type="password" name = "password" required>
            <button type="submit" name="submit" value="Submit">Log In</button> 
            <a href="#register">Don't have an account? Click here!</a>
            
        </form>

        


    </div>

    <div id="register">
        <h1>Register</h1>
        <form method="POST" action="php/signin.php">
            
            <p>First Name</p>
            <input type="text" name="first_name" required>
            <p>Last Name</p>
            <input type="text" name="last_name" required>          
            <p>Address</p>
            <input type="text" name="address" required>
            <p>Email</p>
            <input type="email" name="email" required>  
            <p>Password</p>
            <input type="password" name="password" required>
            <button type="submit" name="submit" value="Submit">Register</button>

            
        </form>
    </div>

<script src="./js/auth.js"></script>
</body>
</html>