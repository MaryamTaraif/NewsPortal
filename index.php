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
                        for ($i = 0; $i < count($list); $i++) {
                            echo '<div class="item">
                                <article class="featured">
                                    <div class="overlay"></div>
                                    <figure>
                                        <img src="' . Media::getPhotoURL($list[$i]->article_id)->URL . '">
                                    </figure>
                                    <div class="details">
                                        <div class="category"><a href="category.html">' . Article::getCatName($list[$i]->category_id) . '</a></div>
                                        <h1><a href="singleArticle.php?aid=' . $list[$i]->article_id . '">' . $list[$i]->title . '</a></h1>
                                        <div class="time">' . $list[$i]->publish_date . '</div>
                                    </div>
                                </article>
                            </div>';
                        }
                        ?>
                    </div>

                    <div class="line">
                        <div>Latest News</div>
                    </div>
                    <?php
                    $list = Article::getArticles();

                    if (!empty($list)) {
                        // Display the articles
                        $articlesPerPage = 10; // Number of articles to display per page
                        $totalArticles = count($list);
                        $totalPages = ceil($totalArticles / $articlesPerPage);

                        // Check if a page number is specified in the URL
                        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                        $offset = ($currentPage - 1) * $articlesPerPage;
                        $articlesToDisplay = array_slice($list, $offset, $articlesPerPage);

                        for ($i = 0; $i < count($articlesToDisplay); $i += 2) {
                            echo '<div class="row">';
                            // Display the first article in the row
                            echo '<div class="col-md-6 col-sm-6 col-xs-12">
                                <article class="article">
                                    <div class="inner">
                                        <figure>
                                            <a href="singleArticle.php?aid=' . $articlesToDisplay[$i]->article_id . '">
                                                <img src="' . Media::getPhotoURL($articlesToDisplay[$i]->article_id)->URL . '">
                                            </a>
                                        </figure>
                                        <div class="padding">
                                            <div class="detail">
                                                <div class="time">' . $articlesToDisplay[$i]->publish_date . '</div>
                                                <div class="category"><a href="category.php?cid=' . $articlesToDisplay[$i]->category_id . '">' . Article::getCatName($articlesToDisplay[$i]->category_id) . '</a></div>
                                            </div>
                                            <h2>' . $articlesToDisplay[$i]->title . '</h2>
                                            <p>' . $articlesToDisplay[$i]->description . '</p>';
                            if ($articlesToDisplay[$i]->description !== "This article was removed by an administrator") {
                                echo '<footer>
                                        <a class="btn btn-primary more" href="singleArticle.php?aid=' . $articlesToDisplay[$i]->article_id . '">
                                            <div>More</div>
                                            <div><i class="ion-ios-arrow-thin-right"></i></div>
                                        </a>
                                    </footer>';
                            } else {
                                echo '<footer>
                                        <a class="btn btn-primary more" href="#">
                                            <div>More</div>
                                            <div><i class="ion-ios-arrow-thin-right"></i></div>
                                        </a>
                                    </footer>';
                            }
                            echo '</div>
                                </article>
                            </div>';

                            // Check if there is a second article in the row
                            if ($i + 1 < count($articlesToDisplay)) {
                                // Display the second article in the row
                                echo '<div class="col-md-6 col-sm-6 col-xs-12">
                                    <article class="article">
                                        <div class="inner">
                                            <figure>
                                                <a href="singleArticle.php?aid=' . $articlesToDisplay[$i + 1]->article_id . '">
                                                    <img src="' . Media::getPhotoURL($articlesToDisplay[$i + 1]->article_id)->URL . '">
                                                </a>
                                            </figure>
                                            <div class="padding">
                                                <div class="detail">
                                                    <div class="time">' . $articlesToDisplay[$i + 1]->publish_date . '</div>
                                                    <div class="category"><a href="category.php?cid=' . $articlesToDisplay[$i + 1]->category_id . '">' . Article::getCatName($articlesToDisplay[$i + 1]->category_id) . '</a></div>
                                                </div>
                                                <h2>' . $articlesToDisplay[$i + 1]->title . '</h2>
                                                <p>' . $articlesToDisplay[$i + 1]->description . '</p>';
                                if ($articlesToDisplay[$i + 1]->description !== "This article was removed by an administrator") {
                                    echo '<footer>
                                            <a class="btn btn-primary more" href="singleArticle.php?aid=' . $articlesToDisplay[$i + 1]->article_id . '">
                                                <div>More</div>
                                                <div><i class="ion-ios-arrow-thin-right"></i></div>
                                            </a>
                                        </footer>';
                                } else {
                                    echo '<footer>
                                            <a class="btn btn-primary more" href="#">
                                                <div>More</div>
                                                <div><i class="ion-ios-arrow-thin-right"></i></div>
                                            </a>
                                        </footer>';
                                }
                                echo '</div>
                                    </article>
                                </div>';
                            }
                            echo '</div>';
                        }


                        // Pagination
                        if ($totalPages > 1) {
                            echo '  <div class="col-md-12 text-center"> <ul class="pagination">';
                            if ($currentPage > 1) {
                                echo '<li><a href="?page=' . ($currentPage - 1) . '">&laquo;</a></li>';
                            }
                            for ($page = 1; $page <= $totalPages; $page++) {
                                echo '<li ' . ($page == $currentPage ? 'class="active"' : '') . '><a href="?page=' . $page . '">' . $page . '</a></li>';
                            }
                            if ($currentPage < $totalPages) {
                                echo '<li><a href="?page=' . ($currentPage + 1) . '">&raquo;</a></li>';
                            }
                            echo '</ul></div>';
                        }
                    } else {
                        echo '<p>No articles found.</p>';
                    }
                    ?>
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
                                                <h2 class="name">' . $top['username'] . '</h2>
                                                <div class="desc">' . $top['type_name'] . '</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="featured-author-body">
                                        <div class="featured-author-count">
                                            <div class="item">
                                                <a href="#">
                                                    <div class="name">Articles</div>
                                                    <div class="value">' . $top['article_count'] . '</div>														
                                                </a>
                                            </div>
                                            <div class="item">
                                                <a href="#">
                                                    <div class="name">Views</div>
                                                    <div class="value">' . $top['total_views'] . '</div>														
                                                </a>
                                            </div>
                                            <div class="item">
                                                <a href="#">
                                                    <div class="name">Likes</div>
                                                    <div class="value">' . $top['total_likes'] . '</div>														
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
<?php include 'footer.html' ?>


