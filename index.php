<?php
include 'header.php';
?>

<body>
    <section class="home">
        <div class="container" >
            <div class="row">
                <div class="col-md-8 col-sm-12 col-xs-12">
                    <div class="owl-carousel owl-theme slide" id="featured">
                        <?php 
                        $list = Article::getWeeklyTops();
                            for ($i = 0; $i < count($list); $i++){
                                echo '<div class="item">
                            <article class="featured">
                                <div class="overlay"></div>
                                <figure>
                                <img src="'. Media::getPhotoURL($list[$i]->article_id)->URL .'">
                                </figure>
                                <div class="details">
                                    <div class="category"><a href="category.html">'. Article::getCatName($list[$i]->category_id) .'</a></div>
                                    <h1><a href="singleArticle.php?aid='.$list[$i]->article_id .'">'. $list[$i]->title .'</a></h1>
                                    <div class="time">'.  $list[$i]->publish_date  .'</div>
                                </div>
                            </article>
                        </div>';
                            }
                        ?>
                    </div>
                    <!-- Add navigation arrows -->
                    <div class="custom-navigation">
                        <a class="btn prev"><i class="fas fa-chevron-left"></i></a>
                        <a class="btn next"><i class="fas fa-chevron-right"></i></a>
                    </div>
                    <div class="line">
                        <div>Latest News</div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="row">
                                <?php
                                    //get all articles 
                                $list = Article::getArticles($start, $end);
                                if (!empty($list)){
                                    //display them 
                                    for ($i = 0; $i < count($list); $i++){
                                        if ($i %2 == 0){
                                            echo ' <article class="article col-md-12">
                                    <div class="inner">
                                        <figure>
                                            <a href="singleArticle.php?aid='.$list[$i]->article_id.'">
                                            <img src="'. Media::getPhotoURL($list[$i]->article_id)->URL .'">
                                            </a>
                                        </figure>
                                        <div class="padding">
                                            <div class="detail">
                                                <div class="time">'. $list[$i]->publish_date .'</div>
                                                <div class="category"><a href="category.php?cid='. $list[$i]->category_id.'">'. Article::getCatName($list[$i]->category_id) .'</a></div>
                                            </div>
                                            <h2>'. $list[$i]->title .'</h2>
                                            <p>'.  $list[$i]->description .'</p>';
                                            if ($list[$i]->description !== "This article was removed by an administrator"){
                                                echo '<footer>
                                                <a href="#" class="love"><i class="ion-android-favorite-outline"></i> <div>'. $list[$i]->likes .'</div></a>
                                                <a class="btn btn-primary more" href="singleArticle.php?aid='.$list[$i]->article_id.'">
                                                    <div>More</div>
                                                    <div><i class="ion-ios-arrow-thin-right"></i></div>
                                                </a>
                                            </footer>';
                                            }
                                        echo '</div>
                                                </div>
                                            </article>';
                                        }
                                       
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="row">
                                <?php 
                                $list = Article::getArticles($start, $end);
                                if (!empty($list)){
                                    //display them 
                                    for ($i = 0; $i < count($list); $i++){
                                        if ($i % 2 != 0) {
                                            echo ' <article class="article col-md-12">
                                    <div class="inner">
                                        <figure>
                                            <a href="singleArticle.php?aid='.$list[$i]->article_id.'">
                                            <img src="'. Media::getPhotoURL($list[$i]->article_id)->URL .'">
                                            </a>
                                        </figure>
                                        <div class="padding">
                                            <div class="detail">
                                                <div class="time">'. $list[$i]->publish_date .'</div>
                                                <div class="category"><a href="category.php?cid='. $list[$i]->category_id.'">'. Article::getCatName($list[$i]->category_id) .'</a></div>
                                            </div>
                                            <h2>'. $list[$i]->title .'</h2>
                                            <p>'.  $list[$i]->description .'</p>
                                            <footer>
                                                <a href="#" class="love"><i class="ion-android-favorite-outline"></i> <div>'. $list[$i]->likes .'</div></a>
                                                <a class="btn btn-primary more" href="singleArticle.php?aid='.$list[$i]->article_id.'">
                                                    <div>More</div>
                                                    <div><i class="ion-ios-arrow-thin-right"></i></div>
                                                </a>
                                            </footer>
                                        </div>
                                    </div>
                                </article>';
                                    }
                                    }
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="col-xs-6 col-md-4 sidebar" id="sidebar">
                    <div class="sidebar-title for-tablet">Sidebar</div>
                    <aside>
                        <div class="aside-body">
                            <div class="featured-author">
                                <?php 
                                    $top = Users::getTopAuthor();
                                    echo '  <div class="featured-author-inner">
                                    <div class="featured-author-cover" style="background-image: url(\'images/back2.jpg\');">
                                        <div class="badges">
                                            <div class="badge-item"><i class="ion-star"></i> FEATURED</div>
                                        </div>
                                        <div class="featured-author-center">
                                            <figure class="featured-author-picture">
                                                <img src="images/profilePic.png">
                                            </figure>
                                            <div class="featured-author-info">
                                                <h2 class="name">'. $top['username'] .'</h2>
                                                <div class="desc">'. $top['type_name'] .'</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="featured-author-body">
                                        <div class="featured-author-count">
                                            <div class="item">
                                                <a href="#">
                                                    <div class="name">Articles</div>
                                                    <div class="value">'. $top['article_count'] .'</div>														
                                                </a>
                                            </div>
                                            <div class="item">
                                                <a href="#">
                                                    <div class="name">Views</div>
                                                    <div class="value">'. $top['total_views'] .'</div>														
                                                </a>
                                            </div>
                                            <div class="item">
                                                <a href="#">
                                                    <div class="name">Likes</div>
                                                    <div class="value">'. $top['total_likes'] .'</div>														
                                                </a>
                                            </div>
                                        </div>
                                        <div class="featured-author-quote">
                                            "Writing, to me, is simply thinking through my fingers."
                                        </div>
                                        
                                        
                                    </div>
                                </div>';
                                ?>
                              
                            </div>
                        </div>
                    </aside>
                   
                </div>
            </div>
        </div>
    </section>

</body>
<!-- footer -->
<?php  include 'footer.html'?>
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


