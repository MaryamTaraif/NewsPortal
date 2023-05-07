<?php include 'header.php';
$id = $_GET['aid'];
$article = new Article();
$article->initWithId($id);

//get author details
$author = new Users();



?>

<section class="single">
    <div class="container" style="padding-top: 180px;">
        <div class="row">
            <div class="col-md-4 sidebar" id="sidebar">
                <aside>
                    <div class="aside-body">
                        <figure class="ads">
                            <img src="images/ad.png">
                            <figcaption>Advertisement</figcaption>
                        </figure>
                    </div>
                </aside>
                <aside>
                    <h1 class="aside-title">Recent Post</h1>
                    <div class="aside-body">
                        <article class="article-fw">
                            <div class="inner">
                                <figure>
                                    <a href="single.html">												
                                        <img src="images/news/img16.jpg">
                                    </a>
                                </figure>
                                <div class="details">
                                    <h1><a href="single.html">Lorem Ipsum Dolor Sit Amet Consectetur Adipisicing Elit</a></h1>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                        tempor incididunt ut labore et dolore magna aliqua.
                                    </p>
                                    <div class="detail">
                                        <div class="time">December 26, 2016</div>
                                        <div class="category"><a href="category.html">Lifestyle</a></div>
                                    </div>
                                </div>
                            </div>
                        </article>
                        <div class="line"></div>
                        <article class="article-mini">
                            <div class="inner">
                                <figure>
                                    <a href="single.html">
                                        <img src="images/news/img05.jpg">
                                    </a>
                                </figure>
                                <div class="padding">
                                    <h1><a href="single.html">Duis aute irure dolor in reprehenderit in voluptate velit</a></h1>
                                    <div class="detail">
                                        <div class="category"><a href="category.html">Lifestyle</a></div>
                                        <div class="time">December 22, 2016</div>
                                    </div>
                                </div>
                            </div>
                        </article>
                        <article class="article-mini">
                            <div class="inner">
                                <figure>
                                    <a href="single.html">
                                        <img src="images/news/img02.jpg">
                                    </a>
                                </figure>
                                <div class="padding">
                                    <h1><a href="single.html">Fusce ullamcorper elit at felis cursus suscipit</a></h1>
                                    <div class="detail">
                                        <div class="category"><a href="category.html">Travel</a></div>
                                        <div class="time">December 21, 2016</div>
                                    </div>
                                </div>
                            </div>
                        </article>
                        <article class="article-mini">
                            <div class="inner">
                                <figure>
                                    <a href="single.html">
                                        <img src="images/news/img13.jpg">
                                    </a>
                                </figure>
                                <div class="padding">
                                    <h1><a href="single.html">Duis aute irure dolor in reprehenderit in voluptate velit</a></h1>
                                    <div class="detail">
                                        <div class="category"><a href="category.html">International</a></div>
                                        <div class="time">December 20, 2016</div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                </aside>
                <aside>
                    <div class="aside-body">
                        <form class="newsletter">
                            <div class="icon">
                                <i class="ion-ios-email-outline"></i>
                                <h1>Newsletter</h1>
                            </div>
                            <div class="input-group">
                                <input type="email" class="form-control email" placeholder="Your mail">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary"><i class="ion-paper-airplane"></i></button>
                                </div>
                            </div>
                            <p>By subscribing you will receive new articles in your email.</p>
                        </form>
                    </div>
                </aside>
            </div>
            <div class="col-md-8">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active"><?php echo $article->getCatName($article->getCategory_id())?></li>
                </ol>
                <article class="article main-article">
                    <header>
                        <h1><?php echo $article->getTitle(); ?></h1>
                        <ul class="details">
                            <li>Posted on <?php echo $article->getPublish_date()?></li>
                            <li><?php echo $article->getCatName($article->getCategory_id())?></li>
                            <li>By <a href="#"><?php echo $article->getAuthor_id()?>></a></li>
                        </ul>
                    </header>
                    
                    <div class="main">
                    <blockquote>
                         description will be here
                        </blockquote>
                        <div class="featured">
                            <figure>
                                <img src="images/news/img01.jpg">
                                <figcaption>Image by magz</figcaption>
                            </figure>
                        </div>

                        <p><?php echo $article->getContent();?> </p>
                      
                       
                        
                <div class="line">
                    <div>Author</div>
                </div>
                <div class="author">
                    <figure>
                        <img src="images/img01.jpg">
                    </figure>
                    <div class="details">
                       
                        <h3 class="name"><?php $author->initWithUid($article->getAuthor_id());
                                            echo $author->getUsername();
                                ?></h3>
                        <p><?php $author->getUsername();?></p>
             
                    </div>
                </div>
                
                            
                <div class="line thin"></div>
                <div class="comments">
                    <h2 class="title">3 Responses <a href="#">Write a Response</a></h2>
                    <div class="comment-list">
                        <div class="item">
                            <div class="user">                                
                                <figure>
                                    <img src="images/img01.jpg">
                                </figure>
                                <div class="details">
                                    <h5 class="name">Mark Otto</h5>
                                    <div class="time">24 Hours</div>
                                    <div class="description">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                        tempor incididunt ut labore et dolore <a href="#">magna</a> aliqua. Ut enim ad minim veniam,
                                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo.
                                    </div>
                                    <footer>
                                        <a href="#">Reply</a>
                                    </footer>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="user">                                
                                <figure>
                                    <img src="images/img01.jpg">
                                </figure>
                                <div class="details">
                                    <h5 class="name">Mark Otto</h5>
                                    <div class="time">24 Hours</div>
                                    <div class="description">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                        tempor incididunt ut labore et dolore <a href="#">magna</a> aliqua. Ut enim ad minim veniam,
                                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo.
                                    </div>
                                    <footer>
                                        <a href="#">Reply</a>
                                    </footer>
                                </div>
                            </div>
                            <div class="reply-list">
                                <div class="item">
                                    <div class="user">                                
                                        <figure>
                                            <img src="images/img01.jpg">
                                        </figure>
                                        <div class="details">
                                            <h5 class="name">Mark Otto</h5>
                                            <div class="time">24 Hours</div>
                                            <div class="description">
                                                Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                            </div>
                                            <footer>
                                                <a href="#">Reply</a>
                                            </footer>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="user">                                
                                <figure>
                                    <img src="images/img01.jpg">
                                </figure>
                                <div class="details">
                                    <h5 class="name">Mark Otto</h5>
                                    <div class="time">24 Hours</div>
                                    <div class="description">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                        tempor incididunt ut labore et dolore <a href="#">magna</a> aliqua. Ut enim ad minim veniam,
                                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo.
                                    </div>
                                    <footer>
                                        <a href="#">Reply</a>
                                    </footer>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form class="row">
                        <div class="col-md-12">
                            <h3 class="title">Leave Your Comment</h3>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="name">Name <span class="required"></span></label>
                            <input type="text" id="name" name="" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="email">Email <span class="required"></span></label>
                            <input type="email" id="email" name="" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="website">Website</label>
                            <input type="url" id="website" name="" class="form-control">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="message">Response <span class="required"></span></label>
                            <textarea class="form-control" name="message" placeholder="Write your response ..."></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <button class="btn btn-primary">Send Response</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>



<?php include 'footer.html' ?>;



