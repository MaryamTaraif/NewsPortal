<?php


include 'debugging.php';
include 'header.php';


if(isset($_POST['submitted'])){
    echo 'Add attempt';
    $comment = new Comment();
    $comment->setContent(trim($_POST['Comment']));
    
    $errors = $comment->isValid();
    
    if(empty($errors)){
        if($comment->addComment()){
            echo "<p>Your comment was added successfully</p>";
        }
    }else{
        echo'<p> class="error"> Error </p>';
        
        foreach($errors as $comment)
            echo " - $comment<br />";
    }
}

?>
<h2 class="i2Style" >Create a new Comment</h2>
<form action="addComment.php" method="post">
     <fieldset>
            <p><b>Enter Comment</b>
                <textarea  name="content" cols="45" rows="5"></textarea><br />
            <div align="center">
                  <input type ="submit" class="DB4Button" value ="Post your comment" />
            </div>  
            <input type="hidden" name="submitted" value="1" />
     </fieldset>
</form>    

 
<?php
include 'footer.html'
?>
