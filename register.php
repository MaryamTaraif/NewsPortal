<?php
include 'header.php';
?>

<!-- register user form -->
<section class="login first grey">
    <div class="container">
        <div class="box-wrapper">
            <div class="box box-border">
                <div class="box-body">
                    <h4>Register</h4>
                    <form id="registrationForm" action="register.php" method="post">
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
                            <select id="roles" name="role" class="form-control" value="">
                                <?php
                                $typesList = Users::getTypes();
                                if (!empty($typesList)) {
                                    for ($i = 0; $i < count($typesList); $i++) {
                                        if ($_SESSION['role'] == 'Admin') {
                                            if ($typesList[$i]->type_name == 'Admin') {
                                                echo '<option value="' . $typesList[$i]->type_name . '" selected>' . $typesList[$i]->type_name . '</option>';
                                            } else {
                                                echo '<option value="' . $typesList[$i]->type_name . '">' . $typesList[$i]->type_name . '</option>';
                                            }
                                        } else {
                                            if ($typesList[$i]->type_name != 'Admin') {
                                                echo '<option value="' . $typesList[$i]->type_name . '">' . $typesList[$i]->type_name . '</option>';
                                            }
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="">
                        </div>

                        <div class="form-group text-right">
                            <input type="submit" id="registerButton" value="Register" class="btn btn-primary btn-block" disabled>
                            <input type="hidden" name="submitted" value="1">
                        </div>

                        <div class="form-group text-center">
                            <span class="text-muted">Already have an account?</span> <a href="loginPage.php">Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    // Function to check if all fields are filled
    function checkForm() {
        var username = document.forms["registrationForm"]["username"].value;
        var password = document.forms["registrationForm"]["password"].value;
        var role = document.forms["registrationForm"]["role"].value;
        var email = document.forms["registrationForm"]["email"].value;

        if (username === "" || password === "" || role === "" || email === "") {
            return false;
        }
        return true;
    }

    // Add event listeners to form fields
    var formFields = document.querySelectorAll("#registrationForm input");
    formFields.forEach(function (field) {
        field.addEventListener("input", function () {
            if (checkForm()) {
                document.getElementById("registerButton").disabled = false; //enable register button
            } else {
                document.getElementById("registerButton").disabled = true; //disable register button
            }
        });
    });
</script>



<?php
if (isset($_POST['submitted'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $email = $_POST['email'];

    // Check if username length is at least 3 characters
    if (strlen($username) < 3) {
        echo '<div class="alert alert-danger">Username must be at least 3 characters long.</div>';
    } else {
        // Continue with the registration process
        $user = new Users();
        $user->setUsername($username);
        $user->setEmail($email);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $user->setPassword($hashedPassword);
        $user->setType_name($role);

        if ($user->initWithUsername()) {
            $result = $user->registerUser();
            if ($result == true) {
                echo '<script>alert("User Registered Successfully!")</script>'; // Display a success message if user registration is successful
            } else {
                echo '<label>Registration was not successful.</label>'; // Display an error message if user registration fails
            }
        } else {
            echo '<script>alert("Username already exists!")</script>'; // Display an alert if the username already exists
        }
    }
}






include 'footer.html'
?>