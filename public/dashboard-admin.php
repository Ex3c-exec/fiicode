<?php
    // DACA NU ESTE SETATA SESIUNEA TE SCOATE AFARA 
    session_start();
    if(!isset($_SESSION['email']))
    {
        header("Location: auth.php");    
    }
    if($_SESSION['admin'] == 0)
    {
        header("Location: dashboard.php");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="./css/dashboard.css"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <title>Dashboard Admin</title>
</head>
<body>

<div class="content-wrap">

    <nav class="navbar navbar-expand-sm justify-content-end hideOnSmall">
        <ul class="navbar-nav">
        <li class="nav-item"><a href="#requests-component" class="nav-link">Requests</a></li>
        <li class="nav-item"><a href="#newbook-component" class="nav-link">New book</a></li>
            <li class="nav-item"><a href="#multiple-books-component" class="nav-link">Books</a></li>
            <li class="nav-item"><a href="#account-component" class="nav-link">Account</a></li>
            <li class="nav-item"><a href="./php/logout.php" class="nav-link">Logout</a></li>
        </ul>
    </nav>

    <div class="pos-f-t hideOnBig">
        <div class="collapse" id="navbarToggleExternalContent">
        <div style="background-color: #D6F1C1;">
            <a class="mobileNavLinks" href="#requests-component">Requests</a>
            <a class="mobileNavLinks" style="margin:2px 0" href="#newbook-component">New book</a>
            <a class="mobileNavLinks" style="margin:2px 0" href="#multiple-books-component">Books</a>
            <a class="mobileNavLinks" style="margin:2px 0" href="#account-component">Account</a>
            <a class="mobileNavLinks" href="./php/logout.php">Logout</a>
        </div>
        </div>
        <nav class="navbar navbar-light" style="background-color: #D6F1C1;">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        </nav>
    </div>

    <!-- MULTIPLE BOOKS COMPONENT -->
    <main id="multiple-books-component">

        <div class="container searchContainer text-center">
            <h1>Welcome!</h1>
            <input id="search-val" class="searchInput" placeholder="Type here a book name..." type="text">
        </div>

        <div id="all-books-component" class="container booksContainer">
                <!-- AICI SUNT TOATE CARTILE, INCARCATE DIN TEMPLATE -->
        </div>

    </main>

    <!-- SINGLE BOOK COMPONENT -->
        <article id="single-book-component" class="container booksContainer">
            <!-- AICI ESTE O CARTE SELECTATA, INCARCATA DIN TEMPLATE -->
        </article>

    <!-- REQUEST COMPONENT -->
    <section id="request-component" class="container templateContainer">

        <div class="templateMiniContainer">
            <h1>Request form</h1>
            <form id="requestFormSubmit">
                <h4>When could you give it back?</h4>
                <select id="term!" required>
                    <option value="0">Less than a week</option>
                    <option value="1">1 week</option>
                    <option value="2">2 weeks</option>
                    <option value="3">3 weeks</option>
                    <option value="4">4 weeks</option>
                </select>
                <h4>Your phone number</h4>
                <input id="phone!" type="number" required class="txtFontRepair" size="10"><br />
                <button class="btn-style">Request book</button>
            </form>
        </div>

    </section>

    <!-- ACCOUNT COMPONENT -->
    <section id="account-component" class="container templateContainer">
        <!-- AICI ESTE ACCOUNT-UL, INCARCAT DIN TEMPLATE -->
    </section>

    <!-- NEWBOOK COMPONENT -->
    <section id="newbook-component" class="container templateContainer">
    <div class="templateMiniContainer">
            <h1>New book</h1>
            <form id="newBookSubmit">
                <h4>Title</h4>
                <input id="title@" type="text" required><br />
                <h4>Author</h4>
                <input id="author@" type="text" required><br />
                <h4>Image source</h4>
                <input id="img@" type="text" required><br />
                <h4>Description</h4>
                <textarea id="descr@" type="text" required rows="4" cols="50" >
                </textarea>
                <br />
                <button class="btn-style">Add book</button>
            </form>
        </div>
    </section>

    <!-- REQUEST LIST COMPONENT -->
    <section id="requests-component" class="container templateContainer">
    <div class="templateMiniContainer">
            <h1>Requests</h1>
            <div id="requestsList" class="requestsList">
                <!-- AICI SUNT TOATE REQUESTURILE VIZIBILE -->
            </div>
        </div>
    </section>

<!-- EDIT BOOK COMPONENT -->
<section id="edit-book-component" class="container templateContainer">
        <!-- AICI ESTE TEMPLATE-UL INCARCAT -->
</section>

</div>

<footer>
    © Copyright 2020. All the rights reserved.
</footer>

<script  src="./js/dashboard-admin.js"></script>
</body>
</html>