<?php
include 'header.php';
?>

<body>
    <section class="home">
        <div class="container">
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
                    <div class="line">
                        <div>Latest News</div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="row">
                                <?php
                                    //get all articles 
                                $list = Article::getArticles();
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
                                            <h2><a href="singleArticle.php?aid='.$list[$i]->article_id.'">'. $list[$i]->title .'</a></h2>
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
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="row">
                                <?php 
                                $list = Article::getArticles();
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
                                            <h2><a href="singleArticle.php?aid='.$list[$i]->article_id.'">'. $list[$i]->title .'</a></h2>
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
                                <div class="featured-author-inner">
                                    <div class="featured-author-cover" style="background-image: url('images/back2.jpg');">
                                        <div class="badges">
                                            <div class="badge-item"><i class="ion-star"></i> FEATURED</div>
                                        </div>
                                        <div class="featured-author-center">
                                            <figure class="featured-author-picture">
                                                <img src="images/profilePic.png">
                                            </figure>
                                            <div class="featured-author-info">
                                                <h2 class="name">TopAuthor</h2>
                                                <div class="desc">Author</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="featured-author-body">
                                        <div class="featured-author-count">
                                            <div class="item">
                                                <a href="#">
                                                    <div class="name">Articles</div>
                                                    <div class="value">208</div>														
                                                </a>
                                            </div>
                                            <div class="item">
                                                <a href="#">
                                                    <div class="name">Views</div>
                                                    <div class="value">3,729</div>														
                                                </a>
                                            </div>
                                            <div class="item">
                                                <a href="#">
                                                    <div class="name">Likes</div>
                                                    <div class="value">3,729</div>														
                                                </a>
                                            </div>
                                        </div>
                                        <div class="featured-author-quote">
                                            "Writing, to me, is simply thinking through my fingers."
                                        </div>
                                        
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </aside>
                    <aside>
                        <h1 class="aside-title">Popular <a href="#" class="all">See All <i class="ion-ios-arrow-right"></i></a></h1>
                        <div class="aside-body">
                            <article class="article-mini">
                                <div class="inner">
                                    <figure>
                                        <a href="single.html">
                                            <img src="images/news/img07.jpg" alt="Sample Article">
                                        </a>
                                    </figure>
                                    <div class="padding">
                                        <h1><a href="single.html">Fusce ullamcorper elit at felis cursus suscipit</a></h1>
                                    </div>
                                </div>
                            </article>
                            <article class="article-mini">
                                <div class="inner">
                                    <figure>
                                        <a href="single.html">
                                            <img src="images/news/img14.jpg" alt="Sample Article">
                                        </a>
                                    </figure>
                                    <div class="padding">
                                        <h1><a href="single.html">Duis aute irure dolor in reprehenderit in voluptate velit</a></h1>
                                    </div>
                                </div>
                            </article>
                            <article class="article-mini">
                                <div class="inner">
                                    <figure>
                                        <a href="single.html">
                                            <img src="images/news/img09.jpg" alt="Sample Article">
                                        </a>
                                    </figure>
                                    <div class="padding">
                                        <h1><a href="single.html">Aliquam et metus convallis tincidunt velit ut rhoncus dolor</a></h1>
                                    </div>
                                </div>
                            </article>
                            <article class="article-mini">
                                <div class="inner">
                                    <figure>
                                        <a href="single.html">
                                            <img src="images/news/img11.jpg" alt="Sample Article">
                                        </a>
                                    </figure>
                                    <div class="padding">
                                        <h1><a href="single.html">dui augue facilisis lacus fringilla pulvinar massa felis quis velit</a></h1>
                                    </div>
                                </div>
                            </article>
                            <article class="article-mini">
                                <div class="inner">
                                    <figure>
                                        <a href="single.html">
                                            <img src="images/news/img06.jpg" alt="Sample Article">
                                        </a>
                                    </figure>
                                    <div class="padding">
                                        <h1><a href="single.html">neque est semper nulla, ac elementum risus quam a enim</a></h1>
                                    </div>
                                </div>
                            </article>
                            <article class="article-mini">
                                <div class="inner">
                                    <figure>
                                        <a href="single.html">
                                            <img src="images/news/img03.jpg" alt="Sample Article">
                                        </a>
                                    </figure>
                                    <div class="padding">
                                        <h1><a href="single.html">Morbi vitae nisl ac mi luctus aliquet a vitae libero</a></h1>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </aside>

               
                </div>
            </div>
        </div>
    </section>

    <section class="best-of-the-week">
        <div class="container">
            <h1><div class="text">Best Of The Week</div>
                <div class="carousel-nav" id="best-of-the-week-nav">
                    <div class="prev">
                        <i class="ion-ios-arrow-left"></i>
                    </div>
                    <div class="next">
                        <i class="ion-ios-arrow-right"></i>
                    </div>
                </div>
            </h1>
            <div class="owl-carousel owl-theme carousel-1">
                <article class="article">
                    <div class="inner">
                        <figure>
                            <a href="single.html">
                                <img src="images/news/img03.jpg" alt="Sample Article">
                            </a>
                        </figure>
                        <div class="padding">
                            <div class="detail">
                                <div class="time">December 11, 2016</div>
                                <div class="category"><a href="category.html">Travel</a></div>
                            </div>
                            <h2><a href="single.html">tempor interdum Praesent tincidunt</a></h2>
                            <p>Praesent tincidunt, leo vitae congue molestie.</p>
                        </div>
                    </div>
                </article>
                <article class="article">
                    <div class="inner">
                        <figure>
                            <a href="single.html">
                                <img src="images/news/img16.jpg" alt="Sample Article">
                            </a>
                        </figure>
                        <div class="padding">
                            <div class="detail">
                                <div class="time">December 09, 2016</div>
                                <div class="category"><a href="category.html">Sport</a></div>
                            </div>
                            <h2><a href="single.html">Maecenas porttitor sit amet turpis a semper</a></h2>
                            <p> Proin vulputate, urna id porttitor luctus, dui augue facilisis lacus.</p>
                        </div>
                    </div>
                </article>
                <article class="article">
                    <div class="inner">
                        <figure>
                            <a href="single.html">
                                <img src="images/news/img15.jpg" alt="Sample Article">
                            </a>
                        </figure>
                        <div class="padding">
                            <div class="detail">
                                <div class="time">December 26, 2016</div>
                                <div class="category"><a href="category.html">Lifestyle</a></div>
                            </div>
                            <h2><a href="single.html">Fusce ac odio eu ex volutpat pellentesque</a></h2>
                            <p>Vestibulum ante ipsum primis in faucibus orci luctus</p>
                        </div>
                    </div>
                </article>
                <article class="article">
                    <div class="inner">
                        <figure>
                            <a href="single.html">
                                <img src="images/news/img14.jpg" alt="Sample Article">
                            </a>
                        </figure>
                        <div class="padding">
                            <div class="detail">
                                <div class="time">December 26, 2016</div>
                                <div class="category"><a href="category.html">Travel</a></div>
                            </div>
                            <h2><a href="single.html">Nulla facilisis odio quis gravida vestibulum</a></h2>
                            <p>Proin venenatis pellentesque arcu, ut mattis nulla placerat et.</p>
                        </div>
                    </div>
                </article>
                <article class="article">
                    <div class="inner">
                        <figure>
                            <a href="single.html">
                                <img src="images/news/img01.jpg" alt="Sample Article">
                            </a>
                        </figure>
                        <div class="padding">
                            <div class="detail">
                                <div class="time">December 26, 2016</div>
                                <div class="category"><a href="category.html">Travel</a></div>
                            </div>
                            <h2><a href="single.html">Fusce Ullamcorper Elit At Felis Cursus Suscipit</a></h2>
                            <p>Proin venenatis pellentesque arcu, ut mattis nulla placerat et.</p>
                        </div>
                    </div>
                </article>
                <article class="article">
                    <div class="inner">
                        <figure>
                            <a href="single.html">
                                <img src="images/news/img11.jpg" alt="Sample Article">
                            </a>
                        </figure>
                        <div class="padding">
                            <div class="detail">
                                <div class="time">December 26, 2016</div>
                                <div class="category"><a href="category.html">Travel</a></div>
                            </div>
                            <h2><a href="single.html">Donec consequat arcu at ultrices sodales</a></h2>
                            <p>Proin venenatis pellentesque arcu, ut mattis nulla placerat et.</p>
                        </div>
                    </div>
                </article>
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




/* 
* To change this license header, choose License Headers in Project Properties.
* To change this template file, choose Tools | Templates
* and open the template in the editor.
*/

