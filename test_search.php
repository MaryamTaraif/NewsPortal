<?php
include 'header.php';

if ($_GET['searchText']){
    $result = Article::searchArticles($_GET['searchText']);
}
?>

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
                                    <input type="text" id="search" class="form-control" oninput="showArticle(this.value)" placeholder="Enter writer name ...">
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
                        <p>Your search texts will be cleared when searching by date</p>
                        <form>
                            <div class="form-group">

                                <div class="input-daterange">
                                    <div class="input-group">
                                        <input type="date" name="from_date" id="start_date" class="form-control" placeholder="From Date" />  
                                    </div>
                                    <p> </p>
                                    <div class="input-group">
                                        <input type="date" name="to_date" id="end_date" class="form-control" placeholder="To Date" />
                                    </div>
                                </div>
                                <p> </p>
                                <div class="input-group-btn">  
                                    <button class="btn btn-primary" id="date_filter">Filter</button>  
                                </div>
                            </div>
                        </form>
                    </div>
                </aside>
            </div>
            <div class="col-md-9">
                <div class="nav-tabs-group">
                    <ul class="nav-tabs-list">
                        <li class="active" id="all" data-function="all" onclick="activate(this)"><a href="#">All</a></li>
                        
                        <li data-function="mostPopular" id="latest" onclick="activate(this)"><a href="#">Latest</a></li>
                        
                        <li data-function="latest" id="popular" onclick="activate(this)"><a href="#">Popular</a></li>

                    </ul>

                </div>
                <div class="search-result">
                    Search results .....
                </div>
                <div class="row" id="searchResult">
                    
                    <?php
  // Include the necessary dependencies and define the Article class
 
  // Call the getWeeklyTops() function to retrieve the weekly tops
  
 
  // Process the $result array or perform any other necessary operations
 
  // Return the desired data as the response
  
  if (!empty($result)) {
                                //loop through and display 
                                    for ($i = 0; $i < count($result); $i++) {
                                        echo '<article class="col-md-12 article-list">
		            <div class="inner">
		              <figure>
                                <img src="'. Media::getPhotoURL($result[$i]->article_id)->URL .'">
		              </figure>
		              <div class="details">
		                <div class="detail">
		                  <div class="category">
		                   <a href="#">'. $name .'</a>
		                  </div>
		                  <div class="time">'.$result[$i]->publish_date .'</div>
		                </div>
		                <h1><a href="singleArticle.php?aid='.$result[$i]->article_id.'"">'.$result[$i]->title .'</a></h1>
		                <p>
		                  '.$result[$i]->description .'
		                </p>
		                <footer>
		                  <a href="#" class="love"><i class="ion-android-favorite-outline"></i> <div>'. $result[$i]->rating .'</div></a>
		                  <a class="btn btn-primary more" href="singleArticle.php?aid='.$result[$i]->article_id.'"> 
		                    <div>More</div>
		                    <div><i class="ion-ios-arrow-thin-right"></i></div>
		                  </a>
		                </footer>
		              </div>
		            </div>
		          </article>';
                                    }
                            }
                            else {
                                echo '<h6>Oops, no articles yet.</h6>';
                            }
?>





                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.html' ?>;


<script>
   function showArticle(str) {
    //create the AJAX request object
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
           document.getElementById("searchResult").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "filter.php?author="+ str, true);
    xmlhttp.send();
}
</script>
<!-- comment
//  function getWeeklyTops() {
//    // Perform an AJAX request to fetch the data from the server
//    var xhr = new XMLHttpRequest();
//    xhr.onreadystatechange = function() {
//      if (xhr.readyState === 4 && xhr.status === 200) {
//        var response = xhr.responseText;
//        // Handle the response data here
//        console.log(response);
//      }
//    };
//    xhr.open('GET', 'Article.php', true);
//    xhr.send();
//  }

//    function getArticles() {
//    // Perform an AJAX request to fetch the data from the server
//    var xhr = new XMLHttpRequest();
//    xhr.onreadystatechange = function() {
//      if (xhr.readyState === 4 && xhr.status === 200) {
//        var response = xhr.responseText;
//        // Handle the response data here
//        console.log(response);
//      }
//    };
//    xhr.open('GET', 'Article.php', true);
//    xhr.send();
//  }

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
  
  var elementName = element.getAttribute('data-function');
  if (functionName === 'all') {
    <?php $result = Article::getArticles; ?>
    
  } else if (functionName === 'mostPopular') {
    <?php $result = Article::getWeeklyTops(); ?>
    mostPopular();
  }
      
  }


</script>-->