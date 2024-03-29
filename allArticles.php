<?php

include 'debugging.php';
$result = Article::getArticles();

//pagination 
$itemsPerPage = 10; // Number of items per page
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($currentPage - 1) * $itemsPerPage;
$end = $start + $itemsPerPage;
if (!empty($result)) {
    //loop through and display 
    for ($i = $start; $i < min($end, count($result)); $i++) {
        echo '<article class="col-md-12 article-list">
		            <div class="inner">
		              <figure>
                                <img src="' . Media::getPhotoURL($result[$i]->article_id)->URL . '">
		              </figure>
		              <div class="details">
		                <div class="detail">
		                  <div class="category">
		                   <a href="#">' . $name . '</a>
		                  </div>
		                  <div class="time">' . $result[$i]->publish_date . '</div>
		                </div>
		                <h1><a href="singleArticle.php?aid=' . $result[$i]->article_id . '"">' . $result[$i]->title . '</a></h1>
		                <p>
		                  ' . $result[$i]->description . '
		                </p>
		                <footer>
		                  <a class="btn btn-primary more" href="singleArticle.php?aid=' . $result[$i]->article_id . '"> 
		                    <div>More</div>
		                    <div><i class="ion-ios-arrow-thin-right"></i></div>
		                  </a>
		                </footer>
		              </div>
		            </div>
		          </article>';
    }
} else {
    echo '<h6>Oops, no articles yet.</h6>';
}

// Pagination links
$totalPages = ceil(count($result) / $itemsPerPage);
if ($totalPages > 1) {
    echo '<div class="col-md-12 text-center">
                                        <ul class="pagination">';
    if ($currentPage > 1) {
        echo '<li class="prev"><a href="#" onclick="showAll(' . ($currentPage - 1) . ')"><i class="ion-ios-arrow-left"></i></a></li>';
    }
    for ($i = 1; $i <= $totalPages; $i++) {
        echo '<li' . ($i == $currentPage ? ' class="active"' : '') . '><a href="#" onclick="showAll(' . $i . ')">' . $i . '</a></li>';
    }
    if ($currentPage < $totalPages) {
        echo '<li class="next"><a href="#" onclick="showAll(' . ($currentPage + 1) . ')"><i class="ion-ios-arrow-right"></i></a></li>';
    }
    echo '</ul></div>';
}
?>