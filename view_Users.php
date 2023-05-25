<?php
include 'header.php';
echo '<div class="container" style="padding-top: 200px; margin-bottom: 70px;">';
echo '<h1> All Users </h1>';

$users = new Users();
$row = $users->getAllusers();

if (!empty($row)) {
    echo '<br />';
    // Display a table of results
    echo '<table align="center" cellspacing="2" cellpadding="4" width="100%" style="font-family: \'Raleway\', sans-serif; border-collapse: collapse; border: 1px solid #ddd;">';
    echo '<tr style="background-color: #f73f52; color: #ffffff;">
          <th style="padding: 10px; text-align: center; border: 1px solid #ddd;"></th>
          <th style="padding: 10px;  text-align: center;border: 1px solid #ddd;"></th>
          <th style="padding: 10px;  text-align: center;border: 1px solid #ddd;"><a href="view_Users.php" style="color: #ffffff; text-decoration: none;">user_id</a></th>
          <th style="padding: 10px;  text-align: center;border: 1px solid #ddd;"><a href="view_Users.php" style="color: #ffffff; text-decoration: none;">username</a></th>
          <th style="padding: 10px; text-align: center; border: 1px solid #ddd;"><a href="view_Users.php" style="color: #ffffff; text-decoration: none;">email</a></th>
          <th style="padding: 10px;  text-align: center;border: 1px solid #ddd;"><a href="view_Users.php" style="color: #ffffff; text-decoration: none;">type</a></th>
          </tr>';

    foreach ($row as $user) {
        echo '<tr style="background-color: #ffffff; border: 1px solid #ddd;">';
        echo '<td style="padding: 10px; text-align: center;border: 1px solid #ddd;" ><a href="edit_User.php?id=' . $user->user_id . '">Edit</a></td>';
        echo '<td style="padding: 10px; text-align: center;border: 1px solid #ddd;"><a href="delete_User.php?id=' . $user->user_id . '">Delete</a></td>';
        echo '<td style="padding: 10px;text-align: center; border: 1px solid #ddd;  text-align: center;">' . $user->user_id . '</td>';
        echo '<td style="padding: 10px; border: 1px solid #ddd;  text-align: center;">' . $user->username . '</td>';
        echo '<td style="padding: 10px; border: 1px solid #ddd;  text-align: center;">' . $user->email . '</td>';
        echo '<td style="padding: 10px; border: 1px solid #ddd;  text-align: center;">' . $user->type_name . '</td>';
        echo '</tr>';
    }

    echo '</table>';
} else {
    echo '<p>No users found.</p>';
}

echo '</div>';
include 'footer.html';
?>
