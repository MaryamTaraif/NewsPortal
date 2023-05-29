<?php
include 'debugging.php';
if (!isset($_GET['p_id']) || empty($_GET['p_id'])) {
    exit;
}
////validate that it has media of type photo and either video aor audio before publishing 
//$valid = true;
//if (empty(Media::getPhotoURL($_GET['p_id']))) {
//    $valid = false;
//}
//if (empty(Media::getVideoURL($_GET['p_id'])) && empty(Media::getAudioURL($_GET['p_id']))) {
//    $valid = false;
//}
//
//if ($valid){
    $publish = Article::publish($_GET['p_id']);
    if ($publish){
        echo 'published';
    }
//}
//else {
//    echo 'Sorry, this article is still incomplete.';
//}
    
?>
