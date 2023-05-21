<?php
// Check if a comment has been marked for removal
if(isset($_GET['removeComment'])) {
    // Get the comment ID and update the database to show that it was removed
    $comment_id = $_GET['removeComment'];
    $remove_query = "UPDATE dbProj_Comment SET removed_by_admin=1 WHERE id='$comment_id'";
    mysqli_query($this->dblink, $remove_query);
}

// Get all comments from the database
$comments_query = "SELECT * FROM dbProj_Comment";
$comments_result = mysqli_query($this->dblink, $comments_query);

// Display all comments in a table
echo "<h2>All Comments</h2>";
echo "<table>";
echo "<tr><th>ID</th><th>Author</th><th>Comment</th><th>Date</th><th>Actions</th></tr>";
while($row= mysqli_fetch_assoc($comments_result)) {
    // If the comment was removed by an admin, display a message instead of the comment text
    $comment_text = $row['comment'];
    if ($row['removed_by_admin']) {
        $comment_text = "This comment was removed by an administrator";
    }
    
    // Display the comment in a table row, along with links to remove the comment or view the user's profile
    echo "<tr><td>".$row["id"]."</td><td>".$row["author"]."</td><td>".$comment_text."</td><td>".$row["date"]."</td><td>";
    if (!$row['removed_by_admin']) {
        echo "<a href='AdminPanel.php?removeComment=".$row["id"]."'>Remove</a> | ";
    }
    echo "<a href='Users.php?id=".$row["user_id"]."'>View User</a></td></tr>";
}
echo "</table>";


