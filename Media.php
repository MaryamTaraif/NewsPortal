<?php

class Media {
    
    private $media_id;
    private $url;
    private $article_id;
    private $type_name;
    
    public function __construct() {
        $this->media_id = null;
        $this->url = null;
        $this->article_id = null;
        $this->type_name = null;
    }
    
    public function getMedia_id() {
        return $this->media_id;
    }

    public function getUrl() {
        return $this->url;
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
        $this->url = $url;
    }

    public function setArticle_id($article_id): void {
        $this->article_id = $article_id;
    }

    public function setType_name($type_name): void {
        $this->type_name = $type_name;
    }
    
    function initWith($media_id, $url, $article_id, $type_name) {
        $this->media_id = $media_id;
        $this->url = $url;
        $this->article_id = $article_id;
        $this->type_name = $type_name;
    }

    function initWithId($media_id) {
        $db = Database::getInstance();
        $data = $db->singleFetch('SELECT * FROM dbProj_Media WHERE media_id = ' . $media_id);
        $this->initWith($data->media_id, $data->url, $data->article_id, $data->type_name);
    }
    
    public static function getPhotoURL($article_id){
        $db = Database::getInstance();
        $data = $db->singleFetch('SELECT * FROM dbProj_Media WHERE type_name = "image" and article_id = ' . $article_id);
        return $data;
        
    }
    
    public static function getVideoURL($article_id){
        $db = Database::getInstance();
        $data = $db->singleFetch('SELECT * FROM dbProj_Media WHERE type_name = "video" and article_id = ' . $article_id);
        return $data; 
    }
    
    public static function getAudioURL($article_id){
        $db = Database::getInstance();
        $data = $db->singleFetch('SELECT * FROM dbProj_Media WHERE type_name = "audio" and article_id = ' . $article_id);
        return $data; 
    }
    
    public static function getDownloadableFile ($article_id){
        $db = Database::getInstance();
        $data = $db->singleFetch('SELECT * FROM dbProj_Media WHERE type_name = "file" and article_id = ' . $article_id);
        return $data;
    }
    
    public function isValid(){
        $errors = true;

        if (empty($this->article_id))
            $errors = false;

        if (empty($this->url))
            $errors = false;

        if (empty($this->type_name))
            $errors = false;
        
        return $errors;
    }
    
    function addMedia(){
        if($this->isValid()){
            $db = Database::getInstance();
            //insert article into db 
            $query = 'INSERT INTO dbProj_Media (url, article_id, type_name)'
                    . 'VALUES (\''. $this->url . '\',\'' . $this->article_id . '\',\'' . $this->type_name . '\')';
            $result = $db->querySql($query); 
            if ($result){
                return true;
            }
            else {
                return false;
            }
        }
    }
    
    function updateMedia(){
        if($this->isValid()){
            $db = Database::getInstance();
            $query = 'UPDATE dbProj_Media SET url = \'' . $this->url .'\','
                    . ' type_name = \'' . $this->type_name .'\' WHERE media_id = ' . $this->media_id;
            $result = $db->querySql($query); 
            if ($result){
                return true;
            }
            else {
                return false;
            }
        }
    }
    
    function deleteMedia(){
        $db = Database::getInstance();
        $result = $db->querySql('DELETE FROM dbProj_Media WHERE media_id = '. $this->media_id);
        if ($result){
            return true;
        }
        else {
            return false;
        }
    }
}