<?php


// Include the necessary classes and initialize the database connection
include 'Article.php';
$db = new Database();

// Get the article ID from the query string
$articleId = $_GET['article_id'];

// Call the incrementDislikes() method in the Article class to update the dislikes count for the article with the specified ID
$article = new Article();
$article->updateArticleLikes($articleId);

// Return the new dislikes count as JSON
$data = ['dislikes' => $article->getDislikes($articleId)];
echo json_encode($data);