<?php
include 'debugging.php';
if(!isset($_GET['u_id']) )
{
    exit;
}
else {
    $user = new Users();
    $user->initWithUid($_GET['u_id']);
    $deleted = $user->deleteuser();
    if ($deleted){
        echo true;
    }
}
?>
