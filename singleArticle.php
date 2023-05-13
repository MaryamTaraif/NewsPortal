<?php
include 'header.php';
$id = $_GET['aid'];
$article = new Article();
$article->initWithId($id);

//get author details
$author = new Users();

//get media details
$media = new Media();
?>

<section class="single">
    <div class="container" style="padding-top: 180px;">
        <div class="row">
            <div class="col-md-4 sidebar" id="sidebar">
                <aside>
                    <div class="aside-body">
                        <figure class="ads">
                            <img src="images/ad_copy.png">
                            <figcaption>Advertisement</figcaption>
                        </figure>
                    </div>
                </aside>
                <aside>
                    <h1 class="aside-title">Recent Post</h1>
                    <div class="aside-body">
                        <?php
                        $recentArticle = Article::getRecentArticle();

                        if ($recentArticle) {
                            $recentId = $recentArticle->id;
                            $recentTitle = $recentArticle->title;
                            $recentDescription = $recentArticle->description;

                            echo '<article class="article-fw">
                                <div class="inner">
                                    <figure>
                                        <a href="singleArticle.php?aid=' . $recentId . '">
                                            <img src="images/news/img16.jpg">
                                        </a>
                                    </figure>
                                    <div class="details">
                                        <h1><a href="singleArticle.php?aid=' . $recentId . '">' . $recentTitle . '</a></h1>
                                        <p>' . $recentDescription . '</p>
                                        <div class="detail">
                                            <div class="time">' . $recentArticle->publish_date . '</div>
                                        </div>
                                    </div>
                                </div>
                            </article>';
                        } else {
                            echo "<p>No recent articles found.</p>";
                        }
                        ?>
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
            </div>
            <div class="col-md-8">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active"><?php echo $article->getCatName($article->getCategory_id()) ?></li>
                </ol>
                <article class="article main-article">
                    <header>
                        <h1><?php echo $article->getTitle(); ?></h1>
                        <ul class="details">
                            <li>Posted on <?php echo $article->getPublish_date() ?></li>
                            <li><?php echo $article->getCatName($article->getCategory_id()) ?></li>
                            <li>
                                <?php
                                $author->initWithUid($article->getUser_id());
                                echo 'By ' . $author->getUsername();
                                ?>
                            </li>
                        </ul>
                    </header>

                    <div class="main">
                        <div class="featured">
                            <figure>
                                <img src="<?php echo $media->getPhotoURL($id)->URL ?>" width="width" height="height" />
                                <figcaption>Image by magz</figcaption>
                            </figure>
                        </div>

                        <p><?php echo $article->getContent(); ?> </p>

                        <?php
                        $videoURL = $media->getVideoURL($id);
                        if ($videoURL) {
                            echo '
                                <div class="line">
                                    <div>Video</div>
                                </div>
                                <aside style="display: flex; justify-content: center; align-items: center; flex-direction: column; text-align: center;">
                                    <div class="aside-body">   
                                        <video width="420" height="240" controls>
                                            <source src="' . $videoURL->URL . '" type="video/mp4">
                                        </video>
                                    </div>
                                </aside>';
                        }
                        ?>

                        <?php
                        $audioURL = $media->getAudioURL($id);
                        if ($audioURL) {
                            echo '
                                <div class="line">
                                    <div>Audio</div>
                                </div>
                                <aside style="display: flex; justify-content: center; align-items: center; flex-direction: column; text-align: center;">
                                    <div class="aside-body">     
                                        <audio controls>
                                            <source src="' . $audioURL->URL . '" type="audio/ogg">
                                        </audio>
                                    </div>
                                </aside>';
                        }
                        ?>

                        <?php
                        $fileURL = $media->getDownloadableFile($id);
                        if ($fileURL) {
                            echo '
                                <div class="line">
                                    <div>Downloadable File</div>
                                </div>
                                <aside style="display: flex; justify-content: center; align-items: center; flex-direction: column; text-align: center;">
                                    <div class="aside-body">
                                        <a href="' . $fileURL->URL . '">Download File</a>
                                    </div>
                                </aside>';
                        }
                        ?>
                    </div>

                    <div class="line">
                        <div>Author</div>
                    </div>

                    <div class="author">
                        <figure>
                            <img src="images/user-writer.png">
                        </figure>
                        <div class="details">
                            <h4 class="name">
                                <?php
                                $author->initWithUid($article->getUser_id());
                                echo $author->getUsername();
                                ?>
                            </h4>
                        </div>
                    </div>
                    <div style="display: flex; justify-content: center; align-items: center;">
                        <ul class="social trp sm" style="list-style: none; padding: 0; display: flex;">
                            <li>
                                <a href="#" class="facebook" style="font-size: 16px; margin: 0 10px;">
                                    <svg><rect/></svg>
                                    <i class="ion-social-facebook"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="twitter" style="font-size: 16px; margin: 0 10px;">
                                    <svg><rect/></svg>
                                    <i class="ion-social-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="youtube" style="font-size: 16px; margin: 0 10px;">
                                    <svg><rect/></svg>
                                    <i class="ion-social-youtube"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="googleplus" style="font-size: 16px; margin: 0 10px;">
                                    <svg><rect/></svg>
                                    <i class="ion-social-googleplus"></i>
                                </a>
                            </li>
                        </ul>
                    </div>




                    <div class="line thin"></div>
                    <div class="comments">
                        <h2 class="title"> <?php
                            $commentCount = Article::countComments($id);
                            echo $commentCount . ' Comments';
                            ;
                            ?> <a href="#">Write a Comment</a></h2>
                        <div class="comment-list">
                            <?php
                            $comments = Article::getComments($id);
                            $commenterUsername = new Users();

                            if (!empty($comments)) {
                                for ($i = 0; $i < count($comments); $i++) {
                                    echo '<div class="item">
                        <div class="details">
                            <div class="user">
                                <figure style="margin-right: 10px;">
                                    <img src="images/user.png">
                                </figure>';
                                    $commenterUsername->initWithUid($comments[$i]->user_id);
                                    echo '<h5 class="name">' . $commenterUsername->getUsername() . '</h5>
                                        <div class="time" style="margin-top: -5px;">' . $commenterUsername->getType_name() . '</div>
                            <div class="description" style="margin-top: 10px; padding-left: 10px;">' . $comments[$i]->content . '</div>
                        </div>
                    </div>
                </div>';
                                }
                            } else {
                                echo '<p>No comments found on this article.</p>';
                            }
                            ?>
                        </div>
                    </div>



            </div>

            <div class="line">
                <div>Comment</div>
            </div>






            <form class="row">
                <div class="col-md-12">
                    <h3 class="title">Leave Your Comment</h3>
                </div>
                <div class="form-group col-md-4">
                    <label for="name">Name <span class="required"></span></label>
                    <input type="text" id="name" name="" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <label for="email">Email <span class="required"></span></label>
                    <input type="email" id="email" name="" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <label for="website">Website</label>
                    <input type="url" id="website" name="" class="form-control">
                </div>
                <div class="form-group col-md-12">
                    <label for="message">Response <span class="required"></span></label>
                    <textarea class="form-control" name="message" placeholder="Write your response ..."></textarea>
                </div>
                <div class="form-group col-md-12">
                    <button class="btn btn-primary">Send Response</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</section>





<?php include 'footer.html' ?>;



