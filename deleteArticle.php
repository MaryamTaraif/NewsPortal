<?php

include 'debugging.php';
//get the id and determine if the request from author or admin
if (isset($_GET['d_id'])) {
    //delete the article from DB (author delete his own article)
    $deleted = Article::deleteArticle($_GET['d_id']);
} else if (isset($_GET['admin_d_id'])) {
    //call adminDelete to update the article and set to "removed by admin"
    $deleted = Article::adminDeleteArticle($_GET['admin_d_id']);
} else {
    exit;
}

if ($deleted) {
    echo 'deleted';
}
?>
