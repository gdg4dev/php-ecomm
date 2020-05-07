<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title id="title">EASY-COMMERCE</title>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles/style.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>

    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
</head>

<body id="body">
    <nav class="navbar navbar-expand-lg navbar-light bg-light m-0">
        <div class="container-fluid">
            <span id="head-logo">
                <a href="index.php">
                    <h2><b id="nav-head-logo" style="background:linear-gradient(to right, #E25B45 0%, #FAC172 100%);-webkit-background-clip: text;-webkit-text-fill-color: transparent;">EASY-COMMERCE</b></h2>
                </a>
            </span>
            <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-align-justify"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link animating-link" href="index.php">home</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link animating-link" href="products.php">All Products</a>
                    </li>
                    <li class="nav-item active" id="sidebarCollapse">
                        <a class="nav-link animating-link" id="cat-btn-lnk" href="account.php">My Account</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link animating-link" href="register.php">Sign Up</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link animating-link" href="cart.php">Shopping Cart</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link animating-link" href="contact.php">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div id="searchBar" class="m-0 d-flex">
        <div class="form">
            <form action="results.php" method="get" class="form">
                <input id="inputQuery" type="text" class="input" name="user_query" placeholder="Search for a Product">
                <input id="submitQuery" type="submit" name="search" value="search">
            </form>
        </div>
        <div class="toolbar">
            <a href="cart.php"><span>Shopping Cart: <?php cartItems();?> items | Total Amount: $<?php cart_pro_price(false);?></span></a>
        </div>
    </div>