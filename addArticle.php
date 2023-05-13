<?php
include 'header.php';
$edit = false;
if(isset($_GET['id'])){
    $article = new Article();
    $article->initWithId($_GET['id']);
    $edit = true;
    
    //get media 
    $photo = Media::getPhotoURL($article->getArticle_id());
    if (!empty(Media::getVideoURL($article->getArticle_id()))){
        $video = Media::getVideoURL($article->getArticle_id());
    }
    if (!empty (Media::getAudioURL($article->getArticle_id()))) {
        $audio = Media::getAudioURL($article->getArticle_id());
    }
    if (!empty (Media::getDownloadableFile($article->getArticle_id()))){
        $file = Media::getDownloadableFile($article->getArticle_id());
    }
    
}
?>

	<section class="page">
			<div class="container" style="padding-top: 180px;">
				<div class="row">
					<div class="col-md-12">
	          <ol class="breadcrumb">
	          	<li><a href="#">Home</a></li>
	            <li class="active"><?php if ($edit)
                                                          echo 'Edit Article';
                                                    else 
                                                        echo 'New Article';
                                                    ?></li>
	          </ol>
						<h1 class="page-title">
                                                    <?php if ($edit)
                                                          echo 'Edit Article';
                                                    else 
                                                        echo 'New Article';
                                                    ?></h1>
						<p class="page-subtitle">Publish your thoughts</p>
						<div class="line thin"></div>
						<div class="page-description">
							<div class="row">
								<div class="col-md-6 col-sm-6">
                                                                    <form action="" method="post" enctype="multipart/form-data" class="row contact">
										<div class="col-md-6">
											<div class="form-group">
												<label>Category <span class="required"></span></label>
                                                                                                <select id="category" name="category" class="form-control" required>
                                                                                                   <?php 
                                                                                                        //retrieve all categories and add to the dropdown list 
                                                                                                        $list = Article::getAllCat();
                                                                                                        if (!empty($list)){
                                                                                                         for ($i = 0; $i < count($list); $i++) {
                                                                                                            echo '<option value="'. $list[$i]->category_id .'">'. $list[$i]->category_name .'</option>';
                                                                                                         }
                                                                                                        }     
                                                                                                    ?>
                                                                                                </select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Title <span class="required"></span></label>
                                                                                              
												<?php if ($edit)
                                                                                                    echo '<input type="text" class="form-control" name="title" required value="' . $article->getTitle() .'">';
                                                                                                else 
                                                                                                    echo '<input type="text" class="form-control" name="title" required>';
                                                                                                    ?>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label>Description <span class="required"></span></label>
                                                                                                <input type="text" class="form-control" name="description" required value="<?php if ($edit) echo $article->getDescription(); ?>">
												
                                                                                                   
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label>Content <span class="required"></span></label>
                                                                                                <textarea class="form-control" name="content" required><?php if ($edit) echo $article->getContent(); ?></textarea>
												
											</div>
										</div>
										
                                                                                <div class="col-md-12">
											<div class="form-group">
                                                                                            <label>Attachments </label> <br>
                                                                                                <label>Photo <span class="required"></span></label>
                                                                                                <?php if($edit) {
                                                                                                    echo '<br><img src="'.$photo->URL .'" alt="Selected photo" style="width:350px; height:350px;">'
                                                                                                        . '<input type="file"  name="photo" accept="image/*" >';
                                                                                                }
                                                                                                else {
                                                                                                    echo '<input type="file"  name="photo" accept="image/*" required>';
                                                                                                }
?>
												
											</div>
                                                                                        <div class="form-group">
                                                                                                <label>Video/Audio <span class="required"></span></label>
                                                                                                 <?php if(!empty($video)) {
                                                                                                     
                                                                                                    echo '<br><video controls>
                                                                                                            <source src="'. $video->URL .'" type="video/*">
                                                                                                          </video>';
                                                                                                 }
                                                                                                 elseif (!empty($audio)) {
                                                                                                     echo '<br><audio controls>
                                                                                                            <source src="'. $audio->URL .'" type="audio/wav">
                                                                                                          </audio>
                                                                                                          <input type="file"  name="video/audio" accept="audio/*, video/*">';
                                                                                                }
                                                                                                else {
                                                                                                    echo '<input type="file"  name="video/audio" accept="audio/*, video/*" required>';
                                                                                                }
?>
                                                                                                
                                                                                                
                                                                                        </div>
                                                                                    
                                                                                        <div class="form-group">
                                                                                                <label>Downloadable File </label>
                                                                                                <?php if (!empty($file)) {
                                                                                                echo '<br><a href="'. $file->URL .'"> '. $file->URL .' </a>';}
                                                                                                    ?>
                                                                                                <input type="file"  name="downloadable">
                                                                                        </div>
										</div>
                                                                                <div class="col-md-12">
                                                                                    <input type ="submit" class="btn btn-primary" value ="Save" />
                                                                                </div>
                                                                                 <input type="hidden" name="submitted" value="1"/>
                                                                                 <input type ="hidden" name="id" value="<?php if ($edit) { echo $article->getArticle_id();} ?>">
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>



<?php 
if(isset($_POST['submitted'])){
    //if not an edited one, create new object 
    if (!$edit){
    $article = new Article();
    }
    else {
        $article->setArticle_id($_GET['id']);
    }
    
    //populate object with fields values
    
    $article->setCategory_id($_POST['category']);
    $article->setTitle($_POST['title']);

    $article->setDescription($_POST['description']);
    $article->setContent($_POST['content']);
            var_dump($article->getContent());

    if (!$edit){
        $article->setUser_id($_SESSION['user_id']);
    }
    
    //save
    if ($edit){
        if ($article->updateArticle())
            echo 'updated';
    }
    else {
        if ($article->addArticle())
            echo 'added';
    }
    
    // upload all files 
    if (!empty($_FILES)) {
        echo 'upload attempt';
        $upload = new Upload();
        $upload->setUploadDir('media/');

        // Upload photo file
        if (isset($_FILES['photo'])) {
            $upload->setFileType('image');
            $msg = $upload->upload('photo');
            if (empty($msg)) {
                $media = new Media();
                if ($edit){
                    $media->initWithId($photo->media_id);
                }
                $media->setArticle_id($article->getArticle_id());
                $media->setType_name($upload->getFileType());
                $media->setUrl($upload->getUploadDir() . '/' . $upload->getFilepath());
                
                //save changes
                if($edit){
                   
                   $media->updateMedia();
                }else {
                    $media->addMedia(); 
                    echo 'Successfully uploaded photo.';
                }
            }
            else {
                print_r($msg);
            }
        }

        // Upload video/audio file
        if (isset($_FILES['video/audio'])) {
            //determine the type 
            $fileName = $_FILES['video/audio'];
            $type = $fileName['type'];
            if (strpos($type, 'video') !== false) 
                $fileType = 'video';
            elseif (strpos($type, 'audio') !== false)
                $fileType = 'audio';
            
            $upload->setFileType($fileType); 
            $msg = $upload->upload('video/audio');
            if (empty($msg)) {
                $media = new Media();
                if ($edit && $video){
                   $media->initWithId($video->media_id);       
                }
                elseif ($edit && $audio) {
                    $media->initWithId($audio->media_id);
                }
                
                $media->setArticle_id($article->getArticle_id());
                $media->setType_name($upload->getFileType());
                $media->setUrl($upload->getUploadDir() . '/' . $upload->getFilepath());

                //save changes
                if($edit){
                   $media->updateMedia();
                }else {
                    $media->addMedia(); 
                    echo 'Successfully uploaded video/audio.';
                }
            }
            else {
                print_r($msg);
            }
        }
        
        // Upload downloadable file
        if (isset($_FILES['downloadable'])) {
            $upload->setFileType('file'); 
            $msg = $upload->upload('downloadable');
            if (empty($msg)) {
                $media = new Media();
                if ($edit && $file){
                    $media->initWithId($file->media_id);
                }
                $media->setArticle_id($article->getArticle_id());
                $media->setType_name($upload->getFileType());
                $media->setUrl($upload->getUploadDir() . '/' . $upload->getFilepath());

                //save changes
                if($edit && $file){
                   $media->updateMedia();
                }else {
                    $media->addMedia(); 
                    echo 'Successfully uploaded downloadable file.';
                }
            }
            else {
                print_r($msg);
            }
        }
    }
}


include 'footer.html'; ?>
