<?php
// Check if the user is not logged in, then redirect to login
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Author') {
    header("Location: loginPage.php");
    exit();
}
include 'header.php';
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
                    } 
                }
            };
            xhttp.open("GET", "publishArticle.php?p_id=" + articleId, true);
            xhttp.send();
        }
    }
</script>
		<section class="category">
		  <div class="container" style="padding-top: 180px;">
		    <div class="row">
		      <div class="col-md-8 text-left">
		        <div class="row">
		          <div class="col-md-12">        
		            <ol class="breadcrumb">
		              <li><a href="#">Home</a></li>
		              <li class="active">My Articles</li>
		            </ol>
		            <h1 class="page-title">My Articles</h1>
		            <p class="page-subtitle">Showing all articles written by <i><?php echo $_SESSION['username'] ?></i></p>
		          </div>
		        </div>
		        
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
		                  <a href="#" class="love"><i class="ion-android-favorite-outline"></i> <div>'. $list[$i]->rating .'</div></a>
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
<!--               side bar          -->
<!--		      <div class="col-md-4 sidebar">
		        <aside>
		          <div class="aside-body">
		            <figure class="ads">
			            <a href="single.html">
			              <img src="images/ad.png">
			            </a>
		              <figcaption>Advertisement</figcaption>
		            </figure>
		          </div>
		        </aside>
		        <aside>
		          <h1 class="aside-title">Recent Post</h1>
		          <div class="aside-body">
		            <article class="article-fw">
		              <div class="inner">
		                <figure>
			                <a href="single.html">
			                  <img src="images/news/img12.jpg">
			                </a>
		                </figure>
		                <div class="details">
		                  <h1><a href="single.html">Lorem Ipsum Dolor Sit Amet Consectetur Adipisicing Elit</a></h1>
		                  <p>
		                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		                    tempor incididunt ut labore et dolore magna aliqua.
		                  </p>
		                  <div class="detail">
		                    <div class="time">December 26, 2016</div>
		                    <div class="category"><a href="category.html">Lifestyle</a></div>
		                  </div>
		                </div>
		              </div>
		            </article>
		            <div class="line"></div>
		            <article class="article-mini">
		              <div class="inner">
		              <figure>
			              <a href="single.html">
			                <img src="images/news/img05.jpg">
		                </a>
		              </figure>
		              <div class="padding">
		                <h1><a href="single.html">Duis aute irure dolor in reprehenderit in voluptate velit</a></h1>
		                <div class="detail">
		                  <div class="category"><a href="category.html">Lifestyle</a></div>
		                  <div class="time">December 22, 2016</div>
		                </div>
		              </div>
		              </div>
		            </article>
		            <article class="article-mini">
		              <div class="inner">
		                <figure>
			                <a href="single.html">
			                  <img src="images/news/img02.jpg">
		                  </a>
		                </figure>
		                <div class="padding">
		                  <h1><a href="single.html">Fusce ullamcorper elit at felis cursus suscipit</a></h1>
		                  <div class="detail">
		                    <div class="category"><a href="category.html">Travel</a></div>
		                    <div class="time">December 21, 2016</div>
		                  </div>
		                </div>
		              </div>
		            </article>
		            <article class="article-mini">
		              <div class="inner">
		                <figure>
			                <a href="single.html">
			                  <img src="images/news/img13.jpg">
		                  </a>
		                </figure>
		                <div class="padding">
		                  <h1><a href="single.html">Duis aute irure dolor in reprehenderit in voluptate velit</a></h1>
		                  <div class="detail">
		                    <div class="category"><a href="category.html">International</a></div>
		                    <div class="time">December 20, 2016</div>
		                  </div>
		                </div>
		              </div>
		            </article>
		          </div>
		        </aside>
		        <aside>
		          <div class="aside-body">
		            <form class="newsletter">
		              <div class="icon">
		                <i class="ion-ios-email-outline"></i>
		                <h1>Newsletter</h1>
		              </div>
		              <div class="input-group">
		                <input type="email" class="form-control email" placeholder="Your mail">
		                <div class="input-group-btn">
		                  <button class="btn btn-primary"><i class="ion-paper-airplane"></i></button>
		                </div>
		              </div>
		              <p>By subscribing you will receive new articles in your email.</p>
		            </form>
		          </div>
		        </aside>
		      </div>-->
		    </div>
		  </div>
		</section>

<!-- footer -->
<?php  
include 'footer.html';
?>