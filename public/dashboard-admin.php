<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="./css/dashboard.css"/>
    <title>Dashboard</title>
</head>
<body>

<div class="content-wrap">

    <nav class="navbar navbar-expand-sm justify-content-end hideOnSmall">
        <ul class="navbar-nav">
            <li class="nav-item"><a href="#multiple-books-component" class="nav-link">Requests</a></li>
            <li class="nav-item"><a href="#multiple-books-component" class="nav-link">New book</a></li>
            <li class="nav-item"><a href="#multiple-books-component" class="nav-link">Books</a></li>
            <li class="nav-item"><a href="#account-component" class="nav-link">Account</a></li>
            <li class="nav-item"><a href="" class="nav-link">Logout</a></li>
        </ul>
    </nav>

    <div class="pos-f-t hideOnBig">
        <div class="collapse" id="navbarToggleExternalContent">
        <div style="background-color: #D6F1C1;">
            <a class="mobileNavLinks" href="#multiple-books-component">Requests</a>
            <a class="mobileNavLinks" style="margin:2px 0" href="#account-component">New book</a>
            <a class="mobileNavLinks" href="#multiple-books-component">Books</a>
            <a class="mobileNavLinks" style="margin:2px 0" href="#account-component">Account</a>
            <a class="mobileNavLinks" href="">Logout</a>
        </ul>
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
            <h1>Welcome user!</h1>
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
            <form>
                <h4>When could you give it back?</h4>
                <select id="###///" required>
                    <option value="0w">Less than a week</option>
                    <option value="1w">1 week</option>
                    <option value="2w">2 weeks</option>
                    <option value="3w">3 weeks</option>
                    <option value="4w">4 weeks</option>
                </select>
                <h4>Your phone number</h4>
                <input type="number" required size="10"><br />
                <button class="btn-style">Request book</button>
            </form>
        </div>

    </section>

    <!-- ACCOUNT COMPONENT -->
    <section id="account-component" class="container templateContainer">
        <!-- AICI ESTE ACCOUNT-UL, INCARCAT DIN TEMPLATE -->
    </section>

</div>

<footer>
    © Copyright 2020. All the rights reserved.
</footer>

<script src="./js/dashboard-admin.js"></script>
</body>
</html>