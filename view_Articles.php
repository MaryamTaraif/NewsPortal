<?php
ob_start();
include 'header.php';
// Check if the user not an admin, then redirect to permission denied page
if ($_SESSION['role'] !== 'Admin') {
    header("Location: permission_denied.php");
    exit();
}
if(isset($_GET['pageno']))
    $start = $_GET['pageno'];
        else $start = 0;
 
        $end = 10;
        
        $table = 'dbProj_Article';
$articles = new Article();
$list = $articles->getArticles($start, $end);
?>

<div class="container" style="padding-top: 200px; padding-bottom: 70px;">
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li><a href="#">My Account</a></li>
                <li class="active">Articles</li>
            </ol>
            <h1 class="page-title">All Articles</h1>
        </div>
    </div>
    <div class="line"></div>

    <div class="row">
        <?php
        // Check if the result is not empty
        if (!empty($list)) {
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
                                <h1>'. $article->title .'</h1>
                                <p>'. $article->description .'</p>';
                                if ($article->description !== "This article was removed by an administrator"){
                                    echo '<footer>
                                    <a class="btn btn-primary more" href="addArticle.php?id='.$article->article_id.'"> 
                                        <div>Edit</div>
                                        <div><i class="ion-ios-arrow-thin-right"></i></div>
                                    </a>
                                    <a href="#" class="love" onclick="deleteArticle('. $article->article_id .')"><i class="ion-android-delete"></i></a>
                                </footer>';
                                }
                                
                           echo  '</div>
                        </div>
                    </article>';
            }
             echo '<table align="center" cellspacing = "2" cellpadding = "4" width="75%"><tr><td>';
    $pagination = new Pagination();
    $pagination->totalRecords($table);
    $pagination->setLimit($end);
    $pagination->page("");
    echo $pagination->firstBack();
    echo $pagination->where();
    echo $pagination->nextLast();
    echo '</td></tr></table>';
        } else {
            echo '<div class="col-md-12">
                    <p>No Articles found!</p>
                  </div>';
        }
        ?>
    </div>
</div>

<script>
    function deleteArticle(articleId) {
        if (confirm("Are you sure you want to delete this article?")) {
            // Make an AJAX request
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    // Update the page
                    if (this.responseText === "deleted") {
                        location.reload();
                        alert("Deleted Successfully");
                    }
                }
            };
            xhttp.open("GET", "deleteArticle.php?admin_d_id=" + articleId, true);
            xhttp.send();
        }
    }
</script>

<?php
include 'footer.html';
?>
