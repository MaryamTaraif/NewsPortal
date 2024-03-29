<?php

class Users {

    private $user_id;
    private $username;
    private $password;
    private $email;
    private $type_name;

    function __construct() {
        $this->user_id = null;
        $this->username = null;
        $this->password = null;
        $this->email = null;
        $this->type_name = null;
    }

    function getUser_id() {
        return $this->user_id;
    }

    function getUsername() {
        return $this->username;
    }

    function getPassword() {
        return $this->password;
    }

    function getEmail() {
        return $this->email;
    }

    function setUser_id($user_id) {
        $this->user_id = $user_id;
        return $this;
    }

    function setUsername($username) {
        $this->username = $username;
        return $this;
    }

    public function getType_name() {
        return $this->type_name;
    }

    public function setType_name($type_name) {
        $this->type_name = $type_name;
        return $this;
    }

    function setPassword($password) {
        $this->password = $password;
        return $this;
    }

    function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    function initWith($user_id, $username, $password, $email, $type_name) {
        $this->user_id = $user_id;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->type_name = $type_name;
    }

    function initWithUid($user_id) {
        $db = Database::getInstance();
        $data = $db->singleFetch('SELECT * FROM dbProj_User WHERE user_id = \'' . $user_id . '\'');
        $this->initWith($data->user_id, $data->username, $data->password, $data->email, $data->type_name);
    }

//    function checkUser($username, $password) {
//        $db = Database::getInstance();
//        echo 'SELECT * FROM dbProj_User WHERE username = \'' . $username . '\' AND password = \'' . $password . '\'';
//        $data = $db->singleFetch('SELECT * FROM dbProj_User WHERE username = \'' . $username . '\' AND password = \'' . $password . '\'');
//        $this->initWith($data->user_id, $data->username, $data->role, $data->password, $data->email);
//    }


    function checkUser($username, $password) {
        $db = Database::getInstance();
        $stmt = $db->prepare('SELECT * FROM dbProj_User WHERE username = ?');
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $data = $result->fetch_object();
            if (password_verify($password, $data->password)) {
                $this->initWith($data->user_id, $data->username, $data->password, $data->email, $data->type_name);
                return true;
            }
        }

        return false;
    }

    function registerUser() {
        try {
            $db = Database::getInstance();
            $stmt = $db->prepare('INSERT INTO dbProj_User (user_id, username, password, email, type_name) VALUES (null, ?, ?, ?, ?)');
            $stmt->bind_param('ssss', $this->username, $this->password, $this->email, $this->type_name);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            echo 'Exception: ' . $e;
            return false;
        }
    }

    function deleteuser() {
        try {
            $db = Database::getInstance();
            $data = $db->querySql('Delete from dbProj_User where user_id=' . $this->user_id);
            if ($data > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo 'Exception: ' . $e;
            return false;
        }
    }

    function initWithUsername() {
        $db = Database::getInstance();
        $data = $db->singleFetch('SELECT * FROM dbProj_User WHERE username = \'' . $this->username . '\'');
        if ($data != null) {
            return false;
        }
        return true;
    }

    function getAllusers() {
        $db = Database::getInstance();
        $data = $db->multiFetch('Select * from dbProj_User');
        return $data;
    }

    function updateDB() {

        if ($this->isValid()) {


            $db = Database::getInstance();
            $data = 'UPDATE dbProj_User set
			email = \'' . $this->email . '\' ,
			username = \'' . $this->username . '\' ,
			password = \'' . $this->password . '\',
                            type_name = \'' . $this->type_name . '\'
				WHERE user_id = ' . $this->user_id;
            $db->querySql($data);
        }
    }

    public function isValid() {
        $errors = true;

        if (empty($this->username))
            $errors = false;

        if (empty($this->type_name))
            $errors = false;


        if (empty($this->email))
            $errors = false;


        if (empty($this->password))
            $errors = false;

        return $errors;
    }

    public static function getTypes() {
        $db = Database::getInstance();
        $data = $db->multiFetch('select * from dbProj_User_type ');
        return $data;
    }

//    
//    public static function getAuthorId($authorName){
//        $db = Database::getInstance();
//        $data = $db->singleFetch('select user_id from dbProj_User where username ');
//        return $data;
//    }

    public static function getAuthors() {
        $db = Database::getInstance();
        $data = $db->multiFetch("select * from dbProj_User where type_name = 'Author' or type_name = 'Admin'");
        return $data;
    }

    //featurd profile statistics 
    public static function getTopAuthor() {
        try {
            $db = Database::getInstance();
            $result = $db->singleFetch('CALL GetTopAuthor()');
            if ($result) {
                $resultArray = json_decode(json_encode($result), true);
                return $resultArray;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo 'Exception: ' . $e->getMessage();
            return false;
        }
    }

    public static function getUserStats($user_id) {
        $db = Database::getInstance();
        $result = $db->singleFetch("CALL GetUserStats($user_id)");

        if ($result) {
            $resultArray = json_decode(json_encode($result), true);
            return $resultArray;
        } else {
            return false;
        }
    }

}
