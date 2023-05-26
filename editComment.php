<?php


$page_title = 'Edit Comment';

$id = 0;

//the id of the user is first passed to the form as a parameter so we retrieve it from the $_GET global array
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
//after the page is first submitted the id is stored in a hidden field on the page so we get it frm the $_POST array
elseif (isset($_POST['id'])) {
    $id = $_POST['id'];
} else {
    //no id parameter is present so we do not go any further
    echo '<p class="error">No User id Parameter</p>';

   

    exit();
}

$comment = new Comment();
$comment->initWithCid($id);

//perfrom the following if the user has submitted the form 
if (isset($_POST['submitted'])) {

    $oldComment = $comment->getContent();

//populate the comment object member variables from values on the form
    $comment->setContent($_POST['Content']);
    $uid->setUid($_POST['Uid']);
    $aid->setAid($_POST['Aid']);


    if (!$comment->initWithCid()) {// comment exists
        
        echo "<h2> Thankyou </h2><p>".$comment->getContent()." Exists</p>";
        $comment->setContent($oldComment);
        
    }else {

        $errors = $comment->isValid();

        if (empty($errors)) {
            //update the comment 
            $user->updateDB();
            echo "<h2> Thankyou </h2><p>.$comment->getContent(). is updated</p>";
        } else {
            echo '<div style="width:50%; background:#FFFFFF; margin:0 auto;">
                <p class="error"> The following errors occurred: <br/>';
            foreach ($errors as $err) {
                echo "$err <br/>";
            }
            echo '</p></div>';
        }
    }
} // end if submitted conditional

echo '<h1>Edit Comment</h1>';


//create a new comment data object and populate it using the get() method
//this will show the form with the fields already populated with values from the $comment object created above 
//see the CSS file to see what effect the id="stylized" properties have on the form 
echo '<div id="stylized" class="myform"> 
         <form action="editComment.php" method="post">
        <br />
        <h3>Edit User: ' . $comment->getContent() . '</h3>
        <br />
           <label>Content</label>    <input type="text" name="Content" value="' . $comment->getContent() . '" />
           <input type="submit" class ="DB4Button" name="submit" value="update" />
        
         <input type ="hidden" name="submitted" value="TRUE">
         <input type ="hidden" name="id" value="' . $id . '"/>
         </form>
        <div class="spacer"></div>
        </div>';





?>
