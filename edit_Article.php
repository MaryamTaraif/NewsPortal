<?php

// Check if a form has been submitted to edit an article
if(isset($_POST['edit_Article'])) {
    // Get the article ID and updated title and content from the form
    $article_id = $_POST['article_id'];
    $article_title = mysqli_real_escape_string($this->dblink, $_POST['title']);
    $article_content = mysqli_real_escape_string($this->dblink, $_POST['content']);

    // Update the article in the database
    $edit_query = "UPDATE dbProj_Article SET title='$title', content='$content' WHERE id='$article_id'";
    mysqli_query($this->dblink, $edit_query);

    // Redirect the admin back to the article list page
    header('Location: Article.php');
}

// Get the article ID from the URL parameter
$article_id = $_GET['id'];

// Get the article from the database
$article_query = "SELECT * FROM dbProj_Article WHERE id='$article_id'";
$article_result = mysqli_query($this->dblink, $article_query);
$row = mysqli_fetch_assoc($article_result);
