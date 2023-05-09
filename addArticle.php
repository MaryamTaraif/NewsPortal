<?php
include 'header.php';


?>

	<section class="page">
			<div class="container" style="padding-top: 180px;">
				<div class="row">
					<div class="col-md-12">
	          <ol class="breadcrumb">
	          	<li><a href="#">Home</a></li>
	            <li class="active">New Article</li>
	          </ol>
						<h1 class="page-title">New Article</h1>
						<p class="page-subtitle">Publish your thoughts</p>
						<div class="line thin"></div>
						<div class="page-description">
							<div class="row">
								<div class="col-md-6 col-sm-6">
                                                                    <form action="" method="post" enctype="multipart/form-data" class="row contact" style="padding-top: 0px;">
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
												<input type="text" class="form-control" name="title" required>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label>Description <span class="required"></span></label>
												<input type="text" class="form-control" name="description" required>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label>Content <span class="required"></span></label>
												<textarea class="form-control" name="content" required></textarea>
											</div>
										</div>
										
                                                                                <div class="col-md-12">
											<div class="form-group">
                                                                                            <label>Attachments </label> <br>
                                                                                                <label>Photo <span class="required"></span></label>
												<input type="file"  name="photo" accept="image/*" required>
											</div>
                                                                                        <div class="form-group">
                                                                                                <label>Video/Audio <span class="required"></span></label>
                                                                                                <input type="file"  name="video/audio" accept="audio/*, video/*" required>
                                                                                        </div>
                                                                                    
                                                                                        <div class="form-group">
                                                                                                <label>Downloadable File </label>
                                                                                                <input type="file"  name="downloadable">
                                                                                        </div>
										</div>
                                                                                <div class="col-md-12">
                                                                                    <input type ="submit" class="btn btn-primary" value ="Save" />
                                                                                </div>
                                                                                 <input type="hidden" name="submitted" value="1"/>
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
    //add article 
    $article = new Article();
    $article->setCategory_id($_POST['category']);
    $article->setTitle($_POST['title']);
    $article->setDescription($_POST['description']);
    $article->setContent($_POST['content']);
    $article->setUser_id(4);
    if ($article->addArticle() == true){
     //header('Location: index.php');
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
                $media->setArticle_id($article->getArticle_id());
                $media->setType_name($upload->getFileType());
                $media->setUrl($upload->getFilepath());

                if ($media->addMedia()){
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
                $media->setArticle_id($article->getArticle_id());
                $media->setType_name($upload->getFileType());
                $media->setUrl($upload->getFilepath());

                if ($media->addMedia()){
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
                $media->setArticle_id($article->getArticle_id());
                $media->setType_name($upload->getFileType());
                $media->setUrl($upload->getFilepath());

                if ($media->addMedia()){
                    echo 'Successfully uploaded downloadble file.';
                }
            }
            else {
                print_r($msg);
            }
        }
    }
}


include 'footer.html'; ?>
