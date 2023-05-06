<?php

class Users {

    private $user_id;
    private $username;
    private $role;
    private $password;
    private $email;

    function __construct() {
        $this->user_id = null;
        $this->username = null;
        $this->role = null;
        $this->password = null;
        $this->email = null;
    }

    function getUser_id() {
        return $this->user_id;
    }

    function getUsername() {
        return $this->username;
    }

    function getRole() {
        return $this->role;
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

    function setRole($role) {
        $this->role = $role;
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

    function initWith($user_id, $username, $role, $password, $email) {
        $this->user_id = $user_id;
        $this->username = $username;
        $this->role = $role;
        $this->password = $password;
        $this->email = $email;
    }

    function initWithUid($user_id) {
        $db = Database::getInstance();
        $data = $db->singleFetch('SELECT * FROM dbProj_User WHERE user_id = \'' . $user_id);
        $this->initWith($data->user_id, $data->username, $data->role, $data->password, $data->email);
    }

//    function checkUser($username, $password) {
//        $db = Database::getInstance();
//        echo 'SELECT * FROM dbProj_User WHERE username = \'' . $username . '\' AND password = \'' . $password . '\'';
//        $data = $db->singleFetch('SELECT * FROM dbProj_User WHERE username = \'' . $username . '\' AND password = \'' . $password . '\'');
//        $this->initWith($data->user_id, $data->username, $data->role, $data->password, $data->email);
//    }


    function checkUser($username, $password) {
        $db = Database::getInstance();
        $data = $db->singleFetch('SELECT * FROM dbProj_User WHERE username = \'' . $username . '\'');
        if ($data != null && password_verify($password, $data->password)) {
            $this->initWith($data->user_id, $data->username, $data->role, $data->password, $data->email);
            return true;
        } else {
            return false;
        }
    }

    function registerUser() {
        try {
            $db = Database::getInstance();
            $query = 'INSERT INTO dbProj_User (user_id, username,role,password,email) VALUES (null, \'' . $this->username . '\',\'' . $this->role . '\',\'' . $this->password . '\',\'' . $this->email . '\')';
            echo $query;
            $db->querySql($query);
            return true;
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

    public function isValid() {
        $errors = true;

        if (empty($this->username))
            $errors = false;

        if (empty($this->role))
            $errors = false;


        if (empty($this->email))
            $errors = false;


        if (empty($this->password))
            $errors = false;

        return $errors;
    }

    // ...
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

