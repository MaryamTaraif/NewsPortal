<?php
include 'classes/Article.php';

$id = $_GET['id'];
$action = $_GET['action'];

$article = new Article();
$article->initWithId($id);

if ($action == 'like') {
    $article->setLikes($article->getLikes() + 1);
    $article->updateArticleLikes();
    echo $article->getLikes();
} elseif ($action == 'dislike') {
    $article->setDislikes($article->getDislikes() + 1);
    $article->updateArticleDislikes();
    echo $article->getDislikes();
}