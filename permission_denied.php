<?php
include 'header.php';
?>
<section class="not-found">
    <div class="container" >
        <div class="row">
            <div class="col-md-12">
                <div class="code">
                    403
                </div>
                <h1>Permission Denied</h1>
                <p class="lead">Sorry, you don't have permission to access this page.</p>
                <div class="search-form">							
                    <?php
                    if (empty($_SESSION['user_id'])) {
                        echo '<div class="link">
								 <a href="loginPage.php">Login</a> first.
							</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.html'; ?>
