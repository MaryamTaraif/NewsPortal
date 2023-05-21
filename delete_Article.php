<?php

// Check if an article has been marked for deletion
if(isset($_POST['delete_Article'])) {
    // Get the article ID and delete the article from the database
    $article_id = $_POST['article_id'];
    $delete_query = "DELETE FROM dbProj_Article WHERE id='$article_id'";
    mysqli_query($this->dblink, $delete_query);
}
