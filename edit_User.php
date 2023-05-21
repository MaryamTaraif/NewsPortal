<?php
  // Update the user details in the database
    $update_query = "UPDATE dbProj_User SET username='$username', email='$email', password='$password' WHERE id='$user_id'";
    mysqli_query($this->dblink, $update_query);

    // Redirect back to the admin panel
    header('Location: admin.php');

// Get the user ID from the URL parameter
$user_id = $_GET['id'];

// Get the user details from the database
$user_query = "SELECT * FROM dbProj_User WHERE id='$user_id'";
$user_result= mysqli_query($this->dblink, $user_query);
$user = mysqli_fetch_assoc($user_result);

// Display the form to edit the user details
echo "<h2>Edit User</h2>";
echo "<form method='post' action='edit_User.php'>";
echo "<input type='hidden' name='id' value='".$user['user_id']."'>";
echo "<label for='username'>Username:</label>";
echo "<input type='text' id='username' name='username' value='".$user['username']."'><br>";
echo "<label for='email'>Email:</label>";
echo "<input type='email' id='email' name='email' value='".$user['email']."'><br>";
echo "<label for='password'>Password:</label>";
echo "<input type='password' id='password' name='password'><br>";
echo "<input type='submit' name='submit' value='Save'>";
echo "</form>";
