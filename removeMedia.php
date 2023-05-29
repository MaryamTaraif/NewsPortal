<?php

include 'debugging.php';

if (isset($_GET['media_id']) && !empty($_GET['media_id'])) {
    $removedFile = new Media();
    $removedFile->initWithId($_GET['media_id']);
    if ($removedFile->deleteMedia()) {
        echo "removed";
    } else {
        echo "error";
    }
} else {
    echo "error";
}
?>
