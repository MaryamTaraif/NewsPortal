<?php

class Article {
    
    private $article_id;
    private $title;
    private $desc;
    private $content;
    private $publish_date;
    private $rating;
    private $author_id;
    private $category_id;
    
    public function __construct() {
        $this->article_id = null;
        $this->title = null;
        $this->desc = null;
        $this->content = null;
        $this->publish_date = null;
        $this->rating = null;
        $this->author_id = null;
        $this->category_id = null;
    }
    
    public function getArticle_id() {
        return $this->article_id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getDesc() {
        return $this->desc;
    }

    public function getContent() {
        return $this->content;
    }

    public function getPublish_date() {
        return $this->publish_date;
    }

    public function getRating() {
        return $this->rating;
    }

    public function getAuthor_id() {
        return $this->author_id;
    }

    public function getCategory_id() {
        return $this->category_id;
    }

    public function setArticle_id($article_id): void {
        $this->article_id = $article_id;
    }

    public function setTitle($title): void {
        $this->title = $title;
    }

    public function setDesc($desc): void {
        $this->desc = $desc;
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

    public function setAuthor_id($author_id): void {
        $this->author_id = $author_id;
    }

    public function setCategory_id($category_id): void {
        $this->category_id = $category_id;
    }

    function initWith($article_id, $title, $desc, $content, $publish_date,$rating,$author_id,$category_id) {
        $this->article_id = $article_id;
        $this->title = $title;
        $this->desc = $desc;
        $this->content =  $content;
        $this->publish_date = $publish_date;
        $this->rating = $rating;
        $this->author_id = $author_id;
        $this->category_id = $category_id;
    }

    function initWithId($article_id) {
        $db = Database::getInstance();
        $data = $db->singleFetch('SELECT * FROM dbProj_Article WHERE article_id = \'' . $article_id . '\'');
        $this->initWith($data->article_id, $data->title, $data->desc, $data->content, $data->publish_date,$data->rating, $data->author_id,$data->category_id );
    }
    
    public function isValid() {
        $errors = true;

        if (empty($this->article_id))
            $errors = false;

        if (empty($this->title))
            $errors = false;

        if (empty($this->desc))
            $errors = false;

        if (empty($this->content))
            $errors = false;
        
        if (empty($this->publish_date))
            $errors = false;
        
        if (empty($this->rating))
            $errors = false;
        
        if (empty($this->author_id))
            $errors = false;
        
        if (empty($this->category_id))
            $errors = false;
        
        return $errors;
    }
    
    //get the list of articles in the passed category 
    public static function getCatArticles($category_id) {
        $db = Database::getInstance();
        $data = $db->multiFetch('Select * from dbProj_Article where category_id = ' . $category_id);
        return $data;
    }
    
    //get all articles ordered from the latest date 
    public static function getArticles() {
        $db = Database::getInstance();
        $data = $db->multiFetch('Select * from dbProj_Article order by publish_date desc');
        return $data;
    }
    
    
    //categories functions 
    public static function getAllCat(){
        $db = Database::getInstance();
        $data = $db->multiFetch('Select * from dbProj_Category');
        return $data;
    }
    public static function getCatName($cat_id){
        $db = Database::getInstance();
        $data = $db->singleFetch('SELECT * FROM dbProj_Category WHERE category_id = \'' . $cat_id . '\'');
        return $data->category_name;
    }
    
   
  public static function getRecentArticle() {
        $db = Database::getInstance();
        $today = date('Y-m-d');
        $data = $db->singleFetch("SELECT * FROM dbProj_Article WHERE STR_TO_DATE(publish_date, '%Y-%m-%d') <= '$today' ORDER BY publish_date DESC LIMIT 1");
        return $data;
    }
    
    public static function getWeeklyTops(){
        //top articles for this week to display in the home banner 
        $db = Database::getInstance();
        $today = date('Y-m-d');
        $one_week_ago = date('Y-m-d', strtotime('-1 week'));
        $data = $db->multiFetch("SELECT * FROM dbProj_Article WHERE STR_TO_DATE(publish_date, '%Y-%m-%d') <= '$today' AND STR_TO_DATE(publish_date, '%Y-%m-%d') >= '$one_week_ago' ORDER BY rating DESC LIMIT 3");
        //if nothing added this week, return just the latest article to be in the banner 
        if (empty($data)){
            $data = $db->singleFetch("SELECT * FROM dbProj_Article order by publish_date desc limit 1");
        }
        return $data;
    }
    
  public static function getComments($article_id) {
    $db = Database::getInstance();
    $data = $db->multiFetch('SELECT * FROM dbProj_Comment WHERE article_id = \'' . $article_id . '\'');
    return $data;
}

}