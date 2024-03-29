<?php
// Check if the user is not logged in or not author, then show restriction
ob_start();
include 'header.php';
if ($_SESSION['role'] !== 'Author' && $_SESSION['role'] !== 'Admin') {
    header("Location: permission_denied.php");
    exit();
}
//check if this is an edit request, then get the article data   
$edit = false;
if (isset($_GET['id'])) {
    $article = new Article();
    $article->initWithId($_GET['id']);
    $edit = true;

    //get media for the edited article 
    $photo = Media::getPhotoURL($article->getArticle_id());
    if (!empty(Media::getVideoURL($article->getArticle_id()))) {
        $video = Media::getVideoURL($article->getArticle_id());
    }
    if (!empty(Media::getAudioURL($article->getArticle_id()))) {
        $audio = Media::getAudioURL($article->getArticle_id());
    }
    if (!empty(Media::getDownloadableFile($article->getArticle_id()))) {
        $file = Media::getDownloadableFile($article->getArticle_id());
    }
}
?>
<script>
    //AJAX, function to send a request to remove attached file (as it's optional)
    function removeFile(mediaId) {
        if (confirm("Are you sure you want to remove this attached file?")) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    // update the page
                    if (this.responseText === "removed") {
                        location.reload();
                        alert("Removed Successfully");
                    }
                }
            };
            xhttp.open("GET", "removeMedia.php?media_id=" + mediaId, true);
            xhttp.send();
        }
    }
</script>


<section class="page">
    <div class="container" >
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li><a href="#">My Account</a></li>
                    <li class="active"><?php
                        if ($edit)
                            echo 'Edit Article';
                        else
                            echo 'Add Article';
                        ?></li>
                </ol>
                <h1 class="page-title">
                    <?php
                    if ($edit)
                        echo 'Edit Article';
                    else
                        echo 'Add Article';
                    ?></h1>
                <p class="page-subtitle">Publish your thoughts</p>
                <div class="line thin"></div>
                <div id="messageContainer"></div>

                <div class="page-description">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <form action="" method="post" enctype="multipart/form-data" class="row contact">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Category <span class="required"></span></label>
                                        <select id="category" name="category" class="form-control" required>
                                            <?php
                                            //populate the dropdown list with categories and select specified one if form is submitted before or an edit form
                                            $list = Article::getAllCat();
                                            if (!empty($list)) {
                                                for ($i = 0; $i < count($list); $i++) {
                                                    if ($edit && $list[$i]->category_id == $article->getCategory_id()) {
                                                        echo '<option value="' . $list[$i]->category_id . '" selected>' . $list[$i]->category_name . '</option>';
                                                    } else if ($list[$i]->category_id == $_POST['category']) {
                                                        echo '<option value="' . $list[$i]->category_id . '" selected>' . $list[$i]->category_name . '</option>';
                                                    } else {
                                                        echo '<option value="' . $list[$i]->category_id . '">' . $list[$i]->category_name . '</option>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Title <span class="required"></span></label>
                                        <input type="text" class="form-control" name="title" required value="<?php
                                        if ($edit) {
                                            echo $article->getTitle();
                                        } if (isset($_POST['title'])) {
                                            echo $_POST['title'];
                                        }
                                        ?>">

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description <span class="required"></span></label>
                                        <input type="text" class="form-control" name="description" required value="<?php
                                        if ($edit) {
                                            echo $article->getDescription();
                                        } if (isset($_POST['description'])) {
                                            echo $_POST['description'];
                                        }
                                        ?>">


                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Content <span class="required"></span></label>
                                        <textarea class="form-control" name="content" required><?php
                                        if ($edit) {
                                            echo $article->getContent();
                                        } if (isset($_POST['content'])) {
                                            echo $_POST['content'];
                                        }
                                        ?></textarea>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Attachments </label> <br>
                                        <label>Photo <span class="required"></span></label>
                                        <?php
                                        if ($edit) {
                                            echo '<br><img src="' . $photo->URL . '" alt="Selected photo" style="width:350px; height:350px;">'
                                            . '<input type="file"  name="photo" accept="image/*" >';
                                        } else {
                                            echo '<input type="file"  name="photo" accept="image/*" required>';
                                        }
                                        ?>

                                    </div>
                                    <div class="form-group">
                                        <label>Video/Audio <span class="required"></span></label>
                                        <?php
                                        if (!empty($video)) {
                                            echo '<br><video controls>
                                                <source src="' . $video->URL . '" type="video/*"></video>
                                                <input type="file"  name="video/audio" accept="audio/*, video/*">';
                                        } else if (!empty($audio)) {
                                            echo '<br><audio controls>
                                                <source src="' . $audio->URL . '" type="audio/wav"></audio>
                                                <input type="file"  name="video/audio" accept="audio/*, video/*">';
                                        } else {
                                            echo '<input type="file"  name="video/audio" accept="audio/*, video/*" required>';
                                        }
                                        ?>


                                    </div>

                                    <div class="form-group">
                                        <label>Downloadable File </label>
<?php
if (!empty($file)) {
    echo '<br><a href="' . $file->URL . '"> ' . $file->URL . ' </a>';
    echo '<a href="#" onclick="removeFile(' . $file->media_id . ')">   <b>REMOVE</b></a>';
}
?>
                                        <input type="file"  name="downloadable">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <input type ="submit" class="btn btn-primary" value ="Save" />
                                </div>
                                <input type="hidden" name="submitted" value="1"/>
                                <input type ="hidden" name="id" value="<?php
if ($edit) {
    echo $article->getArticle_id();
}
?>">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
//once form is submitted 
if (isset($_POST['submitted'])) {
    // Initialize an array to store error messages
    $errors = array();

    //first thing, check for media and upload files to the server 
    if (!empty($_FILES)) {
        $upload = new Upload();
        $upload->setUploadDir('media/');

        // Upload photo file
        if (isset($_FILES['photo']) && !empty($_FILES['photo']['name'])) {
            $upload->setFileType('image');
            $msg = $upload->upload('photo');
            //if uploaded to the server, create new object to insert/update to db 
            if (empty($msg)) {
                $photoMedia = new Media();
                if ($edit) {
                    //if this is an editedarticle, get the photo record to replace data 
                    $photoMedia->initWithId($photo->media_id);
                }
                $photoMedia->setType_name($upload->getFileType());
                $photoMedia->setUrl($upload->getUploadDir() . '/' . $upload->getFilepath());
            } else {
                if (is_array($msg)) {
                    foreach ($msg as $errorMessage) {
                        $errors[] = $errorMessage;
                    }
                } else {
                    $errors[] = $msg;
                }
            }
        }

        // Upload video/audio file
        if (isset($_FILES['video/audio']) && !empty($_FILES['video/audio']['name'])) {
            // determine the type
            $fileName = $_FILES['video/audio'];
            $type = $fileName['type'];
            if (strpos($type, 'video') !== false) {
                $fileType = 'video';
            } elseif (strpos($type, 'audio') !== false) {
                $fileType = 'audio';
            }
            $upload->setFileType($fileType);
            $msg = $upload->upload('video/audio');
            //if uploaded to server, create object to add/update to db media table later 
            if (empty($msg)) {
                $videoAudio = new Media();
                if ($edit && $video) {
                    $videoAudio->initWithId($video->media_id);
                } elseif ($edit && $audio) {
                    $videoAudio->initWithId($audio->media_id);
                }
                $videoAudio->setType_name($upload->getFileType());
                $videoAudio->setUrl($upload->getUploadDir() . '/' . $upload->getFilepath());
            } else {
                if (is_array($msg)) {
                    foreach ($msg as $errorMessage) {
                        $errors[] = $errorMessage;
                    }
                } else {
                    $errors[] = $msg;
                }
            }
        }

        // Upload downloadable file
        if (isset($_FILES['downloadable']) && !empty($_FILES['downloadable']['name'])) {
            $upload->setFileType('file');
            $msg = $upload->upload('downloadable');
            if (empty($msg)) {
                $fileMedia = new Media();
                if ($edit && $file) {
                    $fileMedia->initWithId($file->media_id);
                }
                $fileMedia->setType_name($upload->getFileType());
                $fileMedia->setUrl($upload->getUploadDir() . '/' . $upload->getFilepath());
            } else {
                if (is_array($msg)) {
                    foreach ($msg as $errorMessage) {
                        $errors[] = $errorMessage;
                    }
                } else {
                    $errors[] = $msg;
                }
            }
        }
    }

    //add or update aricle only if no errors yet (if files uploaded successfully)
    if (count($errors) == 0) {
        // if not an edited form, create a new object
        if (!$edit) {
            $article = new Article();
        } else {
            //if edited, it's the id passed to this page 
            $article->setArticle_id($_GET['id']);
        }

        // populate the object with fields values
        $article->setCategory_id($_POST['category']);
        $article->setTitle($_POST['title']);
        $article->setDescription($_POST['description']);
        $article->setContent($_POST['content']);
        $article->setPublish_date(date('Y-m-d')); // set to the current date (last modification)
        if (!$edit) {
            //set current user as author for new article
            $article->setUser_id($_SESSION['user_id']);
        }

        // save changes (add or update the article)
        if ($edit) {
            if (!$article->updateArticle()) {
                $errors[] = 'Failed to update the article.';
            }
        } else {
            if (!$article->addArticle()) {
                $errors[] = 'Failed to add the article.';
            }
        }



        //add or update media that were uploaded  
        //photo 
        if ($photoMedia) {
                            $photoMedia->setArticle_id($article->getArticle_id());
            if ($edit) {
                if (!$photoMedia->updateMedia()) {
                    $errors[] = 'Failed to update the photo.';
                }
            } else {
                if (!$photoMedia->addMedia()) {
                    $errors[] = 'Failed to add the photo.';
                }
            }
        }
        //video/audio 
        if ($videoAudio != null) {
                            $videoAudio->setArticle_id($article->getArticle_id());
            if ($edit) {
                if (!$videoAudio->updateMedia()) {
                    $errors[] = 'Failed to update the video/audio.';
                }
            } else {
                if (!$videoAudio->addMedia()) {
                    $errors[] = 'Failed to add the video/audio.';
                }
            }
        }
        //downloadable file   
        if ($fileMedia != null) {
            $fileMedia->setArticle_id($article->getArticle_id());
            if ($edit && $file) {
                if (!$fileMedia->updateMedia()) {
                    $errors[] = 'Failed to update the downloadable file.';
                }
            } else {
                if (!$fileMedia->addMedia()) {
                    $errors[] = 'Failed to add the downloadable file.';
                }
            }
        }
    }

    //if there is any error in the revious process, show them
    if (count($errors) > 0) {
        $errorMessage = '<div class="alert alert-danger" style="color:maroon">';
        foreach ($errors as $error) {
            $errorMessage .= $error . '<br>';
        }
        $errorMessage .= '<button class="close" type="button" onclick="this.parentElement.style.display=\'none\';">
                        <span>&times;</span>
                    </button>
                </div>';

        echo '<script>document.getElementById("messageContainer").innerHTML = ' . json_encode($errorMessage) . ';</script>';
    }
    //if everything is perfect, redirec to my article page with success message 
    else {
        $action = $edit ? "updated" : "added";
        $successMessage = 'Your article has been ' . $action . ' successfuly.';
        $encodedSuccessMessage = urlencode($successMessage);
        header("Location: myArticles.php?successmessage=$encodedSuccessMessage");
        exit;
    }
}
ob_end_flush();
include 'footer.html';
?>
