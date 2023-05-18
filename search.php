<?php
include 'header.php';
?>

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
								<li class="active"><a href="#">All</a></li>
								<li><a href="#">Latest</a></li>
								<li><a href="#">Popular</a></li>
								
							</ul>
							
						</div>
						<div class="search-result">
							Search results .....
						</div>
						<div class="row">
							<article class="col-md-12 article-list">
								<div class="inner">
									<figure>
										<a href="single.html">
											<img src="images/news/img11.jpg">
										</a>
									</figure>
									<div class="details">
										<div class="detail">
											<div class="category">
												<a href="#">Film</a>
											</div>
											<time>December 19, 2016</time>
										</div>
										<h1><a href="single.html">Donec consequat arcu at ultrices sodales quam erat aliquet diam</a></h1>
										<p>
										Donec consequat, arcu at ultrices sodales, quam erat aliquet diam, sit amet interdum libero nunc accumsan nisi.
										</p>
										<footer>
											<a href="#" class="love"><i class="ion-android-favorite-outline"></i> <div>273</div></a>
											<a class="btn btn-primary more" href="single.html">
												<div>More</div>
												<div><i class="ion-ios-arrow-thin-right"></i></div>
											</a>
										</footer>
									</div>
								</div>
							</article>
							<article class="col-md-12 article-list">
								<div class="inner">
									<div class="badge">
										Sponsored
									</div>
									<figure>
										<a href="single.html">
											<img src="images/news/img02.jpg">
										</a>
									</figure>
									<div class="details">
										<div class="detail">
											<div class="category">
												<a href="#">Travel</a>
											</div>
											<time>December 18, 2016</time>
										</div>
										<h1><a href="single.html">Maecenas accumsan tortor ut velit pharetra mollis</a></h1>
										<p>
											Maecenas accumsan tortor ut velit pharetra mollis. Proin eu nisl et arcu iaculis placerat sollicitudin ut est. In fringilla dui.
										</p>
										<footer>
											<a href="#" class="love"><i class="ion-android-favorite-outline"></i> <div>4209</div></a>
											<a class="btn btn-primary more" href="single.html">
												<div>More</div>
												<div><i class="ion-ios-arrow-thin-right"></i></div>
											</a>
										</footer>
									</div>
								</div>
							</article>
							<article class="col-md-12 article-list">
								<div class="inner">
									<figure>
										<a href="single.html">
											<img src="images/news/img03.jpg">
										</a>
									</figure>
									<div class="details">
										<div class="detail">
											<div class="category">
											<a href="#">Travel</a>
											</div>
											<time>December 16, 2016</time>
										</div>
										<h1><a href="single.html">Nulla facilisis odio quis gravida vestibulum Proin venenatis pellentesque arcu</a></h1>
										<p>
											Nulla facilisis odio quis gravida vestibulum. Proin venenatis pellentesque arcu, ut mattis nulla placerat et.
										</p>
										<footer>
											<a href="#" class="love active"><i class="ion-android-favorite"></i> <div>302</div></a>
											<a class="btn btn-primary more" href="single.html">
												<div>More</div>
												<div><i class="ion-ios-arrow-thin-right"></i></div>
											</a>
										</footer>
									</div>
								</div>
							</article>
							<article class="col-md-12 article-list">
								<div class="inner">
									<figure>
										<a href="single.html">
											<img src="images/news/img09.jpg">
										</a>
									</figure>
									<div class="details">
										<div class="detail">
											<div class="category">
												<a href="#">Healthy</a>
											</div>
											<time>December 16, 2016</time>
										</div>
										<h1><a href="single.html">Maecenas blandit ultricies lorem id tempor enim pulvinar at</a></h1>
										<p>
											Maecenas blandit ultricies lorem, id tempor enim pulvinar at. Curabitur sit amet tortor eu ipsum lacinia malesuada. Etiam sed vulputate magna.
										</p>
										<footer>
											<a href="#" class="love"><i class="ion-android-favorite-outline"></i> <div>783</div></a>
											<a class="btn btn-primary more" href="single.html">
												<div>More</div>
												<div><i class="ion-ios-arrow-thin-right"></i></div>
											</a>
										</footer>
									</div>
								</div>
							</article>
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
      $(document).ready(function(){  
          // Enable datepicker on input fields
           $("#from_date, #to_date").datepicker({
            dateFormat: "yy-mm-dd"
            });
    
           $.datepicker.setDefaults({  
                dateFormat: 'yy-mm-dd'   
           });  
           $(function(){  
                $("#from_date").datepicker();  
                $("#to_date").datepicker();  
           });  
           $('#filter').click(function(){  
                var from_date = $('#from_date').val();  
                var to_date = $('#to_date').val();  
                if(from_date != '' && to_date != '')  
                {  
                     $.ajax({  
                          url:"filter.php",  
                          method:"POST",  
                          data:{from_date:from_date, to_date:to_date},  
                          success:function(data)  
                          {  
                               $('#order_table').html(data);  
                          }  
                     });  
                }  
                else  
                {  
                     alert("Please Select Date");  
                }  
           });  
      });  
 </script>