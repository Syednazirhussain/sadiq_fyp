<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="MediaCenter, Template, eCommerce">
    <meta name="robots" content="all">
    <title>Comfort Mart</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- Customizable CSS -->
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/blue.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.css">
    <link rel="stylesheet" href="assets/css/owl.transitions.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/rateit.css">
    <link rel="stylesheet" href="assets/css/bootstrap-select.min.css">

    <!-- Icons/Glyphs -->
    <link rel="stylesheet" href="assets/css/font-awesome.css">
    <link rel="stylesheet" href="assets/css/simple-line-icons.css">
    <link rel="stylesheet" href="assets/css/simple-line-icons.css">

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

    <style type="text/css">
        .top-cart-row .dropdown-cart .lnk-cart .items-cart-inner .total-price-basket:after {
            content: "" !important;
        }
    </style>

</head>

<body class="cnt-home">
    <header class="header-style-1">
        <div class="top-bar animate-dropdown">
            <div class="container">
                <div class="header-top-inner">
                    <div class="cnt-account">
                        <ul class="list-unstyled">
                            <?php if (isset($_SESSION['user'])) { ?>
                                <li><a href="javascript:void(0);"><i class="icon fa fa-user"></i>My Account</a></li>
                                <li><a href="javascript:void(0);"><i class="icon fa fa-shopping-cart"></i>My Cart</a></li>
                                <li><a href="javascript:void(0);" onclick="logout()"><i class="fa fa-power-off"></i>&nbsp;Logout</a></li>
                            <?php } else { ?>
                                <li><a href="login.php"><i class="icon fa fa-lock"></i>Login</a></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="main-header">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
                        <div class="logo">
                            <a href="index.php"> <img src="assets/images/logo.png" alt="logo"> </a>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-7 top-search-holder">
                        <div class="search-area">
                            <form>
                                <div class="control-group">
                                    <ul class="categories-filter animate-dropdown">
                                        <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="category.html">Categories <b class="caret"></b></a>
                                            <ul class="dropdown-menu" role="menu">
                                                <li class="menu-header">Computer</li>
                                                <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Clothing</a></li>
                                                <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Electronics</a></li>
                                                <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Shoes</a></li>
                                                <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Watches</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                    <input class="search-field" placeholder="Search here..." />
                                    <a class="search-button" href="javascript:void(0);"></a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row" id="myCartStatus">

                    </div>
                </div>
            </div>
        </div>
        <div class="header-nav animate-dropdown">
            <?php include_once('top_navbar.php'); ?>
        </div>
    </header>

    <script type="text/javascript">
        
        function logout () {
            if (confirm("Are you sure.?")) {

                window.location.href = 'logout.php';
            }
        }
    </script>