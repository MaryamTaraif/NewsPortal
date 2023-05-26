<?php

echo ' <div class="container" style="padding-top: 200px;">';
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

//perform the following if the user has submitted the form 
if (isset($_POST['submitted'])) {

    $oldName = $user->getUsername();

//populate the user object member variables from values on the form
    $user->setUsername($_POST['username']);
    $user->setEmail($_POST['email']);
    $user->setType_name($_POST['type_name']);


    if ($oldName != $user->getUsername() && !$user->initWithUsername()) {// username exists
        echo "<h2> Thankyou </h2><p>" . $user->getUsername() . " Exists</p>";
        $user->setUsername($oldName);
    } else {

        $errors = $user->isValid();

        if ($errors) {
            //update the user 
            $user->updateDB();
            echo '<div class="alert alert-success" style="color:seagreen">' . 'Updated Successfully' . '<button class="close" type="button" onclick="this.parentElement.style.display=\'none\';">
                                <span>&times;</span>
                            </button> </div>';
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
//echo '<div id="stylized" class="myform"> 
//         <form action="edit_User.php" method="post">
//        <br />
//        <h3>Edit User: ' . $user->getUsername() . '</h3>
//        <br />
//           <label>Username</label>    <input type="text" name="username" value="' . $user->getUsername() . '" />
//           <label>Email Address</label> <input type="text" name="email" value="' . $user->getEmail() . '"/>
//           <label>Password</label>      <input type="password" name="password" value="' . $user->getPassword() . '"/>
//           <label>Type_name</label> <input type="text" name="type_name" value="' . $user->getType_name() . '"/>
//        
//         <input type ="hidden" name="submitted" value="TRUE">
//         <input type ="hidden" name="id" value="' . $id . '"/>
//         </form>
//        <div class="spacer"></div>
//        </div>';

echo '<form action="edit_User.php" method="post">
    <div class="col-md-12">
        <div class="form-group">
            <label>UserName</label>
            <input type="text" class="form-control" name="username" value="' . $user->getUsername() . '" />
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label>Email</label>
            <input type="text" class="form-control" name="email" value="' . $user->getEmail() . '" />
        </div>
    </div>';


echo '<div class="col-md-12">
    <div class="form-group">
        <label>User Type</label>
        <select class="form-control" name="type_name">';

$typesList = Users::getTypes();
if (!empty($typesList)) {
    foreach ($typesList as $type) {
        $selected = ($type->type_name == $user->getType_name()) ? 'selected' : '';
        echo '<option value="' . $type->type_name . '" ' . $selected . '>' . $type->type_name . '</option>';
    }
}

echo '</select>
    </div>
</div>';


echo '<input type="submit" class="btn btn-primary" name="submit" value="update" />
    <input type="hidden" name="submitted" value="TRUE">
    <input type="hidden" name="id" value="' . $id . '"/>
</form>
<div class="spacer"></div>
</div>';

echo '</div>';
include 'footer.html';
?>
