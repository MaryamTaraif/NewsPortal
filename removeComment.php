<?php

include 'debugging.php';
//get the id 
if (!isset($_GET['c_id']) || empty($_GET['c_id'])) {
    exit;
}
//delete article 
$deleted = Comment::removeComment($_GET['c_id']);
if ($deleted) {
    echo true;
}
?>


