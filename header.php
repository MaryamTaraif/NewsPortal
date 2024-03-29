<?php include 'debugging.php'; ?>

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
    <title>Magz</title>
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
    <link rel="stylesheet" href="scripts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    
<!-- JS -->
<script src="js/jquery.js"></script>
<script src="js/jquery.migrate.js"></script>
<script src="scripts/bootstrap/bootstrap.min.js"></script>
<script>var $target_end = $(".best-of-the-week");</script>
<script src="scripts/jquery-number/jquery.number.min.js"></script>
<script src="scripts/owlcarousel/dist/owl.carousel.min.js"></script>
<script src="scripts/magnific-popup/dist/jquery.magnific-popup.min.js"></script>
<script src="scripts/easescroll/jquery.easeScroll.js"></script>
<script src="scripts/sweetalert/dist/sweetalert.min.js"></script>
<script src="scripts/toast/jquery.toast.min.js"></script>
<script src="js/demo.js"></script>
<script src="js/e-magz.js"></script>
</head>

<body>
    <header class="primary fixed">
        <div class="firstbar">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-12">
                        <div class="brand">
                            <a href="index.php">
                                <img src="images/logo.png" alt="Magz Logo">
                            </a>
                        </div>						
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <form class="search" action="test_search.php">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" name="searchText" class="form-control" placeholder="Search by words in article title, description or content..">									
                                    <div class="input-group-btn">

                                        <button class="btn btn-primary"><i class="ion-search"></i></button>

                                    </div>
                                </div>
                            </div>

                        </form>								
                    </div>
                    <div class="col-md-3 col-sm-12 text-right">
                        <ul class="nav-icons">
                            <?php
                            if (empty($_SESSION['user_id'])) {
                                echo '<li><a href="register.php"><i class="ion-person-add"></i><div>Register</div></a></li>
                       
                                <li><a href="loginPage.php"><i class="ion-person"></i><div>Login</div></a></li>
                                 </ul>
                        </div>
                    </div>
                </div>
            </div>
';
                            } else {
                                echo '<h5>Welcome, ' . $_SESSION['username'] . '</h5>' .
                                '<h6 style="text-align: center;">' . $_SESSION['role'] . '</h6>';
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
                            <?php
                            //retrieve all categories and disaply 
                            $list = Article::getAllCat();
                            if (!empty($list)) {
                                for ($i = 0; $i < count($list); $i++) {
                                    echo '<li>
                                    <a href="category.php?cid=' . $list[$i]->category_id . '">' . $list[$i]->category_name;
                                    if ($list[$i]->category_id == 60)
                                        echo '<div class="badge">Hot</div>';
                                    echo '</a></li>';
                                }
                            }
                            ?>

                        <?php
                        if (!empty($_SESSION['user_id'])) {
                            echo'  <li class="dropdown magz-dropdown" style="margin-left: auto;"><a href="#">My Account <i class="ion-ios-arrow-right"></i></a>
                                <ul class="dropdown-menu">';
                            if ($_SESSION['role'] == 'Author') {
                                echo '<li><a href="addArticle.php"><i class="icon ion-plus"></i>Add Article</a></li>
                                       <li><a href="myArticles.php"><i class="icon ion-document-text"></i>My Articles</a></li>';
                            } elseif ($_SESSION['role'] == 'Admin') {
                                echo '
                                    <li><a href="addArticle.php"><i class="icon ion-android-add"></i>Add Article</a></li>
                                    <li><a href="myArticles.php"><i class="icon ion-document-text"></i>My Articles</a></li>
                                    <li><a href="view_Articles.php"><i class="icon ion-ios-list"></i>Manage Articles</a></li>
                                    <li><a href="view_Users.php"><i class="icon ion-person-stalker"></i>Manage Users</a></li>
                                    <li><a href="adminReports.php"><i class="icon ion-android-settings"></i>Administration Reports</a></li>';
                            }
                            echo '<li><a href="logout.php"><i class="icon ion-log-out"></i> Logout</a></li>
                                </ul>
                            </li>';
                        }
                        ?>

                    </ul>
                </div>
            </div>
        </nav>
        <!-- End nav -->
    </header>


