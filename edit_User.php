<?php


include 'debugging.php';

$page_title = 'Edit User';

include 'header.php';

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

    include 'footer.html';

    exit();
}

$user = new Users();
$user->initWithUid($id);

//perfrom the following if the user has submitted the form 
if (isset($_POST['submitted'])) {

    $oldName = $user->getUsername();

//populate the user object member variables from values on the form
    $user->setUsername($_POST['Username']);
    $user->setEmail($_POST['Email']);
    $user->setPassword($_POST['Password']);
    $user->setType_name($_POST['Type_name']);


    if (!$user->initWithUsername()) {// username exists
        
        echo "<h2> Thankyou </h2><p>".$user->getUsername()." Exists</p>";
        $user->setUsername($oldName);
        
    }else {

        $errors = $user->isValid();

        if (empty($errors)) {
            //update the user 
            $user->updateDB();
            echo "<h2> Thankyou </h2><p>.$user->getUsername(). is updated</p>";
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

echo '<h1>Edit User</h1>';


//create a new user data object and populate it using the get() method
//this will show the form with the fields already populated with values from the $user object created above 
//see the CSS file to see what effect the id="stylized" properties have on the form 
echo '<div id="stylized" class="myform"> 
         <form action="edit_User.php" method="post">
        <br />
        <h3>Edit User: ' . $user->getUsername() . '</h3>
        <br />
           <label>Username</label>    <input type="text" name="Username" value="' . $user->getUsername() . '" />
           <label>Email Address</label> <input type="text" name="Email" value="' . $user->getEmail() . '"/>
           <label>Password</label>      <input type="password" name="Password" value="' . $user->getPassword() . '"/>
           <label>Type_name</label> <input type="text" name="Type_name" value="' . $user->setType_name() . '"/>
           <input type="submit" class ="DB4Button" name="submit" value="update" />
        
         <input type ="hidden" name="submitted" value="TRUE">
         <input type ="hidden" name="id" value="' . $id . '"/>
         </form>
        <div class="spacer"></div>
        </div>';





include 'footer.html';
?>
