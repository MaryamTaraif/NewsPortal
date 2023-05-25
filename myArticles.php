<?php
ob_start();
// Check if the user is not logged in, then redirect to login
include 'header.php';
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Author') {
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
                              <h1 class="page-title">Manage Users</h1>
                              <a href="view_Users.php">Display Users</a>
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
                            
                            //get the list of articles 
                            $list = Article::authorDraftArticles($_SESSION['user_id']);
                            //if the result if not empty 
                            if (!empty($list)) {
                               echo ' <div class="line">
                                        <div>Draft Articles</div>
                                    </div>';
                                //loop through and display 
                                    for ($i = 0; $i < count($list); $i++ ) {
                                        echo '<article class="col-md-12 article-list">
		            <div class="inner">
		              <figure>
                                <img src="'. Media::getPhotoURL($list[$i]->article_id)->URL .'">
		              </figure>
		              <div class="details">
		                <div class="detail">
		                  <div class="category">
		                   <a href="#">'. Article::getCatName($list[$i]->category_id) .'</a> 
		                  </div>
                                  <div class="time">'.$list[$i]->publish_date .'</div>
		                </div>
		                <h1><a href="singleArticle.php?aid= '.$list[$i]->article_id.'"">'.$list[$i]->title .'</a></h1>
		                <p>
		                  '.$list[$i]->description .'
		                </p>
		                <footer>
                                <a class="btn btn-primary more" href="addArticle.php?id='.$list[$i]->article_id.'"> 
		                    <div>Edit</div>
		                    <div><i class="ion-ios-arrow-thin-right"></i></div>
		                  </a>
                                  <a href="#" class="love" onclick="deleteArticle('.$list[$i]->article_id .')"><i class="ion-android-delete"></i></a>
		                  <a class="btn btn-primary more" onclick="publishArticle('.$list[$i]->article_id .')"> 
		                    <div>Publish</div>
		                    <div><i class="ion-ios-arrow-thin-right"></i></div>
		                  </a>
		                </footer>
		              </div>
		            </div>
		          </article>';
                                    }
                            }
                            
                            ?>
                            
                            <?php
                            //get the list of articles 
                            $list = Article::authorPublishedArticles($_SESSION['user_id']);
                            //if the result if not empty 
                            if (!empty($list)) {
                               echo ' <div class="line">
                                        <div>Published Articles</div>
                                    </div>';
                                //loop through and display 
                                    for ($i = 0; $i < count($list); $i++) {
                                        echo '<article class="col-md-12 article-list">
		            <div class="inner">
		              <figure>
                                <img src="'. Media::getPhotoURL($list[$i]->article_id)->URL .'">
		              </figure>
		              <div class="details">
		                <div class="detail">
		                  <div class="category">
		                   <a href="#">'. Article::getCatName($list[$i]->category_id) .'</a>
		                  </div>
		                  <div class="time">'.$list[$i]->publish_date .'</div>
		                </div>
		                <h1><a href="singleArticle.php?aid= '.$list[$i]->article_id.'"">'.$list[$i]->title .'</a></h1>
		                <p>
		                  '.$list[$i]->description .'
		                </p>
		                <footer>
		                  <a href="#" class="love"><i class="ion-android-favorite-outline"></i> <div>'. $list[$i]->likes .'</div></a>
		                  <a class="btn btn-primary more" href="singleArticle.php?aid='.$list[$i]->article_id.'"> 
		                    <div>View</div>
		                    <div><i class="ion-ios-arrow-thin-right"></i></div>
		                  </a>
		                </footer>
		              </div>
		            </div>
		          </article>';
                                    }
                            }
                            ?>
                          <!--               pagination         -->  
		          <div class="col-md-12 text-center">
		            <ul class="pagination">
		              <li class="prev"><a href="#"><i class="ion-ios-arrow-left"></i></a></li>
		              <li class="active"><a href="#">1</a></li>
		              <li><a href="#">2</a></li>
		              <li><a href="#">3</a></li>
		              <li><a href="#">...</a></li>
		              <li><a href="#">97</a></li>
		              <li class="next"><a href="#"><i class="ion-ios-arrow-right"></i></a></li>
		            </ul>
		            <div class="pagination-help-text">
		            	Showing 8 results of 776 &mdash; Page 1
		            </div>
		          </div>
		        </div>
		      </div>
                        
                        <div class="col-md-4 sidebar">
                        <aside>
                        <div class="aside-body">
                            <div class="featured-author">
                                <div class="featured-author-inner">
                                    <div class="featured-author-cover" style="background-image: url('images/back2.jpg');">
                                        <div class="badges">
                                            <div class="badge-item"><i class="ion-star"></i> PROFILE</div>
                                        </div>
                                        <div class="featured-author-center">
                                            <figure class="featured-author-picture">
                                                <img src="images/profilePic.png">
                                            </figure>
                                            <div class="featured-author-info">
                                                <h2 class="name"><?php echo $_SESSION['username']?></h2>
                                                <div class="desc"><?php echo $_SESSION['role']?></div>
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
<!--               side bar          -->
            <?php 
            //get authors tops 
            $tops = Article::getAuthorTops($_SESSION['user_id']);
            if (!empty($tops)){
                echo '<aside>
                        <h1 class="aside-title">Your Top Articles </h1> <div class="aside-body">';
                for ($i = 0; $i < count($tops); $i++) {
                    echo '<article class="article-mini">
                                            <div class="inner">
                                                <figure>
                                                    <a href="singleArticle.php?aid='. $tops[$i]->article_id .'">
                                                      <img src="'. Media::getPhotoURL($tops[$i]->article_id)->URL .'">
                                                    </a>
                                                </figure>
                                                <div class="padding">
                                                    <h1><a href="singleArticle.php?aid='. $tops[$i]->article_id .'">'. $tops[$i]->title .'</a></h1>
                                                </div>
                                            </div>
                                        </article>';
                }
                echo '</div> </aside>';
            }
            else 

        ?>
 </div>
		    </div>
		  </div>
		</section>

<!-- footer -->
<?php  
include 'footer.html';
?>