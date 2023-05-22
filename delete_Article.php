<?php
    include 'debugging.php';

$page_title = 'Delete Article';

include 'header.php';

$id=0;

//the first time the page is displayed it is because it is from a hyper link so we use $_GET to 
//retrieve the parameter from the link
//Any time the page is shown after that it is because it has been submitted using the form
//so we then use $_POST to get the form data
if( isset($_GET['id']) )
{
    $id=$_GET['id'];  
}
elseif(isset($_POST['id']))
{
    $id=$_POST['id'];    
}
else
{
     echo '<p class="error"> Error has occured</p>';    
}


echo '<h1>Delete Article</h1>';
//create a article object 
$article = new Article();
$article->initWithId($id);

if(isset($_POST['submitted']))
{
//test the value of the radio button    
    if(isset($_POST['sure']) && ($_POST['sure'] == 'Yes') ) //delete the record   
    {  
       if($article->deleteArticle())
           echo '<p> Article' .$article->getTitle(). ' was deleted</p>'; 
       if($this->type_name == 'Administrator')
       {
         $article->setTitle('This article was removed by an administrator');
       }
    }//no confirmation
     else
       echo '<p> User '. $article->getTitle(). '  deletion not confirmed</p>'; 
}
else //show form
{
    echo '<div id="stylized" class="myform"> 
        <form action="delete_Article.php" method="post">
        <br />
        <h3>Name: '.$article->getTitle() . '</h3></br>
        <label>Delete this article?</label> <br/><br/>
          <input type="radio" name="sure" value="Yes" /><label>Yes</label>
          <input type="radio" name="sure" value="No" checked="checked" /> <label>No</label>
          <input type="submit" class ="DB4Button" name="submit" value="Delete" />
        
         <input type ="hidden" name="submitted" value="TRUE">
         <input type ="hidden" name="id" value="' . $id . '"/>
         </form>
         <div class="spacer"></div>
         </div>';   

}

include 'footer.html';
?>
