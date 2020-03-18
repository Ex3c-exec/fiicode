
<?php
session_start();
if(isset($_SESSION['email']))
{
}
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/home.css" />
    <title>Welcome</title>
</head>
<body>

<main id="main">
    <div class="phoneNav" id="hideOnBig">
      <!--  -->
    </div>
    <nav>
        <ul id="interactMenuPhone">
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

    <div class="title">
        <h1>Bookstore</h1>
    </div>

    <p><a href="php/logout.php">Log Out</a></p>

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
        <form id="contactForm">
            <input placeholder="Email" type="email" required>
            <input placeholder="Message" type="text" required>
            <button>Submit</button>
        </form>
    </div>

    <div class="realFooter">
        <p>©2020</p>
    </div>

</footer>

<script src="./js/home.js"></script>
</body>
</html>