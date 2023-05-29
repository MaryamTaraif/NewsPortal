<?php
ob_start();
include 'header.php';
// Check if the user not an admin, then redirect to permission denied page
if ($_SESSION['role'] !== 'Admin') {
    header("Location: permission_denied.php");
    exit();
}
?>
<section class="category">
<div class="container" >
    <div class="row">
        <div class="col-md-12">        
            <ol class="breadcrumb">
                <li><a href="#">My Account</a></li>
                <li class="active">Reports</li>
            </ol>
            <h1 class="page-title">Administration Reports</h1>
        </div>
    </div>
    <div class="line"></div>

    <section class="search">
        <div class="row">
            <div class="col-md-3">
                <aside>
                    <h2 class="aside-title">Author</h2>
                    <div class="aside-body">
                        <p>Extract all news articles published by selected author.</p>
                        <div class="form-group">
                            <div class="input-group">
                                <select id="author" name="author" class="form-control" >
                                    <?php
                                    //populate the dropdown with authors names
                                    $authors = Users::getAuthors();
                                    if (!empty($authors)) {
                                        for ($i = 0; $i < count($authors); $i++) {
                                            echo '<option value="' . $authors[$i]->username . '">' . $authors[$i]->username . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                <div class="input-group-btn">
                                    <button class="btn btn-primary" onmouseup="showArticleByAuthor()">
                                        <i class="ion-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <h2 class="aside-title">Most Popular</h2>
                    <div class="aside-body">
                        <p>Extract the most popular articles based on rating in your chosen date range.</p>
                        <div class="form-group">
                            <div class="input-daterange">
                                <div class="input-group">
                                    <input type="date" name="from_date" id="from_date" class="form-control" placeholder="From Date" />  
                                </div>
                                <p> </p>
                                <div class="input-group">
                                    <input type="date" name="to_date" id="to_date" class="form-control" placeholder="To Date" />
                                </div>
                            </div>
                            <p> </p>
                            <div class="input-group-btn">  
                                <button class="btn btn-primary" name="filter_date" id="filter_date" value="filter_date" onmouseup="showMostPopular()">Extract</button>  
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
            <div class="col-md-9">
                <div class="row" id="searchResult">
                </div>
            </div>
        </div>
    </section>
</div>
</section>

<script>
    function showArticleByAuthor(page = 1) {
        user_id = document.getElementById("author").value;
        //create the AJAX request object
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("searchResult").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "filter.php?adminAuthor=" + user_id + "&page=" + page, true);
        xmlhttp.send();
    }

    function showMostPopular(page = 1) {
        //create the AJAX request object
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("searchResult").innerHTML = xmlhttp.responseText;
            }
        }
        from = document.getElementById("from_date").value;
        to = document.getElementById("to_date").value;
        xmlhttp.open("GET", "mostPopular.php?from=" + from + "&to=" + to + "&page=" + page, true);
        xmlhttp.send();
    }
</script>
<?php include 'footer.html'; ?>
