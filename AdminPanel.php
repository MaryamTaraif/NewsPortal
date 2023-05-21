<?php

// Get all viewers and news authors from the database
$viewers_query = "SELECT * FROM dbProj_User WHERE role='viewer'";
$viewers_result = mysqli_query($this->dblink, $viewers_query);
$authors_query = "SELECT * FROM dbProj_User WHERE role='author'";
$authors_result = mysqli_query($this->dblink, $authors_query);

// Display all viewers in a table
echo "<h2>Viewers</h2>";
echo "<table>";
echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Actions</th></tr>";
while($row = mysqli_fetch_assoc($viewers_result)) {
    echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td><td>".$row["email"]."</td><td><a href='edit_User.php?id=".$row["id"]."'>Edit</a> | <a href='delete_User.php?id=".$row["id"]."'>Delete</a></td></tr>";
}
echo "</table>";

// Display all news authors in a table
echo "<h2>News Authors</h2>";
echo "<table>";
echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Actions</th></tr>";
while($row = mysqli_fetch_assoc($authors_result)) {
    echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td><td>".$row["email"]."</td><td><a href='edit_User.php?id=".$row["id"]."'>Edit</a> | <a href='delete_User.php?id=".$row["id"]."'>Delete</a></td></tr>";
}
echo "</table>";

// Get all news articles from the database
$articles_query = "SELECT * FROM dbProj_Article";
$articles_result = mysqli_query($this->dblink, $articles_query);

// Display all news articles in a table
echo "<h2>News Articles</h2>";
echo "<table>";
echo "<tr><th>ID</th><th>Title</th><th>Category</th><th>Author</th><th>Date</th><th>Actions</th></tr>";
while($row = mysqli_fetch_assoc($articles_result)) {
    echo "<tr><td>".$row["id"]."</td><td>".$row["title"]."</td><td>".$row["category"]."</td><td>".$row["author"]."</td><td>".$row["date"]."</td><td><a href='edit_Article.php?id=".$row["id"]."'>Edit</a> | <a href='delete_Article.php?id=".$row["id"]."'>Delete</a></td></tr>";
}
echo "</table>";

// Display the form to create a new article
echo "<h2>Create New Article</h2>";
echo "<form method='post' action='create_article.php'>";
echo "<label for='title'>Title:</label>";
echo "<input type='text' id='title' name='title'><br>";
echo "<label for='category'>Category:</label>";
echo "<select id='category' name='category'>";
echo "<option value='International News'>International News</option>";
echo "<option value='Local News'>Local News</option>";
echo "<option value='Sports & Art News'>Sports & Art News</option>";
echo "<option value='Weather News'>Weather News</option>";
echo "<option value='Advertisement Section'>Advertisement Section</option>";
echo "<option value='Your selected Section'>Your selected Section</option>";
echo "</select><br>";
echo "<label for='author'>Author:</label>";
echo "<input type='text' id='author' name='author'><br>";
echo "<label for='content'>Content:</label>";
echo "<textarea id='content' name='content'></textarea><br>";
echo "<input type='submit' value='Create'>";
echo "</form>";


class AdminPanel {
    //put your code here
}
