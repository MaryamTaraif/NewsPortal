<?php
include 'header.php';
$id = $_GET['aid'];

//get article details
$article = new Article();
$article->initWithId($id);

//get author details
$author = new Users();

//get media details
$media = new Media();




?>
<script>
function removeComment(comment_id) {
    if (confirm("Are you sure you want to remove this comment?")) {
        // make an AJAX request
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                // update the page
                if (this.responseText == true) {
                    location.reload();
                    alert("Deleted Successfully");
                }
                else {
                    alert(this.responseText);
                }
            }
        };
        xhttp.open("GET", "removeComment.php?c_id=" + comment_id, true);
        xhttp.send();
    }
}
</script>



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
                        <!-- get the recent article-->
                        <?php
                        $recentArticle = Article::getRecentArticle();

                        if ($recentArticle) {
                            $recentId = $recentArticle->article_id;
                            $recentTitle = $recentArticle->title;
                            $recentDescription = $recentArticle->description;

                            echo '<article class="article-fw">
                                <div class="inner">
                                    <figure>
                                        <a href="singleArticle.php?aid='.$recentId . '">
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

            </div>
            <!-- show artcile details -->
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

                        <!-- Check each media existence and display it if found -->
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
                        <!-- show author details -->
                        <div class="details">
                            <h5 class="name"  >
                                <?php
                                $author->initWithUid($article->getUser_id());
                                echo $author->getUsername();
                                ?>
                            </h5>
                            <h7>
                                <a href="mailto:<?php echo $author->getEmail(); ?>">
                                    <?php echo $author->getEmail(); ?></a>
                            </h7>
                        </div>
                    </div>

                    <div class="line thin"></div>
        <div class="comments">
    <h2 class="title">
        <!-- Retrieve the total number of comments on this article and display them -->
        <?php
        $commentCount = Article::countComments($id);
        echo $commentCount . ' Comments';
        ?>
        <a href="#">Write a Comment</a>
    </h2>
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
                    <div class="description" style="margin-top: 10px; padding-left: 10px;">' . $comments[$i]->content . '</div>';
                
                if ($_SESSION['role'] == 'Admin' && $comments[$i]->content != "This comment was removed by an administrator") {
                    echo '<a href="#" class="love" style="float: right; margin-left: 3px;" onclick="removeComment(' . $comments[$i]->comment_id . ')"><i class="ion-android-delete" ></i></a>';
                }
                
                echo '
                    </div>
                </div>
            </div>';
            }
        }
        // Verify if no comments are found on the article
        else {
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
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <button class="btn btn-primary" onclick="performTask()">Perform Task</button>
                    <?php else: ?>
                        <a href="loginPage.php" class="btn btn-primary">submit</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</section>






<?php include 'footer.html' ?>;



