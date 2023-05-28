<?php
ob_start();
include 'header.php';
// Check if the user is not an admin, then redirect to the permission denied page
if ($_SESSION['role'] !== 'Admin') {
    header("Location: permission_denied.php");
    exit();
}
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<div class="container" style="padding-top: 240px; margin-bottom: 70px;">
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb" style="text-align: center;">
                <li><a href="#">My Account</a></li>
                <li class="active">Users</li>
            </ol>
            <h1 class="page-title" align="center">All Users</h1>

            <div class="line thin"></div>
            <div class="row">
                <div class="col-md-12">
                    <h5>
                        <a href="register.php">
                            <i class="fas fa-user-plus"></i>&nbsp;&nbsp;Register a new User
                        </a>
                    </h5>
                </div>
            </div>

            <?php
            $users = new Users();
            $currentPage = isset($_GET['page']) ? $_GET['page'] : 1; // Get the current page number
            $itemsPerPage = 10; // Number of users to display per page

            $row = $users->getAllusers();
            $totalUsers = count($row);
            $totalPages = ceil($totalUsers / $itemsPerPage);

            // Calculate the starting and ending indexes for the users on the current page
            $startIndex = ($currentPage - 1) * $itemsPerPage;
            $endIndex = $startIndex + $itemsPerPage;
            $usersOnCurrentPage = array_slice($row, $startIndex, $itemsPerPage);

            if (!empty($usersOnCurrentPage)) {
                echo '<br />';
                // Display a table of results
                echo '<table align="center" cellspacing="2" cellpadding="4" width="100%" style="font-family: \'Raleway\', sans-serif; border-collapse: collapse; border: 1px solid #ddd;">';
                echo '<tr style="background-color: #f73f52; color: #ffffff;">
                        <th style="padding: 10px; text-align: center; border: 1px solid #ddd;"></th>
                        <th style="padding: 10px; text-align: center;border: 1px solid #ddd;"></th>
                        <th style="padding: 10px; text-align: center;border: 1px solid #ddd;"><a href="view_Users.php" style="color: #ffffff; text-decoration: none;">user_id</a></th>
                        <th style="padding: 10px; text-align: center;border: 1px solid #ddd;"><a href="view_Users.php" style="color: #ffffff; text-decoration: none;">username</a></th>
                        <th style="padding: 10px; text-align: center; border: 1px solid #ddd;"><a href="view_Users.php" style="color: #ffffff; text-decoration: none;">email</a></th>
                        <th style="padding: 10px; text-align: center;border: 1px solid #ddd;"><a href="view_Users.php" style="color: #ffffff; text-decoration: none;">type</a></th>
                      </tr>';

                foreach ($usersOnCurrentPage as $user) {
                    echo '<tr style="background-color: #ffffff; border: 1px solid #ddd;">';
                    echo '<td style="padding: 10px; text-align: center;border: 1px solid #ddd;"><a href="edit_User.php?id=' . $user->user_id . '">Edit</a></td>';
                    echo '<td style="padding: 10px; text-align: center; border: 1px solid #ddd; text-align: center;">
                            <a href="#" onclick="deleteUser(' . $user->user_id . ')">Delete</a>
                          </td>';
                    echo '<td style="padding: 10px;text-align: center; border: 1px solid #ddd;  text-align: center;">' . $user->user_id . '</td>';
                    echo '<td style="padding: 10px; border: 1px solid #ddd;  text-align: center;">' . $user->username . '</td>';
                    echo '<td style="padding: 10px; border: 1px solid #ddd;  text-align: center;">' . $user->email . '</td>';
                    echo '<td style="padding: 10px; border: 1px solid #ddd;  text-align: center;">' . $user->type_name . '</td>';
                    echo '</tr>';
                }

                echo '</table>';

                // Pagination
                if ($totalPages > 1) {
                    echo '<div class="col-md-12 text-center"><ul class="pagination">';
                    if ($currentPage > 1) {
                        echo '<li><a href="?page=' . ($currentPage - 1) . '">&laquo;</a></li>';
                    }
                    for ($page = 1; $page <= $totalPages; $page++) {
                        echo '<li ' . ($page == $currentPage ? 'class="active"' : '') . '><a href="?page=' . $page . '">' . $page . '</a></li>';
                    }
                    if ($currentPage < $totalPages) {
                        echo '<li><a href="?page=' . ($currentPage + 1) . '">&raquo;</a></li>';
                    }
                    echo '</ul></div>';
                }
            } else {
                echo '<p>No users found.</p>';
            }
            ?>
        </div>
    </div>
</div>

<script>
    function deleteUser(userId) {
        if (confirm("Are you sure you want to delete this user?")) {
            // Make an AJAX request
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    // Update the page
                    if (this.responseText == true) {
                        location.reload();
                        alert("Deleted Successfully");
                    } else {
                        alert("Sorry, an error occurred." + this.responseText);
                    }
                }
            };
            xhttp.open("GET", "delete_User.php?u_id=" + userId, true);
            xhttp.send();
        }
    }
</script>

<?php include 'footer.html'; ?>
