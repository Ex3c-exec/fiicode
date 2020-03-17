<?php
    session_start();
    if(isset($_SESSION['email']))
    {
        header("Location: index.php?succes=true");    
    }

?>

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

        $dmail = "";
        $dfirst ="";
        $dlast = "";
        $daddress = "";


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

        if(isset($_GET['mail']))
        {
            $dmail = $_GET['mail'];
        }
        if(isset($_GET['first']))
        {
            $dfirst = $_GET['first'];
        }
        if(isset($_GET['last']))
        {
            $dlast = $_GET['last'];
        }
        if(isset($_GET['address']))
        {
            $daddress = $_GET['address'];
        }


    ?>

    <div id="login">
        <h1>Login</h1>



        <form method="post" action="php/login.php">

            <p>Email</p>
            <input type="email" name = "email"  placeholder="E-mail..." required> 
            <p>Password</p>
            <p><?php echo $errorPass?></p>
            <input type="password" name = "password" placeholder="Password..." required>
            <button type="submit" name="submit" value="Submit">Log In</button> 

            <a href="#register">Don't have an account? Click here!</a>
            
        </form>

        


    </div>

    <div id="register">
        <h1>Register</h1>
        <form method="POST" action="php/signin.php">
            
            <p>First Name</p>
            <input type="text" name="first_name" placeholder="First Name" value="<?php echo $dfirst ?>" required>
            <p>Last Name</p>
            <input type="text" name="last_name" placeholder="Last Name" required>          
            <p>Address</p>
            <input type="text" name="address" placeholder="Address" required>
            <p>Email</p>
            <input type="email" name="email" placeholder="Email" required>  
            <p>Password</p>
            <input type="password" name="password" placeholder="Password" required >
            <p>Repeat Password</p>
            <input type="password" name="password_rpt" placeholder="Repeat  Password" >

            <button type="submit" name="submit" value="Submit">Register</button>

              
        </form>
    </div>

<script src="./js/auth.js"></script>
</body>
</html>