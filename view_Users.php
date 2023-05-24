<?php


include 'header.php';

echo '<h1> Users </h1>';


$users = new Users();
$row = $users->getAllusers();

if (!empty($row)) {
    echo '<br />';
    //display a table of results
    echo '<table align="center" cellspacing = "2" cellpadding = "4" width="75%">';
    echo '<tr bgcolor="#87CEEB">
          <td><b>Edit</b></td>
          <td><b>Delete</b></td>
          <td><b><a href="view_Users.php">username</a></b></td>
          <td><b><a href="view_Users.php">email</a></b></td>
          <td><b><a href="view_Users.php">type_name</a></b></td></tr>';


//above is the header
//loop below adds the User details    
    //use the following to set alternate backgrounds 
    $bg = '#eeeeee';

    for ($i = 0; $i < count($row); $i++) {
        $bg = ($bg == '#eeeeee' ? '#ffffff' : '#eeeeee');

        echo '<tr bgcolor="' . $bg . '">
            <td><a href="edit_User.php?id=' . $row[$i]->user_id . '">Edit</a></td>
            <td><a href="delete_User.php?id=' . $row[$i]->user_id . '">Delete</a></td>
                <td>' . $row[$i]->user_id . '</td>
            <td>' . $row[$i]->username . '</td>
                <td>' . $row[$i]->password . '</td>
            <td>' . $row[$i]->email . '</td>
                <td>' . $row[$i]->type_name . '</td>
              </tr>';
    }
    echo '</table>';
} else {
    echo '<p class="error">' . $q . '</p>';
    echo '<p class="error"> Oh dear. There was an error</p>';
    echo '<p class="error">' . mysqli_error($dbc) . '</p>';
}


include 'footer.html';
?>
