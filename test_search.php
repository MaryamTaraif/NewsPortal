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
                        <p>Your search texts will be cleared when searching by date</p>
                        <form method="POST">
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
                                  <button class="btn btn-primary" name="filter_date" id="filter_date" value="filter_date" onclick="showArticleByDate()">Filter</button>  
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
                        
                        <li data-function="latest" id="latest" onclick="activate(this)"><a href="#">Latest</a></li>
                        
                        <li data-function="mostPopular" id="popular" onclick="activate(this)"><a href="#">Popular</a></li>

                    </ul>

                </div>
                <div class="search-result">
                    Search results .....
                </div>
                <div class="row" id="searchResult">
                    
                    <?php
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
		                  <a href="#" class="love" style="display: inline-block; margin-right: 10px;" onclick="updateLikes(<?php echo $result[$i]->id; ?>)"><i class="fas fa-thumbs-up"></i><div>'. $result[$i]->likes .'</div></a>
                                  <a href="#" id="dislike" class="love" onclick="updateDislikes(<?php echo $result[$i]->id; ?>)"><i class="fas fa-thumbs-down"></i><div>'. $result[$i]->dislikes .'</div></a>
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
//?>

                    




                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.html' ?>;


<script>
   function showArticleByAuthor(str) {
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

function showArticleByDate() {
    //create the AJAX request object
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
           document.getElementById("searchResult").innerHTML = xmlhttp.responseText;
        }
    }
    fromDate = document.getElementById("start_date").value;
    toDate = document.getElementById("end_date").value;
    xmlhttp.open("GET", "filterDate.php?start_date="+ fromDate + "&end_date=" +toDate, true);
    xmlhttp.send();
}

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

document.getElementById("dislike").addEventListener("click", function() {
  // Increment dislikes  
  incrementDislikes(<?php echo $result[$i]->id; ?>);
});


  function updateLikes(articleId) {
    // TODO: Implement logic to update the likes count for the specified article ID
    alert("Liked article " +articleId);
  }

  function updateDislikes(articleId) {
    // TODO: Implement logic to update the dislikes count for the specified article ID
    alert("Disliked article " + articleId);
  }


//function initDateFilter() {
//  // Get references to the "From Date" and "To Date" input fields and the "Filter" button
//  const fromDateInput = document.getElementById("start_date");
//  const toDateInput = document.getElementById("end_date");
//  const filterButton = document.getElementById("filter_date");
//
//    alert("function is called");
//  // Add an event listener to the "Filter" button
//  filterButton.onclick = function() {
//    // Check if both input fields have values
//    if (fromDateInput.value === "" || toDateInput.value === "") {
//      // Display an error message if either input field is empty
//      alert("Please enter both a From Date and a To Date");
//    } else {
//      // If both input fields have values, do the filtering logic here
//      alert("lab lab lab");
//    }
//  };
//}

//function activate(el) {
//   var functionName = el.dataset.function;
//   
//   if (functionName == "latest") {
//       getLatestArticle();
//   }
//}

//function getLatestArticle() {
//    fetch("getLatestArticle.php")
//    .then(res => res.text())
//    .then(data => {
//       document.getElementById("latest-article").innerHTML = data;      
//    })   
//}
//function updateLikes(itemId) {
//    alert("LIke");
//  // Make an AJAX request to the server-side PHP script
//  var xhr = new XMLHttpRequest();
//  xhr.open('POST', 'update_likes.php', true);
//  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
//  xhr.onreadystatechange = function() {
//    if (xhr.readyState == 4 && xhr.status == 200) {
//      // Update the like count on the page
//      document.getElementById('like-count-' + itemId).innerHTML = xhr.responseText;
//    }
//  };
//  xhr.send('itemId=' + itemId);
//}
//$(document).ready(function(){
// 
// $('.input-daterange').datepicker({
//  todayBtn:'linked',
//  format: "yyyy-mm-dd",
//  autoclose: true
// });
//
// fetch_data('no');
//
// function fetch_data(is_date_search, start_date='', end_date='')
// {
//  var dataTable = $('#article_data').DataTable({
//   "processing" : true,
//   "serverSide" : true,
//   "article" : [],
//   "ajax" : {
//    url:"filter.php",
//    type:"POST",
//    data:{
//     is_date_search:is_date_search, start_date:start_date, end_date:end_date
//    }
//   }
//  });
// }
//
// $('#search').click(function(){
//  var start_date = $('#start_date').val();
//  var end_date = $('#end_date').val();
//  if(start_date != '' && end_date !='')
//  {
//   $('#article_data').DataTable().destroy();
//   fetch_data('yes', start_date, end_date);
//  }
//  else
//  {
//   alert("Both Date is Required");
//  }
// }); 
// 
//});
</script>


   