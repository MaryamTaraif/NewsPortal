<?php

include 'debugging.php';
if (!isset($_GET['p_id']) || empty($_GET['p_id'])) {
    exit;
}
$publish = Article::publish($_GET['p_id']);
if ($publish) {
    echo 'published';
}
?>
