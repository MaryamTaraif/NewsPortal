<?php 

include 'debugging.php';


$id = $_GET['id'];

$article = new Article();
$article->initWithId($id);

$result = Article::updateArticleDislikes($id);

echo $article->getLikes();
?>