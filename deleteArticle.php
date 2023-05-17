<?php
include 'debugging.php';
//get the id 
if (!isset($_GET['d_id']) || empty($_GET['d_id'])) {
    exit;
}
//delete article 
$deleted = Article::deleteArticle($_GET['d_id']);
if ($deleted){
    echo 'deleted';
}
?>
