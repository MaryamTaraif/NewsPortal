<?php

class Comment {

    private $cid;
    private $content;
    private $uid;
    private $aid;

    public function getCid() {
        return $this->cid;
    }

    public function setCid($cid) {
        $this->cid = $cid;
    }

    public function getContent() {
        return $this->content;
    }

    public function setContent($content) {
        $this->content = $content;
    }

    public function getUid() {
        return $this->uid;
    }

    public function setUid($uid) {
        $this->uid = $uid;
    }
    
     public function getAid() {
        return $this->aid;
    }

    public function setAid($aid) {
        $this->aid = $aid;
    }


    function __construct() {
        $this->cid = null;
        $this->content = null;
        $this->uid = null;
        $this->aid = null;
    }

    function deleteComment() {
        try {
            $db = Database::getInstance();
            $db->querySql('Delete from dbProj_Comment where comment_id=' . $this->cid);
            return true;
        } catch (Exception $e) {
            echo 'Exception: ' . $e;
            return false;
        }
    }

    function initWithCid($cid) {

        $db = Database::getInstance();
        $data = $db->singleFetch('SELECT * FROM dbProj_Comment WHERE comment_id = ' . $cid);
        $this->initWith($data->comment_id, $data->content, $data->user_id, $data->article_id);
    }

   

    private function initWith($cid, $content, $uid, $aid) {
        $this->cid = $cid;
        $this->content = $content;
        $this->uid = $uid;
        $this->aid = $aid;
    }

    function addComment(){
        try{
            $db = Database::getInstance();
            $db->querySql("INSERT INTO dbProj_Comment (comment_id, content, user_id, article_id) VALUES ('$this->cid', '$this->content' , '$this->uid', '$this->aid')");
            return true;
            
        } catch (Exception $e) {
            echo 'Exception: ' . $e;
            return false;
        }
    }
    
    function updateDB() {

        $db = Database::getInstance();
        $data = 'UPDATE dbProj_Comment set
			content = \'' . $this->content . '\' ,
			user_id = \'' . $this->uid . '\',
                        article_id = \'' . $this->aid . '\' 
				WHERE comment_id = ' . $this->cid;
        $db->querySql($data);
    }

    function getAllComments() {
        $db = Database::getInstance();
        $data = $db->multiFetch('Select * from dbProj_Comment');
        return $data;
    }

    public function isValid() {
        $errors = array();

        if (empty($this->content))
            $errors = false;

        if (empty($this->uid))
            $errors = false;
        
        if (empty($this->aid))
            $errors = false;

        return $errors;
    }

}