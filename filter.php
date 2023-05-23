<?php
include 'debugging.php';
$result = Article::searchByAuthor($_GET['author']);
if (!empty($result)) {
                                //loop through and display 
                                    for ($i = 0; $i < count($result); $i++) {
                                        echo '<article class="col-md-12 article-list">
		            <div class="inner">
		              <figure>
                                <img src="'. Media::getPhotoURL($result[$i]->article_id)->URL .'">
		              </figure>
		              <div class="details">
		                <div class="detail">
		                  <div class="category">
		                   <a href="#">'. $name .'</a>
		                  </div>
		                  <div class="time">'.$result[$i]->publish_date .'</div>
		                </div>
		                <h1><a href="singleArticle.php?aid='.$result[$i]->article_id.'"">'.$result[$i]->title .'</a></h1>
		                <p>
		                  '.$result[$i]->description .'
		                </p>
		                <footer>
		                  <a href="#" class="love"><i class="ion-android-favorite-outline"></i> <div>'. $result[$i]->rating .'</div></a>
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
                                echo '<h6>Result are empty.</h6>';
                            }
?>
