<?php

class Article {
    
    private $article_id;
    private $title;
    private $description;
    private $content;
    private $publish_date;
    private $likes;
    private $dislikes;
    private $user_id;
    private $category_id;
    private $status;
    private $views;
     
    public function __construct() {
        $this->article_id = null;
        $this->title = null;
        $this->description = null;
        $this->content = null;
        $this->publish_date = null;
        $this->likes = 0;
        $this->dislikes = 0;
        $this->user_id = null;
        $this->category_id = null;
        $this->status = false;
        $views = null;
    }
    public function getArticle_id() {
        return $this->article_id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getContent() {
        return $this->content;
    }

    public function getPublish_date() {
        return $this->publish_date;
    }

    public function getLikes() {
        return $this->likes;
    }

    public function getDislikes() {
        return $this->dislikes;
    }

    public function setLikes($likes): void {
        $this->likes = $likes;
    }

    public function setDislikes($dislikes): void {
        $this->dislikes = $dislikes;
    }

    
    public function getUser_id() {
        return $this->user_id;
    }

    public function getCategory_id() {
        return $this->category_id;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getViews() {
        return $this->views;
    }
    
    public function setArticle_id($article_id): void {
        $this->article_id = $article_id;
    }

    public function setTitle($title): void {
        $this->title = $title;
    }

    public function setDescription($description): void {
        $this->description = $description;
    }

    public function setContent($content): void {
        $this->content = $content;
    }

    public function setPublish_date($publish_date): void {
        $this->publish_date = $publish_date;
    }

    public function setRating($rating): void {
        $this->rating = $rating;
    }

    public function setUser_id($user_id): void {
        $this->user_id = $user_id;
    }

    public function setCategory_id($category_id): void {
        $this->category_id = $category_id;
    }

    public function setStatus($status): void {
        $this->status = $status;
    }
    
    public function setViews($views): void {
        $this->views = $views;
    }

        
    function initWith($article_id, $title, $description, $content, $publish_date,$likes,$dislikes,$user_id,$category_id, $status, $views) {
        $this->article_id = $article_id;
        $this->title = $title;
        $this->description = $description;
        $this->content =  $content;
        $this->publish_date = $publish_date;
        $this->likes = $likes;
        $this->dislikes = $dislikes;
        $this->user_id = $user_id;
        $this->category_id = $category_id;
        $this->status = $status;
        $this->views = $views;
    }

    function initWithId($article_id) {
        $db = Database::getInstance();
        $data = $db->singleFetch('SELECT * FROM dbProj_Article WHERE article_id = \'' . $article_id .  '\'');
        $this->initWith($data->article_id, $data->title, $data->description, $data->content, $data->publish_date,$data->likes, $data->dislikes, $data->user_id,$data->category_id, $data->status, $data->views );

    }
    
    public function isValid() {
        $errors = true;

        if (empty($this->title))
            $errors = false;

        if (empty($this->description))
            $errors = false;

        if (empty($this->content))
            $errors = false;
        
        if (empty($this->user_id))
            $errors = false;
        
        if (empty($this->category_id))
            $errors = false;
        
        return $errors;
    }
    
    //add article 
    function addArticle()
    {
        if ($this->isValid()) {
            $db = Database::getInstance();
            $query = 'INSERT INTO dbProj_Article (title, description, content, publish_date, user_id, category_id, views)'
                     . ' VALUES ("' . $this->title . '","' . $this->description . '","' . $this->content 
                     . '","' . $this->publish_date .'","' . $this->user_id .'","' . $this->category_id .'","0")';
            $result = $db->querySql($query); 
            if ($result) {
                // Retrieve the article ID just inserted
                $articleId = mysqli_insert_id($db->dblink);
                if ($articleId) {
                    $this->article_id = $articleId;
                    return true;
                }
            }
            return false;
        }
    }

                 
    
    //update article
    function updateArticle(){
        if ($this->isValid()){
            $db = Database::getInstance();
            $q = 'UPDATE dbProj_Article SET title = \'' . $this->title .'\','
                    . ' content = \'' . $this->content .'\','
                    . ' description = \'' . $this->description .'\','
                    . ' category_id = \'' . $this->category_id . '\','
                    . ' user_id = \'' . $this->user_id . '\','
                    . ' publish_date = \'' . $this->publish_date . '\','
                    . ' status = \'' . $this->status .'\' '
                    . 'WHERE article_id = ' . $this->article_id;
            $result = $db->querySql($q); 
            if($result) {
                return true;
            }
            else {
                return false;
            }
        }
    }
    
    //delete article 
    public static function deleteArticle($article_id) {
        $db = Database::getInstance();
        $result = $db->querySql('CALL deleteArticle('. $article_id .')');
        if ($result){
            return true;
        }
        else {
            return false;
        }
    }


    
    //publish article 
    public static function publish($article_id){
         $db = Database::getInstance();
         $today = date('Y-m-d');
            $q = 'UPDATE dbProj_Article SET publish_date = \'' . $today .'\','
                    . ' status = 1 '
                    . 'WHERE article_id = ' . $article_id;
            $result = $db->querySql($q); 
            if ($result){
                return true;
            }
            else {
                return false;
            }
    }
    
    public static function getAllCatArticles($category_id){
        $db = Database::getInstance();
        // get the total number of articles for the category
        $totalSql = "SELECT COUNT(*) as total FROM dbProj_Article WHERE status = true and category_id = $category_id";
        $total = $db->singleFetch($totalSql);
        return $total;
    }
    
    //get the list of articles in the passed category 
   public static function getPageArticles($category_id, $page, $page_size) {
        $db = Database::getInstance();
        $offset = $page * $page_size;
        $sql = "SELECT * FROM dbProj_Article WHERE category_id = $category_id LIMIT $offset, $page_size";
        $data = $db->multiFetch($sql);
        return $data;
    }


    
    //get all articles ordered from the latest date 
    public static function getArticles() {
        $db = Database::getInstance();
        $data = $db->multiFetch('Select * from dbProj_Article where status = true order by publish_date desc');
        return $data;
    }
    
    
    //categories functions 
    public static function getAllCat(){
        $db = Database::getInstance();
        $data = $db->multiFetch('Select * from dbProj_Category');
        return $data;
    }
    
    public static function getCatName($category_id){
        $db = Database::getInstance();
        $data = $db->singleFetch('SELECT * FROM dbProj_Category WHERE category_id = \'' . $category_id . '\'');
        return $data->category_name;
    }
    

   
  public static function getRecentArticle() {
        $db = Database::getInstance();
        $today = date('Y-m-d');
        $data = $db->singleFetch("SELECT * FROM dbProj_Article WHERE status = true and STR_TO_DATE(publish_date, '%Y-%m-%d') <= '$today' ORDER BY publish_date DESC LIMIT 1");
        return $data;
    }

    public static function getWeeklyTops(){
        //top articles for this week to display in the home banner 
        $db = Database::getInstance();
        $today = date('Y-m-d');
        $one_week_ago = date('Y-m-d', strtotime('-1 week'));
        $data = $db->multiFetch("SELECT * FROM dbProj_Article WHERE status = true and STR_TO_DATE(publish_date, '%Y-%m-%d') <= '$today' AND STR_TO_DATE(publish_date, '%Y-%m-%d') >= '$one_week_ago' ORDER BY likes DESC LIMIT 3");
        //if nothing added this week, return just the latest article to be in the banner 
        if (empty($data)){
            $data = $db->singleFetch("SELECT * FROM dbProj_Article where status = true order by publish_date desc limit 1");
        }
        return $data;
    }
    
    public static function getAuthorTops($author_id){
        $db = Database::getInstance();
        $q = "SELECT * FROM dbProj_Article WHERE status = true and user_id = $author_id ORDER BY likes DESC LIMIT 3";
        $data = $db->multiFetch($q);
        return $data;
    }

    public static function getComments($article_id) {
      $db = Database::getInstance();
      $data = $db->multiFetch('SELECT * FROM dbProj_Comment WHERE article_id = \'' . $article_id . '\'');
      return $data;
    } 


    public static function authorPublishedArticles($author_id){
        $db = Database::getInstance();
        $data = $db->multiFetch('SELECT * FROM dbProj_Article WHERE user_id ='. $author_id .' and status = true order by publish_date desc');
        return $data;
    }
    
    public static function authorDraftArticles($author_id){
        $db = Database::getInstance();
        $data = $db->multiFetch('SELECT * FROM dbProj_Article WHERE user_id ='. $author_id .' and status = false order by publish_date desc');
        return $data;
    }
    
     //get the list of articles in the passed category 
    public static function getCatArticles($category_id) {
        $db = Database::getInstance();
        $data = $db->multiFetch('Select * from dbProj_Article where status = true and category_id = ' . $category_id .' order by publish_date desc');
        return $data;
    }
    
    //count the number of comments in the artcile
     public static function countComments($article_id) {
    $db = Database::getInstance();
    $query = 'SELECT COUNT(*) AS comment_count FROM dbProj_Comment WHERE article_id = \'' . $article_id . '\'';
    $result = $db->singleFetch($query);
    
    if ($result !== false && isset($result->comment_count)) {
        return $result->comment_count;
    } else {
        return 0; // No comments found
    }
}
    
    // Define a new function that takes a search query as a parameter
    public static function searchArticles($searchText) {
    $db = Database::getInstance();
    $query = "SELECT * FROM dbProj_Article WHERE MATCH(title, description, content) AGAINST('*".$searchText."*' IN BOOLEAN MODE) ORDER BY MATCH(title, description, content) AGAINST('*".$searchText."*' IN BOOLEAN MODE) DESC";
    $result = $db->multiFetch($query);    
    return $result;
}

    public static function searchByAuthor($authorName)
    {
        $db = Database::getInstance();
        $q = "SELECT * FROM dbProj_Article a, dbProj_User u WHERE u.user_id = a.user_id and u.username like '$authorName%'";
        $data = $db->multiFetch($q);
        return $data;
    }

    public static function getMostPopular($from, $to){
        //
        $db = Database::getInstance();
        $data = $db->multiFetch("SELECT * FROM dbProj_Article WHERE status = true and STR_TO_DATE(publish_date, '%Y-%m-%d') <= '$to' AND STR_TO_DATE(publish_date, '%Y-%m-%d') >= '$from' ORDER BY likes DESC");
        return $data;
    }
    
}