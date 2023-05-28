<?php
include 'debugging.php';
if (isset($_GET['adminAuthor'])){
    $result = Article::searchByAuthor($_GET['adminAuthor']);
}
else if (isset ($_GET['author'])){
    $result = Article::searchByAuthor($_GET['author']);
}
else {
    exit;
}
$itemsPerPage = 10; // Number of items per page
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1; // Current page number

// Calculate the start and end positions for the current page
$start = ($currentPage - 1) * $itemsPerPage;
$end = $start + $itemsPerPage;
if (!empty($result)) {
                                //loop through and display 
                    for ($i = $start; $i < min($end, count($result)); $i++) {
                                        echo '<article class="col-md-12 article-list">
		            <div class="inner">
		              <figure>
                                <img src="'. Media::getPhotoURL($result[$i]->article_id)->URL .'">
		              </figure>
		              <div class="details">
		                <div class="detail">
		                  <div class="category">
		                   <a href="#">'. Article::getCatName($result[$i]->category_id) .'</a>
		                  </div>
		                  <div class="time">'.$result[$i]->publish_date .'</div>
		                </div>
		                <h1><a href="singleArticle.php?aid='.$result[$i]->article_id.'"">'.$result[$i]->title .'</a></h1>
		                <p>
		                  '.$result[$i]->description .'
		                </p>
		                <footer>
		                  <a href="#" class="love" style="display: inline-block; margin-right: 10px;" onclick="updateLikes(<?php echo $result[$i]->id; ?>)"><i class="fas fa-thumbs-up"></i><div>'. $result[$i]->likes .'</div></a>
                                  <a href="#" class="love"><i class="fas fa-thumbs-down"></i><div>'. $result[$i]->dislikes .'</div></a>
		                  <a class="btn btn-primary more" href="singleArticle.php?aid='.$result[$i]->article_id.'"> 
		                    <div>More</div>
		                    <div><i class="ion-ios-arrow-thin-right"></i></div>
		                  </a>
		                </footer>
		              </div>
		            </div>
		          </article>';
                                    }
                            }
                            else {
                                echo '<h6>Oops, no articles found with that author name.</h6>';
                            }
                            // Pagination links
                            $totalPages = ceil(count($result) / $itemsPerPage);
                            if (isset($_GET['author'])){
                            if ($totalPages > 1) {
                                echo '<div class="col-md-12 text-center">
                                        <ul class="pagination">';
                            if ($currentPage > 1) {
                              echo '<li class="prev"><a href="#" onclick="showArticleByAuthor(\'' . $_GET['author'] . '\', ' . ($currentPage - 1) . ')"><i class="ion-ios-arrow-left"></i></a></li>';
                            }
                            for ($i = 1; $i <= $totalPages; $i++) {
                              echo '<li' . ($i == $currentPage ? ' class="active"' : '') . '><a href="#" onclick="showArticleByAuthor(\'' . $_GET['author'] . '\', ' . $i . ')">' . $i . '</a></li>';
                            }
                            if ($currentPage < $totalPages) {
                              echo '<li class="next"><a href="#" onclick="showArticleByAuthor(\'' . $_GET['author'] . '\', ' . ($currentPage + 1) . ')"><i class="ion-ios-arrow-right"></i></a></li>';
                            }
                            echo '</ul>
                                  </div>';
                          }

                            }
                            else if (isset($_GET['adminAuthor'])){
                                if ($totalPages > 1) {
                                    echo '<div class="col-md-12 text-center">
                                        <ul class="pagination">';
                                if ($currentPage > 1) {
                                    echo '<li class="prev"><a href="#" onclick="showArticleByAuthor(' . ($currentPage - 1) . ')"><i class="ion-ios-arrow-left"></i></a></li>';
                                  }
                                  for ($i = 1; $i <= $totalPages; $i++) {
                                    echo '<li' . ($i == $currentPage ? ' class="active"' : '') . '><a href="#" onclick="showArticleByAuthor(' . $i . ')">' . $i . '</a></li>';
                                  }
                                  if ($currentPage < $totalPages) {
                                    echo '<li class="next"><a href="#" onclick="showArticleByAuthor(' . ($currentPage + 1) . ')"><i class="ion-ios-arrow-right"></i></a></li>';
                                  }
                                  echo '</ul>
                                  </div>';
                                 }
                            }
?>
