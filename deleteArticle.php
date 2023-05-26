<?php
include 'debugging.php';
//get the id 
if (isset($_GET['d_id'])) {
    $deleted = Article::deleteArticle($_GET['d_id']); 
}
else if (isset ($_GET['admin_d_id'])){
    $deleted = Article::adminDeleteArticle($_GET['admin_d_id']);
}
else {
    exit;
}

if ($deleted){
    echo 'deleted';
}
?>
