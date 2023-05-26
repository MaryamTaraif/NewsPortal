<?php


include 'header.php';

echo '<h1> Articles </h1>';


$articles = new Article();
$row = $articles->getArticles();

if (!empty($row)) {
    echo '<br />';
    echo '<br />';
    echo '<br />';
    echo '<br />';
    echo '<br />';
    echo '<br />';
    echo '<br />';
    //display a table of results
    echo '<table align="center" cellspacing = "2" cellpadding = "4" width="75%">';
    echo '<tr bgcolor="#87CEEB">
          <td><b>Edit</b></td>
          <td><b>Delete</b></td>
          <td><b><a href="view_Articles.php">article_id</a></b></td>
          <td><b><a href="view_Articles.php">title</a></b></td>
          <td><b><a href="view_Articles.php">description</a></b></td>
          <td><b><a href="view_Articles.php">content</a></b></td>
          <td><b><a href="view_Articles.php">publish_date</a></b></td></tr>
          <td><b><a href="view_Articles.php">likes</a></b></td></tr>
          <td><b><a href="view_Articles.php">dislikes</a></b></td></tr>
          <td><b><a href="view_Articles.php">user_id</a></b></td></tr>
          <td><b><a href="view_Articles.php">category_id</a></b></td></tr>
          <td><b><a href="view_Articles.php">status</a></b></td></tr>
          <td><b><a href="view_Articles.php">views</a></b></td></tr>';


//above is the header
//loop below adds the Article details    
    //use the following to set alternate backgrounds 
    $bg = '#eeeeee';

    for ($i = 0; $i < count($row); $i++) {
        $bg = ($bg == '#eeeeee' ? '#ffffff' : '#eeeeee');

        echo '<tr bgcolor="' . $bg . '">
            <td><a href="edit_Article.php?id=' . $row[$i]->article_id . '">Edit</a></td>
            <td><a href="delete_Article.php?id=' . $row[$i]->article_id . '">Delete</a></td>
                <td>' . $row[$i]->article_id . '</td>
            <td>' . $row[$i]->title . '</td>
                <td>' . $row[$i]->description . '</td>
            <td>' . $row[$i]->content . '</td>
                <td>' . $row[$i]->publish_date . '</td>
                    <td>' . $row[$i]->likes . '</td>
                        <td>' . $row[$i]->dislikes . '</td>
                     <td>' . $row[$i]->user_id . '</td>
                         <td>' . $row[$i]->category_id . '</td>
                             <td>' . $row[$i]->status . '</td>
                                 <td>' . $row[$i]->views . '</td>
              </tr>';   
    }
    echo '</table>';
    echo '<br />';
} else {
    echo '<p class="error">' . $q . '</p>';
    echo '<p class="error"> Oh dear. There was an error</p>';
    echo '<p class="error">' . mysqli_error($dbc) . '</p>';
}


include 'footer.html';
?>
