<?php
include 'header.php';
$id = $_GET['cid'];
$name = Article::getCatName($id);
?>

<section class="category">
    <div class="container" style="padding-top: 200px;">
        <div class="row">
            <div class="col-md-8 text-left">
                <div class="row">
                    <div class="col-md-12">        
                        <ol class="breadcrumb">
                            <li><a href="#">Home</a></li>
                            <li class="active"><?php echo $name ?></li>
                        </ol>
                        <h1 class="page-title"><?php echo $name ?></h1>
                        <p class="page-subtitle">Showing all articles under category <i><?php echo $name ?></i></p>
                    </div>
                </div>
                <div class="line"></div>
                <div class="row">
                    <?php
                    // Get the total number of articles in the category
                    $totalArticles = count(Article::getCatArticles($id));

                    // Check if there are any articles in the category
                    if ($totalArticles > 0) {
                        // Set the number of articles to display per page
                        $articlesPerPage = 10;
                        // Calculate the total number of pages
                        $totalPages = ceil($totalArticles / $articlesPerPage);
                        // Get the current page number from the URL
                        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                        // Calculate the start and end limits for the articles
                        $start = ($currentPage - 1) * $articlesPerPage;
                        $end = $start + $articlesPerPage - 1;
                        // Get the list of articles for the current page
                        $list = Article::getCatArticles($id, $start, $end);

                        // Loop through and display the articles
                        foreach ($list as $article) {
                            echo '<article class="col-md-12 article-list">
                                <div class="inner">
                                    <figure>
                                        <img src="'. Media::getPhotoURL($article->article_id)->URL .'">
                                    </figure>
                                    <div class="details">
                                        <div class="detail">
                                            <div class="category">
                                                <a href="#">'. $name .'</a>
                                            </div>
                                            <div class="time">'. $article->publish_date .'</div>
                                        </div>
                                        <h1><a href="singleArticle.php?aid='.$article->article_id.'">'. $article->title .'</a></h1>
                                        <p>'. $article->description .'</p>
                                        <footer>
                                            <a class="btn btn-primary more" href="singleArticle.php?aid='.$article->article_id.'">
                                                <div>More</div>
                                                <div><i class="ion-ios-arrow-thin-right"></i></div>
                                            </a>
                                        </footer>
                                    </div>
                                </div>
                            </article>';
                        }

                        // Pagination
                        if ($totalPages > 1) {
                        echo '<div class="col-md-12 text-center">
                            <ul class="pagination">';
                        if ($currentPage > 1) {
                            echo '<li><a href="?cid='.$id.'&page='.($currentPage - 1).'">Prev</a></li>';
                        }
                        for ($i = 1; $i <= $totalPages; $i++) {
                            echo '<li'. ($i == $currentPage ? ' class="active"' : '') .'><a href="?cid='.$id.'&page='.$i.'">'.$i.'</a></li>';
                        }
                        if ($currentPage < $totalPages) {
                            echo '<li><a href="?cid='.$id.'&page='.($currentPage + 1).'">Next</a></li>';
                        }
                        echo '</ul>
                        </div>';
                        }
                    } else {
                        echo '<h6>Oops, no articles yet.</h6>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- footer -->
<?php  
include 'footer.html';
?>
