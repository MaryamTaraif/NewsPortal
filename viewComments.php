<?php


include 'header.php';

echo ' <div class="container" style="padding-top: 200px;">';

echo '<h1> Comments </h1>';


$comments = new Comment();
$row = $comments->getAllComments();

if (!empty($row)) {
    echo '<br />';
    //display a table of results
    echo '<table align="center" cellspacing = "2" cellpadding = "4" width="75%">';
    echo '<tr bgcolor="#87CEEB">
          <td><b>Edit</b></td>
          <td><b>Delete</b></td>
          <td><b><a href="viewComments.php">Content</a></b></td>
          </tr>';

//above is the header
//loop below adds the user details    
    //use the following to set alternate backgrounds 
    $bg = '#eeeeee';

    for ($i = 0; $i < count($row); $i++) {
        $bg = ($bg == '#eeeeee' ? '#ffffff' : '#eeeeee');

        echo '<tr bgcolor="' . $bg . '">
            <td><a href="editComment.php?id=' . $row[$i]->comment_id . '">Edit</a></td>
            <td><a href="removeComment.php?id=' . $row[$i]->comment_id . '">Delete</a></td>
            <td>' . $row[$i]->content . '</td>
              </tr>';
    }
    echo '</table>';
} else {
    echo '<p class="error">' . $q . '</p>';
    echo '<p class="error"> No Comments to display</p>';
    echo '<p class="error">' . mysqli_error($dbc) . '</p>';
}
echo '</div>';


include 'footer.html';
?>
<?php

