<?php

class Media {
    
    private $media_id;
    private $URL;
    private $article_id;
    private $type_name;
    
    public function __construct() {
        $this->media_id = null;
        $this->URL = null;
        $this->article_id = null;
        $this->type_name = null;
    }
    
    public function getMedia_id() {
        return $this->media_id;
    }

    public function getUrl() {
        return $this->URL;
    }

    public function getArticle_id() {
        return $this->article_id;
    }

    public function getType_name() {
        return $this->type_name;
    }

    public function setMedia_id($media_id): void {
        $this->media_id = $media_id;
    }

    public function setUrl($url): void {
        $this->URL = $url;
    }

    public function setArticle_id($article_id): void {
        $this->article_id = $article_id;
    }

    public function setType_name($type_name): void {
        $this->type_name = $type_name;
    }
    
    function initWith($media_id, $url, $article_id, $type_name) {
        $this->media_id = $media_id;
        $this->URL = $url;
        $this->article_id = $article_id;
        $this->type_name = $type_name;
    }

  function initWithId($media_id) {
    $db = Database::getInstance();
    $data = $db->singleFetch('SELECT * FROM dbProj_Media WHERE media_id = ' . $media_id);
    $this->initWith($data->media_id, $data->URL, $data->article_id, $data->type_name);
}

    
    public static function getMedia($article_id){
        $db = Database::getInstance();
        $data = $db->multiFetch('SELECT * FROM dbProj_Media WHERE article_id = ' . $article_id );
        return $data;
    }
    
    public function isValid(){
        $errors = true;

        if (empty($this->article_id))
            $errors = false;

        if (empty($this->URL))
            $errors = false;

        if (empty($this->type_name))
            $errors = false;
        
        return $errors;
    }
    
    function addMedia(){
        if($this->isValid()){
            $db = Database::getInstance();
            //insert article into db 
//            echo 'INSERT INTO dbProj_Media (URL, article_id, type_name)'
//                    . 'VALUES (\''. $this->URL . '\',\'' . $this->article_id . '\',\'' . $this->type_name . '\')';
            
          $query = 'INSERT INTO dbProj_Media (URL, article_id, type_name)'
         . 'VALUES (\'' . $this->URL . '\', \'' . $this->article_id . '\', \'' . $this->type_name . '\')';

            $db->querySql($query); 
            return true;
        }
    }
    
}