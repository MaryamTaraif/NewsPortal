<?php

// Check if a user has been marked for deletion
if(isset($_POST['delete_User'])) {
    // Get the user ID and delete the user account from the database
    $user_id = $_POST['user_id'];
    $delete_query = "DELETE FROM dbProj_User WHERE id='$user_id'";
    mysqli_query($this->dblink, $delete_query);
}
