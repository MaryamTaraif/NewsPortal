<?php
include 'header.php';
?>
<script>
    // Define a function to handle the search form submission
function searchArticles() {
    // Get the search query from the search form input
   var query = document.getElementById('searchInput').value;
    // Create a new XMLHttpRequest object
    var xhr = new XMLHttpRequest();
    // Define a function to handle the AJAX response
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            // Parse the JSON response
            var data = JSON.parse(xhr.responseText);
            // Display the search results
            displaySearchResults(data);
        }
    };
    // Open a new AJAX request
    xhr.open('GET', '/path/to/searchArticles.php?query=' + encodeURIComponent(query));
    // Send the AJAX request
    xhr.send();
}

// Define a function to display the search results
function displaySearchResults(data) {
    // Clear the previous search results
    document.getElementById('searchResults').innerHTML = '';
    // Loop through the search results and append them to the search results container
    for (var i = 0; i < data.length; i++) {
        var article = data[i];
        var articleHtml = '<div class="article">' +
            '<h2 class="article-title">' + article.title + '</h2>' +
            '<div class="article-body">' + article.body + '</div>' +
            '</div>';
        document.getElementById('searchResults').innerHTML += articleHtml;
    }
}
    </script>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="description" content="Magz is a HTML5 & CSS3 magazine template is based on Bootstrap 3.">
		<meta name="author" content="Kodinger">
		<meta name="keyword" content="magz, html5, css3, template, magazine template">
		<!-- Shareable -->
		<meta property="og:title" content="HTML5 & CSS3 magazine template is based on Bootstrap 3" />
		<meta property="og:type" content="article" />
		<meta property="og:url" content="http://github.com/nauvalazhar/Magz" />
		<meta property="og:image" content="https://raw.githubusercontent.com/nauvalazhar/Magz/master/images/preview.png" />
		<title>Magz &mdash; Responsive HTML5 &amp; CSS3 Magazine Template</title>
		<!-- Bootstrap -->
		<link rel="stylesheet" href="scripts/bootstrap/bootstrap.min.css">
		<!-- IonIcons -->
		<link rel="stylesheet" href="scripts/ionicons/css/ionicons.min.css">
		<!-- Toast -->
		<link rel="stylesheet" href="scripts/toast/jquery.toast.min.css">
		<!-- OwlCarousel -->
		<link rel="stylesheet" href="scripts/owlcarousel/dist/assets/owl.carousel.min.css">
		<link rel="stylesheet" href="scripts/owlcarousel/dist/assets/owl.theme.default.min.css">
		<!-- Magnific Popup -->
		<link rel="stylesheet" href="scripts/magnific-popup/dist/magnific-popup.css">
		<link rel="stylesheet" href="scripts/sweetalert/dist/sweetalert.css">
		<!-- iCheck -->
		<link rel="stylesheet" href="scripts/icheck/skins/all.css">
		<!-- Custom style -->
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/skins/all.css">
		<link rel="stylesheet" href="css/demo.css">
        </head>

	<body>
		
		<section class="search">
			<div class="container">
				<div class="row">
					<div class="col-md-3">
						<aside>
							<h2 class="aside-title">Search</h2>
							<div class="aside-body">
								<p>Search by writer name for more accurate results.</p>
								<form>
									<div class="form-group">
										<div class="input-group">
											<input type="text" name="q" class="form-control" placeholder="Type something ...">
											<div class="input-group-btn">
												<button class="btn btn-primary">
													<i class="ion-search"></i>
												</button>
											</div>
										</div>
                                                                            
									</div>
								</form>
							</div>
						</aside>
						<aside>
							<h2 class="aside-title">Filter By Date</h2>
							<div class="aside-body">
								
                                                            <p>Search Within certain period for more accurate results.</p>
								<form>
                                                                    <div class="form-group">
                                                                        
									<div class="input-group">
                                                                            <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" />  
                                                                        </div>
                                                                            <p> </p>
                                                                        <div class="input-group">
                                                                            <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" />
                                                                        </div> 
                                                                            <p> </p>
                                                                        <div class="input-group-btn">  
                                                                            <button class="btn btn-primary">Filter</button>  
                                                                        </div>
                                                                    </div>
								</form>
							</div>
						</aside>
					</div>
					<div class="col-md-9">
						<div class="nav-tabs-group">
							<ul class="nav-tabs-list">
								<li class="active" data-function="all"><a href="#">All</a></li>
								<li data-function="mostPopular"><a href="#">Latest</a></li>
								<li data-function="latest"><a href="#">Popular</a></li>
								
							</ul>
							
						</div>
						<div class="search-result">
							Search results .....
						</div>
						<div class="row">
                                                    
							<?php
                            //get the list of articles 
                            $list = Article::searchArticles();
                            //if the result if not empty 
                            if (!empty($list)) {
                                //loop through and display 
                                    for ($i = 0; $i < count($list); $i++) {
                                        echo '<article class="col-md-12 article-list">
		            <div class="inner">
		              <figure>
                                <img src="'. Media::getPhotoURL($list[$i]->article_id)->URL .'">
		              </figure>
		              <div class="details">
		                <div class="detail">
		                  <div class="category">
		                   <a href="#">'. $name .'</a>
		                  </div>
		                  <div class="time">'.$list[$i]->publish_date .'</div>
		                </div>
		                <h1><a href="singleArticle.php?aid= '.$list[$i]->article_id.'"">'.$list[$i]->title .'</a></h1>
		                <p>
		                  '.$list[$i]->description .'
		                </p>
		                <footer>
		                  <a href="#" class="love"><i class="ion-android-favorite-outline"></i> <div>'. $list[$i]->rating .'</div></a>
		                  <a class="btn btn-primary more" href="singleArticle.php?aid='.$list[$i]->article_id.'"> 
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
				
                                                    
                                                    
		          <div class="col-md-12 text-center">
		            <ul class="pagination">
		              <li class="prev"><a href="#"><i class="ion-ios-arrow-left"></i></a></li>
		              <li class="active"><a href="#">1</a></li>
		              <li><a href="#">2</a></li>
		              <li><a href="#">3</a></li>
		              <li><a href="#">...</a></li>
		              <li><a href="#">97</a></li>
		              <li class="next"><a href="#"><i class="ion-ios-arrow-right"></i></a></li>
		            </ul>
		            <div class="pagination-help-text">
		            	Showing 8 results of 776 &mdash; Page 1
		            </div>
		          </div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<?php include 'footer.html' ?>;

		<!-- JS -->
		<script src="js/jquery.js"></script>
		<script src="js/jquery.migrate.js"></script>
		<script src="scripts/bootstrap/bootstrap.min.js"></script>
		<script>var $target_end=$(".best-of-the-week");</script>
		<script src="scripts/jquery-number/jquery.number.min.js"></script>
		<script src="scripts/owlcarousel/dist/owl.carousel.min.js"></script>
		<script src="scripts/magnific-popup/dist/jquery.magnific-popup.min.js"></script>
		<script src="scripts/easescroll/jquery.easeScroll.js"></script>
		<script src="scripts/sweetalert/dist/sweetalert.min.js"></script>
		<script src="scripts/icheck/icheck.min.js"></script>
		<script src="scripts/toast/jquery.toast.min.js"></script>
		<script src="js/demo.js"></script>
		<script>$("input").iCheck({
      checkboxClass: 'icheckbox_square-red',
      radioClass: 'iradio_square-red',
      cursor: true
		});</script>
		<script src="js/e-magz.js"></script>
	</body>
</html>

<script>
