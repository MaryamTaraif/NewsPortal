<?php
include 'header.php';
if ($_GET['searchText']) {
    $searchresult = Article::searchArticles($_GET['searchText']);
}
?>

<script>


    function showArticleByAuthor(str, page = 1) {
        //create the AJAX request object
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("searchResult").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "filter.php?author=" + str + "&page=" + page, true);
        xmlhttp.send();
    }

    function showArticleByDate(page = 1) {

        // Get the current date
        var currentDate = new Date();

        // Add one day to the current date
        var checkDate = new Date();
        checkDate.setDate(currentDate.getDate() + 1);

        // Get the selected dates
        var fromDate = document.getElementById("start_date").value;
        var toDate = document.getElementById("end_date").value;

        // Check if both dates are selected
        if (fromDate === "" || toDate === "") {
            alert("Please select both a From Date and a To Date");
            return false;
        }

        // Get the current date
        var currentDate = new Date();

        // Convert the selected dates to Date objects
        var fromDateTime = new Date(fromDate);
        var toDateTime = new Date(toDate);

        // Check if the selected "To Date" is earlier than the "From Date"
        if (toDateTime < fromDateTime) {
            alert("Please select a valid date range");
            return false;
        }

        // Check if the selected dates are earlier than the current date
        if (fromDateTime > checkDate || toDateTime > checkDate) {
            alert("Please select a date that has not yet occurred");
            return false;
        }

//If all the validations pass, you can continue with the AJAX request to filter the articles as before.
        //create the AJAX request object
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("searchResult").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "filterDate.php?start_date=" + fromDate + "&end_date=" + toDate + "&page=" + page, true);
        xmlhttp.send();
        return false;
    }

    function showPopular() {
        //create the AJAX request object
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("searchResult").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "popular.php?", true);
        xmlhttp.send();
        return false;
    }

    function showRecent() {
        //create the AJAX request object
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("searchResult").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "recent.php?", true);
        xmlhttp.send();
        return false;
    }

    function showAll(page = 1) {
        //create the AJAX request object
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("searchResult").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "allArticles.php?page=" + page, true);
        xmlhttp.send();
        return false;
    }
</script>

<section class="search">
    <div class="container" style="padding-top: 200px">
        <div class="row">
            <div class="col-md-3">

                <aside>

                    <h2 class="aside-title">Search</h2>
                    <div class="aside-body">
                        <p>Search by writer name for more accurate results.</p>
                        <form>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" id="search" class="form-control" oninput="showArticleByAuthor(this.value)" placeholder="Enter writer name ...">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary">
                                            <i class="ion-search"></i>
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>

                    <h2 class="aside-title">Filter By Date</h2>
                    <div class="aside-body">

                        <p>Search Within certain period for more accurate results.</p>
                        <form method="POST" onsubmit="showArticleByDate(); return false;">
                            <div class="form-group">
                                <div class="input-daterange">
                                    <div class="input-group">
                                        <input type="date" name="from_date" id="start_date" class="form-control" placeholder="From Date" />  
                                    </div>
                                    <p> </p>
                                    <div class="input-group">
                                        <input type="date" name="to_date" id="end_date" class="form-control" placeholder="To Date"  />
                                    </div>
                                </div>
                                <p> </p>
                                <div class="input-group-btn">  
                                    <button class="btn btn-primary" name="filter_date" id="filter_date" value="filter_date">Filter</button>  
                                </div>
                            </div>
                        </form>
                    </div>
                </aside>
            </div>
            <div class="col-md-9">
                <div class="nav-tabs-group">
                    <ul class="nav-tabs-list">
                        <li class="active" id="all" data-function="all" onclick="activate(this), showAll()"><a href="#">All</a></li>

                        <li data-function="latest" id="latest" onclick="activate(this), showRecent()"><a href="#">Latest</a></li>

                        <li data-function="mostPopular" id="popular" onclick="activate(this), showPopular()"><a href="#">Most Read</a></li>

                    </ul>

                </div>
                <div class="search-result">
                    Search results .....
                </div>
                <div class="row" id="searchResult">

                    <?php
                    $itemsPerPage = 10; // Number of items per page
                    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1; // Current page number
// Calculate the start and end positions for the current page
                    $start = ($currentPage - 1) * $itemsPerPage;
                    $end = $start + $itemsPerPage;

// Return the desired data as the response
                    if (!empty($searchresult)) {
                        // Loop through and display the filtered results
                        $filteredResult = array_slice($searchresult, $start, $itemsPerPage);
                        foreach ($filteredResult as $article) {
                            echo '<article class="col-md-12 article-list">
            <div class="inner">
                <figure>
                    <img src="' . Media::getPhotoURL($article->article_id)->URL . '">
                </figure>
                <div class="details">
                    <div class="detail">
                        <div class="category">
                            <a href="#">' . Article::getCatName($article->category_id) . '</a>
                        </div>
                        <div class="time">' . $article->publish_date . '</div>
                    </div>
                    <h1><a href="singleArticle.php?aid=' . $article->article_id . '"">' . $article->title . '</a></h1>
                    <p>
                        ' . $article->description . '
                    </p>
                    <footer>
                        <a class="btn btn-primary more" href="singleArticle.php?aid=' . $article->article_id . '"> 
                            <div>More</div>
                            <div><i class="ion-ios-arrow-thin-right"></i></div>
                        </a>
                    </footer>
                </div>
            </div>
        </article>';
                        }
                    } else {
                        echo '<h6>Oops, no articles yet.</h6>';
                    }

                    $totalPages = ceil(count($searchresult) / $itemsPerPage);
                    if ($totalPages > 1) {
                        echo '<div class="col-md-12 text-center">
            <ul class="pagination">';
                        if ($currentPage > 1) {
                            echo '<li class="prev"><a href="?searchText=' . urlencode($_GET['searchText']) . '&page=' . ($currentPage - 1) . '"><i class="ion-ios-arrow-left"></i></a></li>';
                        }
                        for ($i = 1; $i <= $totalPages; $i++) {
                            echo '<li' . ($i == $currentPage ? ' class="active"' : '') . '><a href="?searchText=' . urlencode($_GET['searchText']) . '&page=' . $i . '">' . $i . '</a></li>';
                        }
                        if ($currentPage < $totalPages) {
                            echo '<li class="next"><a href="?searchText=' . urlencode($_GET['searchText']) . '&page=' . ($currentPage + 1) . '"><i class="ion-ios-arrow-right"></i></a></li>';
                        }
                        echo '</ul></div>';
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.html' ?>;


<script>
    function activate(element) {
        // Get all the list items
        var listItems = document.querySelectorAll('.nav-tabs-list li');

        // Loop through the list items
        for (var i = 0; i < listItems.length; i++) {
            // Remove the "active" class from all list items
            listItems[i].classList.remove('active');
            listItems[i].querySelector('a').style.color = '';
            listItems[i].querySelector('a').style.borderBottom = '';
        }

        // Add the "active" class to the clicked list item
        element.classList.add('active');
        element.querySelector('a').style.color = '#191E21';
        element.querySelector('a').style.borderBottom = '2px solid #F73F52';
    }

</script>


