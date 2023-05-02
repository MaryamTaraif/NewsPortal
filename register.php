<?php 
include 'debugging.php';
include 'header.html';





?>

/<!-- register user form -->
<section class="login first grey">
    <div class="container">
        <div class="box-wrapper">				
            <div class="box box-border">
                <div class="box-body">
                    <h4>Register</h4>
                    <form action="register.php" method="post">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" value="">
                        </div>

                        <div class="form-group">
                            <label class="fw">Password</label>
                            <input type="password" name="password" class="form-control" value="">
                        </div>
                        
                          <div class="form-group">
                            <label>Role</label>

                            <select id="roles" name="role" class="form-control"  value="">
                                <option value="Admin">Admin</option>
                                <option value="Author">Author</option>
                                <option value="Viewer">Viewer</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="">
                        </div>
                        
                        <div class="form-group text-right">
                            <input type ="submit" value="Register" class="btn btn-primary btn-block">
                             <input type ="hidden" name="submitted" value="1">
                        </div>
                     
                        <div class="form-group text-center">
                            <span class="text-muted">Already have an account?</span> <a href="login.php">Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>




<?php


if(isset($_POST['submitted'])){
    //new User object
    $user = new Users();
    //set 
    $user->setUsername($_POST['username']);
    $user->setEmail($_POST['email']);
    //hashed password
    $password = $_POST['password']; //get password 
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT); //hash password using password_hash function
    $user->setPassword($hashedPassword);
    $user->setRole($_POST['role']);  
    //call register method from user class
    $result = $user->registerUser();
   if($result == true){
       echo '<script>alert("User Registered Successfully!")</script>';
   }else{
       echo '<label>not Successful</label>';
   }        
}


include 'footer.html' ?>