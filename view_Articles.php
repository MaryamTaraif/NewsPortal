<?php
// Check if the user is not logged in, then redirect to login
ob_start();
include 'header.php';
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Admin') {
    header("Location: permission_denied.php");
    exit();
}

$articles = new Article();
$list = $articles->getArticles();
?>

<div class="container" style="padding-top: 200px;">
    <h1>Articles</h1>

    <?php
    // Check if the result is not empty
    if (!empty($list)) {
        echo '<div class="line">
                <div>All Articles</div>
              </div>';

        // Loop through and display each article
        foreach ($list as $article) {
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
                          <div class="time">'. $article->publish_date .'</div>
                        </div>
                        <h1><a href="singleArticle.php?aid='. $article->article_id .'">'. $article->title .'</a></h1>
                        <p>'. $article->description .'</p>
                        <footer>
                          <a class="btn btn-primary more"  href="addArticle.php?id='.$article->article_id.'"> 
                            <div>Edit</div>
                            <div><i class="ion-ios-arrow-thin-right"></i></div>
                          </a>
                          <a href="#" class="love" onclick="deleteArticle('. $article->article_id .')"><i class="ion-android-delete"></i></a>
                        </footer>
                      </div>
                    </div>
                  </article>';
        }
    } else {
        echo '<p>No Articles found!</p>';
    }
    ?>
</div>

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
</script>

<?php
include 'footer.html';
?>
