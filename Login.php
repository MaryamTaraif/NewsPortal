<?php

Class Login extends Users {

    public $ok;
    public $salt;
    public $domain;

    function __construct() {
        parent::__construct();
        $this->ok = false;
        $this->salt = 'ENCRYPT';
        $this->domain = '';

        if (!$this->check_session())
            $this->check_cookie();

        return $this->ok;
    }

    function check_session() {

        if (!empty($_SESSION['user_id'])) {
            $this->ok = true;
            return true;
        } else
            return false;
    }

    function check_cookie() {
        if (!empty($_COOKIE['user_id'])) {
            $this->ok = true;
            return $this->check($_COOKIE['user_id']);
        } else
            return false;
    }

    function check($user_id) {
        $this->initWithUid($user_id);
        if ($this->getUser_id() != null && $this->getUser_id() == $user_id) {
            $this->ok = true;
            $_SESSION['user_id'] = $this->getUser_id();
            $_SESSION['username'] = $this->getUsername();

            setcookie('user_id', $_SESSION['user_id'], time() + 60 * 60 * 24 * 7, '/', $this->domain);
            setcookie('username', $_SESSION['username'], time() + 60 * 60 * 24 * 7, '/', $this->domain);

            return true;
        } else
            $error[] = 'Wrong Username';


        return false;
    }

    function login($username, $password) {

        try {

            $this->checkUser($username, $password);
            if ($this->getUser_id() != null) {
                $this->ok = true;

                $_SESSION['user_id'] = $this->getUser_id();
                $_SESSION['username'] = $this->getUsername();
                $_SESSION['role'] = $this->getType_name();
                setcookie('user_id', $_SESSION['user_id'], time() + 60 * 60 * 24 * 7, '/', $this->domain);
                setcookie('username', $_SESSION['username'], time() + 60 * 60 * 24 * 7, '/', $this->domain);
                setcookie('role', $_SESSION['role'], time() + 60 * 60 * 24 * 7, '/', $this->domain);
                return true;
            } else {

                $error[] = 'Wrong Username OR password';
            }
            return false;
        } catch (Exception $e) {
            $error[] = $e->getMessage();
        }

        return false;
    }

    function logout() {
        $this->ok = false;
        $_SESSION['user_id'] = '';
        $_SESSION['username'] = '';
        $_SESSION['role'] = '';
        setcookie('user_id', '', time() - 3600, '/', $this->domain);
        setcookie('username', '', time() - 3600, '/', $this->domain);
        setcookie('role', '', time() - 3600, '/', $this->domain);
        session_destroy();
    }

}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

