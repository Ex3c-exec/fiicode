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

        $dmail = "";
        $dfirst ="";
        $dlast = "";
        $daddress = "";
        $lemail = "";

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
        if(isset($_GET['error']))
        {
            $error = $_GET['error'];
        }
        if(isset($_GET['lemail']))
        {
            $lemail = $_GET['lemail'];
        }

    ?>

    <div id="login">
        <h1>Login</h1>

        <form method="post" action="php/login.php">

            <p>Email</p>
            <span> <?php if(isset($error) && $error === "lnoUser") echo "<p style='color:red'>Your account doesn't exist </p> "?> </span>
            <input type="email" name = "email"   value="<?php echo $lemail?>" required> 


            <p>Password</p>
            <span> <?php if(isset($error) && $error === "lwrongPass") echo "<p style='color:red'>Wrong Password</p> "?> </span>
            <input type="password" name = "password"  required>
            <button type="submit" name="submit" value="Submit">Login</button> 

            <a href="#register">Don't have an account? Click here!</a>
            
        </form>

        


    </div>

    <div id="register">
        <h1>Register</h1>
        <form method="POST" action="php/signin.php">
            
            <p>First Name</p>
            <input type="text" name="first_name"  value="<?php echo $dfirst ?>" required>


            <p>Last Name</p>
            <input type="text" name="last_name"  value="<?php echo $dlast ?>"  required>          


            <p>Address</p>
            <input type="text" name="address"  value="<?php echo $daddress ?>" required>


            <p>Email</p>
            <span> <?php if(isset($error) && $error === "emailTaken") echo "<p style='color:red'>Email already exists</p> "?> </span>
            <input type="email" name="email"  value="<?php echo $dmail ?>" required>  


            <p>Password</p>
            <span> <?php if(isset($error) && $error === "passwordMatch") echo "<p style='color:red'>Passwords Don\t Match</p> "?> </span>
            <input type="password" name="password"   required >
            

            <p>Repeat password</p>
            <input type="password" name="password_rpt"  required>


            <button type="submit" name="submit" value="Submit">Register</button>

            <a href="#login">Already have an account? Click here!</a>
        </form>
    </div>

<script src="./js/auth.js"></script>
</body>
</html>