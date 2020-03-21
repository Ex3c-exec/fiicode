<?php
    // DACA NU ESTE SETATA SESIUNEA TE SCOATE AFARA 
    session_start();
     if(isset($_SESSION['email']))
    {
        header("Location: dashboard.php");    
    }

    
    include 'phpmailer/contact.php'

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="./css/home.css" />
    <title>Welcome</title>
</head>
<body>

<main id="main">
    <nav id="hideOnSmall">
        <ul>
            <div class="left">
                <img src="./images/fiicode.png" alt="fiicode">
                <li><a href="#">FiiCode project</a></li>
            </div>
            <div class="right">
                <li><a href="./auth.php#login">Login</a></li>
                <li><a href="#contactUs">Contact</a></li>
            </div>
        </ul>
    </nav>

    <div id="hideOnBig" class="pos-f-t">
        <div class="collapse" id="navbarToggleExternalContent">
          <div style="background-color: #D6F1C1;">
            <a class="mobileNavLinks" href="./auth.php#login">Login</a>
            <a class="mobileNavLinks" style="margin-top:2px" href="./auth.php#register">Register</a>
            <a class="mobileNavLinks" style="margin-top:2px" href="#contactUs">Contact</a>
        </ul>
          </div>
        </div>
        <nav class="navbar navbar-light" style="background-color: #D6F1C1;">
          <button style="box-shadow: 0 0; margin: 0; padding: 0;" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </nav>
      </div>

    <div class="title">
        <h1>Bookstore</h1>
    </div>

    <div class="welcomeContainer">
        <img src="./images/closedbook.png" alt="book">
        <div>
            <h5>Get yourself a book and read it with pleasure</h5>
            <a id="hideOnSmall" style="cursor: pointer;" href="#moreinfo" ><button>See more</button></a>
            <div id="hideOnBig" class="buttonsGroupSmall">
                <a href="./auth.php#login" style="cursor: pointer;"><button>Login</button></a>
                <a style="cursor: pointer;" href="#contactUs"><button>Contact us</button></a>
            </div>
        </div>
    </div>

    
    <img class="reader" src="./images/reader.png" alt="reader">

</main>

<section id="moreinfo">
    <a href="#main" class="goBackUpButton" style="background-color: #643754;"><div class="arrow">s</div></a>
    <div class="art">

    </div>

    <div class="moreinfo">
        <div>
            <h5 style="color: #643754">The books are entirely free, just create an account and choose your favourite book!</h5>
            <a href="auth.php#register"><button>Register</button></a>
        </div>
        <img src="./images/openbook.png" alt="book">
    </div>
</section>

<footer id="contactUs">
    <a href="#main" class="goBackUpButton" style="background-color: #D6F1C1;"><div class="arrow">s</div></a>
    <div class="title">
        <h1>Contact us</h1>
        <form id="contactForm" method = "POST" action="">
            <input placeholder="Name..." type="text" name="name" required>
            <input placeholder="Email..." type="email" name="email" required>
            <input placeholder="Message..." type="text" name="message" required>
            <button type="submit" name="submit" value="submit">Submit</button>
        </form>
    </div>

    <div class="realFooter">
        <p>©2020</p>
    </div>

</footer>

<script src="./js/home.js"></script>
</body>
</html>