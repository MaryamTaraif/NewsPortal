<?php
// Check if an article has been marked for removal
if(isset($_GET['removeArticle'])) {
    // Get the article ID and update the database to show that it was removed
    $article_id = $_GET['removeArticle'];
    $remove_query = "UPDATE dbProj_Article SET removed_by_admin=1 WHERE id='$article_id'";
    mysqli_query($this->dblink, $remove_query);
}

// Get all articles from the database
$articles_query = "SELECT * FROM dbProj_Article";
$articles_result = mysqli_query($this->dblink, $articles_query);

// Display all articles in a table
echo "<h2>All Articles</h2>";
echo "<table>";
echo "<tr><th>ID</th><th>Title</th><th>Category</th><th>Author</th><th>Date</th><th>Actions</th></tr>";
while($row= mysqli_fetch_assoc($articles_result)) {
    // If the article was removed by an admin, display a message instead of the article title
    $article_title = $row['title'];
    if ($row['removed_by_admin']) {
        $article_title = "This article was removed by an administrator";
    }
    
    // Display the article in a table row, along with links to remove the article or view/edit the article
    echo "<tr><td>".$row["id"]."</td><td>".$article_title."</td><td>".$row["category"]."</td><td>".$row["author"]."</td><td>".$row["date"]."</td><td>";
    if (!$row['removed_by_admin']) {
        echo "<a href='AdminPanel.php?remove_article=".$row["id"]."'>Remove</a> | ";
    }
    echo "<a href='view_article.php?id=".$row["id"]."'>View</a> | <a href='edit_Article.php?id=".$row["id"]."'>Edit</a></td></tr>";
}
echo "</table>";


