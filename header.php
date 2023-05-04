<?php include 'debugging.php';?>


    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="description" content="Magz is a HTML5 & CSS3 magazine template is based on Bootstrap 3.">
        <meta name="author" content="Kodinger">
        <meta name="keyword" content="magz, html5, css3, template, magazine template">
        <!-- Shareable -->
        <meta property="og:title" content="HTML5 & CSS3 magazine template is based on Bootstrap 3" />
        <meta property="og:type" content="article" />
        <meta property="og:url" content="http://github.com/nauvalazhar/Magz" />
        <meta property="og:image" content="https://raw.githubusercontent.com/nauvalazhar/Magz/master/images/preview.png" />
        <title>Magz &mdash; Responsive HTML5 &amp; CSS3 Magazine Template</title>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="scripts/bootstrap/bootstrap.min.css">
        <!-- IonIcons -->
        <link rel="stylesheet" href="scripts/ionicons/css/ionicons.min.css">
        <!-- Toast -->
        <link rel="stylesheet" href="scripts/toast/jquery.toast.min.css">
        <!-- OwlCarousel -->
        <link rel="stylesheet" href="scripts/owlcarousel/dist/assets/owl.carousel.min.css">
        <link rel="stylesheet" href="scripts/owlcarousel/dist/assets/owl.theme.default.min.css">
        <!-- Magnific Popup -->
        <link rel="stylesheet" href="scripts/magnific-popup/dist/magnific-popup.css">
        <link rel="stylesheet" href="scripts/sweetalert/dist/sweetalert.css">
        <!-- Custom style -->
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/skins/all.css">
        <link rel="stylesheet" href="css/demo.css">
    </head>

    <body>
        <header class="primary">
            <div class="firstbar">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-sm-12">
                            <div class="brand">
                                <a href="index.html">
                                    <img src="images/logo.png" alt="Magz Logo">
                                </a>
                            </div>						
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <form class="search" autocomplete="off">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" name="q" class="form-control" placeholder="Type something here">									
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary"><i class="ion-search"></i></button>
                                        </div>
                                    </div>
                                </div>

                            </form>								
                        </div>
                        <div class="col-md-3 col-sm-12 text-right">
                            <ul class="nav-icons">
                                <?php if(empty($_SESSION['user_id'])){
                                    echo '<li><a href="register.php"><i class="ion-person-add"></i><div>Register</div></a></li>
                       
                                <li><a href="loginPage.php"><i class="ion-person"></i><div>Login</div></a></li>
                                 </ul>
                        </div>
                    </div>
                </div>
            </div>
';
                                }else{
                                    echo '<h5>Welcome, '.$_SESSION['username'].'</h5>';
                                }
                                ?>
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Start nav -->
            <nav class="menu">
                <div class="container">
                    <div class="brand">
                        <a href="#">
                            <img src="images/logo.png" alt="Magz Logo">
                        </a>
                    </div>
                    <div class="mobile-toggle">
                        <a href="#" data-toggle="menu" data-target="#menu-list"><i class="ion-navicon-round"></i></a>
                    </div>
                    <div class="mobile-toggle">
                        <a href="#" data-toggle="sidebar" data-target="#sidebar"><i class="ion-ios-arrow-left"></i></a>
                    </div>
                    <div id="menu-list">
                        <ul class="nav-list">
                            <li class="for-tablet nav-title"><a>Menu</a></li>
                            <li class="for-tablet"><a href="loginPage.php">Login</a></li>
                            <li class="for-tablet"><a href="register.php">Register</a></li>
                            <li><a href="category.html">Standard</a></li>
                            <li class="dropdown magz-dropdown">
                                <a href="category.html">Pages <i class="ion-ios-arrow-right"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a href="index.html">Home</a></li>
                                    <li class="dropdown magz-dropdown">
                                        <a href="#">Authentication <i class="ion-ios-arrow-right"></i></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="loginPage.php">Login</a></li>
                                            <li><a href="register.php">Register</a></li>
                                            <li><a href="forgot.html">Forgot Password</a></li>
                                            <li><a href="reset.html">Reset Password</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="category.html">Category</a></li>
                                    <li><a href="single.html">Single</a></li>
                                    <li><a href="page.html">Page</a></li>
                                    <li><a href="search.html">Search</a></li>
                                    <li><a href="contact.html">Contact</a></li>
                                    <li class="dropdown magz-dropdown">
                                        <a href="#">Error <i class="ion-ios-arrow-right"></i></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="403.html">403</a></li>
                                            <li><a href="404.html">404</a></li>
                                            <li><a href="500.html">500</a></li>
                                            <li><a href="503.html">503</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown magz-dropdown"><a href="#">Dropdown <i class="ion-ios-arrow-right"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a href="category.html">Internet</a></li>
                                    <li class="dropdown magz-dropdown"><a href="category.html">Troubleshoot <i class="ion-ios-arrow-right"></i></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="category.html">Software</a></li>
                                            <li class="dropdown magz-dropdown"><a href="category.html">Hardware <i class="ion-ios-arrow-right"></i></a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="category.html">Main Board</a></li>
                                                    <li><a href="category.html">RAM</a></li>
                                                    <li><a href="category.html">Power Supply</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="category.html">Brainware</a>
                                        </ul>
                                    </li>
                                    <li><a href="category.html">Office</a></li>
                                    <li class="dropdown magz-dropdown"><a href="#">Programming <i class="ion-ios-arrow-right"></i></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="category.html">Web</a></li>
                                            <li class="dropdown magz-dropdown"><a href="category.html">Mobile <i class="ion-ios-arrow-right"></i></a>
                                                <ul class="dropdown-menu">
                                                    <li class="dropdown magz-dropdown"><a href="category.html">Hybrid <i class="ion-ios-arrow-right"></i></a>
                                                        <ul class="dropdown-menu">
                                                            <li><a href="#">Ionic Framework 1</a></li>
                                                            <li><a href="#">Ionic Framework 2</a></li>
                                                            <li><a href="#">Ionic Framework 3</a></li>
                                                            <li><a href="#">Framework 7</a></li>
                                                        </ul>
                                                    </li>
                                                    <li><a href="category.html">Native</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="category.html">Desktop</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown magz-dropdown magz-dropdown-megamenu"><a href="#">Mega Menu <i class="ion-ios-arrow-right"></i> <div class="badge">Hot</div></a>
                                <div class="dropdown-menu megamenu">
                                    <div class="megamenu-inner">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h2 class="megamenu-title">Trending</h2>
                                                    </div>
                                                </div>
                                                <ul class="vertical-menu">
                                                    <li><a href="#"><i class="ion-ios-circle-outline"></i> Mega menu is a new feature</a></li>
                                                    <li><a href="#"><i class="ion-ios-circle-outline"></i> This is an example</a></li>
                                                    <li><a href="#"><i class="ion-ios-circle-outline"></i> For a submenu item</a></li>
                                                    <li><a href="#"><i class="ion-ios-circle-outline"></i> You can add</a></li>
                                                    <li><a href="#"><i class="ion-ios-circle-outline"></i> Your own items</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h2 class="megamenu-title">Featured Posts</h2>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <article class="article col-md-4 mini">
                                                        <div class="inner">
                                                            <figure>
                                                                <a href="single.html">
                                                                    <img src="images/news/img10.jpg" alt="Sample Article">
                                                                </a>
                                                            </figure>
                                                            <div class="padding">
                                                                <div class="detail">
                                                                    <div class="time">December 10, 2016</div>
                                                                    <div class="category"><a href="category.html">Healthy</a></div>
                                                                </div>
                                                                <h2><a href="single.html">Duis aute irure dolor in reprehenderit in voluptate</a></h2>
                                                            </div>
                                                        </div>
                                                    </article>
                                                    <article class="article col-md-4 mini">
                                                        <div class="inner">
                                                            <figure>
                                                                <a href="single.html">
                                                                    <img src="images/news/img11.jpg" alt="Sample Article">
                                                                </a>
                                                            </figure>
                                                            <div class="padding">
                                                                <div class="detail">
                                                                    <div class="time">December 13, 2016</div>
                                                                    <div class="category"><a href="category.html">Lifestyle</a></div>
                                                                </div>
                                                                <h2><a href="single.html">Duis aute irure dolor in reprehenderit in voluptate</a></h2>
                                                            </div>
                                                        </div>
                                                    </article>
                                                    <article class="article col-md-4 mini">
                                                        <div class="inner">
                                                            <figure>
                                                                <a href="single.html">
                                                                    <img src="images/news/img14.jpg" alt="Sample Article">
                                                                </a>
                                                            </figure>
                                                            <div class="padding">
                                                                <div class="detail">
                                                                    <div class="time">December 14, 2016</div>
                                                                    <div class="category"><a href="category.html">Travel</a></div>
                                                                </div>
                                                                <h2><a href="single.html">Duis aute irure dolor in reprehenderit in voluptate</a></h2>
                                                            </div>
                                                        </div>
                                                    </article>
                                                </div>
                                            </div>
                                        </div>								
                                    </div>
                                </div>
                            </li>
                            <li class="dropdown magz-dropdown magz-dropdown-megamenu"><a href="#">Column <i class="ion-ios-arrow-right"></i></a>
                                <div class="dropdown-menu megamenu">
                                    <div class="megamenu-inner">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <h2 class="megamenu-title">Column 1</h2>
                                                <ul class="vertical-menu">
                                                    <li><a href="#">Example 1</a></li>
                                                    <li><a href="#">Example 2</a></li>
                                                    <li><a href="#">Example 3</a></li>
                                                    <li><a href="#">Example 4</a></li>
                                                    <li><a href="#">Example 5</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-md-3">
                                                <h2 class="megamenu-title">Column 2</h2>
                                                <ul class="vertical-menu">
                                                    <li><a href="#">Example 6</a></li>
                                                    <li><a href="#">Example 7</a></li>
                                                    <li><a href="#">Example 8</a></li>
                                                    <li><a href="#">Example 9</a></li>
                                                    <li><a href="#">Example 10</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-md-3">
                                                <h2 class="megamenu-title">Column 3</h2>
                                                <ul class="vertical-menu">
                                                    <li><a href="#">Example 11</a></li>
                                                    <li><a href="#">Example 12</a></li>
                                                    <li><a href="#">Example 13</a></li>
                                                    <li><a href="#">Example 14</a></li>
                                                    <li><a href="#">Example 15</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-md-3">
                                                <h2 class="megamenu-title">Column 4</h2>
                                                <ul class="vertical-menu">
                                                    <li><a href="#">Example 16</a></li>
                                                    <li><a href="#">Example 17</a></li>
                                                    <li><a href="#">Example 18</a></li>
                                                    <li><a href="#">Example 19</a></li>
                                                    <li><a href="#">Example 20</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="dropdown magz-dropdown"><a href="#">Dropdown Icons <i class="ion-ios-arrow-right"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#"><i class="icon ion-person"></i> My Account</a></li>
                                    <li><a href="#"><i class="icon ion-heart"></i> Favorite</a></li>
                                    <li><a href="#"><i class="icon ion-chatbox"></i> Comments</a></li>
                                    <li><a href="#"><i class="icon ion-key"></i> Change Password</a></li>
                                    <li><a href="#"><i class="icon ion-settings"></i> Settings</a></li>
                                    <li class="divider"></li>
                                    <li><a href="logout.php"><i class="icon ion-log-out"></i> Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End nav -->
        </header>
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



