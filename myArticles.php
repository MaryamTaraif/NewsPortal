<?php
ob_start();
// Check if the user is not logged in, then redirect to login
include 'header.php';
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Author' && $_SESSION['role'] !== 'Admin') {
    header("Location: permission_denied.php");
    exit();
}
?>

<script>
    function deleteArticle(articleId) {
    if (confirm("Are you sure you want to delete this article?")) {
    // make an AJAX request
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState === 4 && this.status === 200) {
        // update the page
        if (this.responseText === "deleted") {
          location.reload();
          alert("Deleted Successfully");
        }
      }
    };
    xhttp.open("GET", "deleteArticle.php?d_id=" + articleId, true);
    xhttp.send();
  }
    }
    function publishArticle(articleId){
        if (confirm("Are you sure you want to publish this article?")) {
            // make an AJAX request
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    // update the page
                    if (this.responseText === "published") {
                        location.reload();
                        alert("Published Successfully");
                    }
                    else {
                        alert(this.responseText);
                    }
                }
            };
            xhttp.open("GET", "publishArticle.php?p_id=" + articleId, true);
            xhttp.send();
        }
        
    }
   
</script>
		<section class="category">
		  <div class="container" style="padding-top: 200px;">
		    <div class="row">
		      <div class="col-md-8 text-left">
		        <div class="row">
		          <div class="col-md-12">        
		            <ol class="breadcrumb">
		              <li><a href="#">My Account</a></li>
		              <li class="active">My Articles</li>
		            </ol>
                              <br /><h1 class="page-title">My Articles</h1>
		            <p class="page-subtitle">Showing all articles written by <i><?php echo $_SESSION['username'] ?></i></p>
		          </div>
		        </div>
                            <?php 
                            if (isset($_GET['message'])) {
                                $successMessage = urldecode($_GET['message']);
                                echo '<div class="alert alert-success" style="color:seagreen">'.$successMessage.'<button class="close" type="button" onclick="this.parentElement.style.display=\'none\';">
                                <span>&times;</span>
                            </button> </div>';
                            }
                            ?>
		        <div class="row">
                            <?php
                            // Pagination variables
                            $itemsPerPage = 5; // Number of items per page (5 for each section so total of max 10 is oermitted for a page)
                            $currentPage = isset($_GET['page']) ? $_GET['page'] : 1; // Current page number

                            // Draft articles section
                            $draftArticles = Article::authorDraftArticles($_SESSION['user_id']);
                            if (!empty($draftArticles)){
                            $totalDraftArticles = count($draftArticles);
                            $totalDraftPages = ceil($totalDraftArticles / $itemsPerPage);

                            echo '<div class="line">
                                    <div>Draft Articles</div>
                                  </div>';
                            $startDraft = ($currentPage - 1) * $itemsPerPage;
                            $endDraft = $startDraft + $itemsPerPage;
                            $draftArticlesPage = array_slice($draftArticles, $startDraft, $itemsPerPage);

                            foreach ($draftArticlesPage as $article) {
                              echo '<article class="col-md-12 article-list">
		            <div class="inner">
		              <figure>
                                <img src="'. Media::getPhotoURL($article->article_id)->URL .'">
		              </figure>
		              <div class="details">
		                <div class="detail">
		                  <div class="category">
		                   <a href="#">'. Article::getCatName($article->category_id) .'</a> 
		                  </div>
                                  <div class="time">'.$article->publish_date .'</div>
		                </div>
		                <h1>'.$article->title .'</h1>
		                <p>
		                  '.$article->description .'
		                </p>
		                <footer>
                                <a class="btn btn-primary more" href="addArticle.php?id='.$article->article_id.'"> 
		                    <div>Edit</div>
		                    <div><i class="ion-ios-arrow-thin-right"></i></div>
		                  </a>
                                  <a href="#" class="love" onclick="deleteArticle('.$article->article_id .')"><i class="ion-android-delete"></i></a>
		                  <a class="btn btn-primary more" onclick="publishArticle('.$article->article_id .')"> 
		                    <div>Publish</div>
		                    <div><i class="ion-ios-arrow-thin-right"></i></div>
		                  </a>
		                </footer>
		              </div>
		            </div>
		          </article>';
                            }
                            }
                            
                            // Published articles section
                            $publishedArticles = Article::authorPublishedArticles($_SESSION['user_id']);
                            if (!empty($publishedArticles)){
                            $totalPublishedArticles = count($publishedArticles);
                            $totalPublishedPages = ceil($totalPublishedArticles / $itemsPerPage);

                            echo '<div class="line">
                                    <div>Published Articles</div>
                                  </div>';

                            $startPublished = ($currentPage - 1) * $itemsPerPage;
                            $endPublished = $startPublished + $itemsPerPage;
                            $publishedArticlesPage = array_slice($publishedArticles, $startPublished, $itemsPerPage);

                            foreach ($publishedArticlesPage as $article) {
                              // Display published article
                                echo '<article class="col-md-12 article-list">
		            <div class="inner">
		              <figure>
                                <img src="'. Media::getPhotoURL($article->article_id)->URL .'">
		              </figure>
		              <div class="details">
		                <div class="detail">
		                  <div class="category">
		                   <a href="#">'. Article::getCatName($article->category_id) .'</a>
		                  </div>
		                  <div class="time">'.$article->publish_date .'</div>
		                </div>
		                <h1><a href="singleArticle.php?aid= '.$article->article_id.'"">'.$article->title .'</a></h1>
		                <p>
		                  '.$article->description.'
		                </p>';
                                        if ($article->description !== "This article was removed by an administrator"){
                                            echo '<footer>
                                            <a class="btn btn-primary more" href="singleArticle.php?aid='.$article->article_id.'"> 
                                              <div>View</div>
                                              <div><i class="ion-ios-arrow-thin-right"></i></div>
                                            </a>
                                            </footer>';
                                        }
		                echo'</div>
                                      </div>
                                    </article>';
                            }
                            }
                            
                            
                            // Pagination links
                            if ($totalDraftPages > 1 || $totalPublishedPages > 1 ){
                            echo '<div class="col-md-12 text-center">
                                    <ul class="pagination">';
                            if ($currentPage > 1) {
                                echo '<li class="prev"><a href="?page=' . ($currentPage - 1) . '"><i class="ion-ios-arrow-left"></i></a></li>';
                            }
                            for ($i = 1; $i <= max($totalDraftPages, $totalPublishedPages); $i++) {
                                if ($i <= $totalDraftPages || $i <= $totalPublishedPages) {
                                    echo '<li' . ($i == $currentPage ? ' class="active"' : '') . '><a href="?page=' . $i . '">' . $i . '</a></li>';
                                }
                            }

                            if ($currentPage < max($totalDraftPages, $totalPublishedPages)) {
                                echo '<li class="next"><a href="?page=' . ($currentPage + 1) . '"><i class="ion-ios-arrow-right"></i></a></li>';
                            }
                            echo '</ul>
                                </div>';
                            }

                            ?>
                         
		        </div>
		      </div>
                        
                        <div class="col-md-4 sidebar">
                        <aside>
                        <div class="aside-body">
                            <div class="featured-author">
                            <?php 
                            $author = Users::getUserStats($_SESSION['user_id']);
                            if ($author){
                                echo '<div class="featured-author-inner">
                                    <div class="featured-author-cover" style="background-image: url(\'images/back2.jpg\');">
                                        <div class="badges">
                                            <div class="badge-item"><i class="ion-star"></i> PROFILE</div>
                                        </div>
                                        <div class="featured-author-center">
                                            <figure class="featured-author-picture">
                                                <img src="images/profilePic.png">
                                            </figure>
                                            <div class="featured-author-info">
                                                <h2 class="name">'. $author['username'] .'</h2>
                                                <div class="desc">'. $author['type_name'] .'</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="featured-author-body">
                                        <div class="featured-author-count">
                                            <div class="item">
                                                <a href="#">
                                                    <div class="name">Articles</div>
                                                    <div class="value">'. $author['article_count']  .'</div>														
                                                </a>
                                            </div>
                                            <div class="item">
                                                <a href="#">
                                                    <div class="name">Views</div>
                                                    <div class="value">'. $author['total_views'] .'</div>														
                                                </a>
                                            </div>
                                            <div class="item">
                                                <a href="#">
                                                    <div class="name">Likes</div>
                                                    <div class="value">'. $author['total_views'] .'</div>														
                                                </a>
                                            </div>
                                        </div>
                                        <div class="featured-author-quote">
                                            "Writing, to me, is simply thinking through my fingers."
                                        </div>
                                        
                                        
                                    </div>
                                </div>';
                            }
                            ?>
                            </div>
                        </div>
                    </aside>

 </div>
		    </div>
		  </div>
		</section>

<!-- footer -->
<?php  
include 'footer.html';
?>