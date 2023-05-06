<?php 
    ob_start(); // start output buffering

include 'header.php' ;

?>


    <section class="login first grey">
        <div class="container">
            <div class="box-wrapper">				
                <div class="box box-border">
                    <div class="box-body">
                       <!-- Login form -->
                      
                        <h4>Login</h4>
                
                        <form action='' method="post">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control">

                            </div>
                            <div class="form-group">
                                <label class="fw">Password
                                    <a href="forgot.html" class="pull-right">Forgot Password?</a>
                                </label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="form-group text-right">
                                <p><input type="submit"  class="btn btn-primary btn-block" name="submit" value="Login" /></p>
                                <input type ="hidden" name="submitted" value="TRUE">

                            </div>
                            <div class="form-group text-center">
                                <span class="text-muted">Don't have an account?</span> <a href="register.php">Create one</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


<?php include 'footer.html';

?>
<?php 
 if(isset($_POST['submitted'])){
        $lgn = new Login();
        $username = $_POST['username'];
        $password = $_POST['password'];
        
       
        if($lgn->login($username, $password)){
        
         header('Location: index.php');
         exit;
            
        }else{
            echo $error = 'Wrong Login Values';
        }
        
        
        
    }



?>

    <!-- JS -->
    <script src="js/jquery.js"></script>
    <script src="js/jquery.migrate.js"></script>
    <script src="scripts/bootstrap/bootstrap.min.js"></script>
    <script>var $target_end = $(".best-of-the-week");</script>
    <script src="scripts/jquery-number/jquery.number.min.js"></script>
    <script src="scripts/owlcarousel/dist/owl.carousel.min.js"></script>
    <script src="scripts/magnific-popup/dist/jquery.magnific-popup.min.js"></script>
    <script src="scripts/easescroll/jquery.easeScroll.js"></script>
    <script src="scripts/sweetalert/dist/sweetalert.min.js"></script>
    <script src="scripts/toast/jquery.toast.min.js"></script>
    <script src="js/demo.js"></script>
    <script src="js/e-magz.js"></script>
</body>
</html>
<?php ob_end_flush(); ?>


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

