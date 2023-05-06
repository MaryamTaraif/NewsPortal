<?php

class Database {

    public static $instance = null;
    public $dblink = null;

    public static function getInstance() {
        if (is_null(self::$instance)) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    function __construct() {
        if (is_null($this->dblink)) {
            $this->connect();
        }
    }

    function connect() {
        $this->dblink = mysqli_connect('localhost', 'u202003447', 'u202003447', 'db202003447') or die('CAN NOT CONNECT');
    }

    function __destruct() {
        if (!is_null($this->dblink)) {
            $this->close($this->dblink);
        }
    }

    function close() {
        mysqli_close($this->dblink);
    }

    function querySQL($sql) {
        if ($sql != null || $sql != '') {
            $sql = $this->mkSafe($sql);
            mysqli_query($this->dblink, $sql);
        }
    }

    function singleFetch($sql) {
        $sql = $this->mkSafe($sql);
        $fet = null;
        if ($sql != null || $sql != '') {
            $res = mysqli_query($this->dblink, $sql);
            $fet = mysqli_fetch_object($res);
        }
        return $fet;
    }

    function multiFetch($sql) {
        $sql = $this->mkSafe($sql);
        $result = null;
        $counter = 0;
        if ($sql != null || $sql != '') {
            $res = mysqli_query($this->dblink, $sql);
            while ($fet = mysqli_fetch_object($res)) {
                $result[$counter] = $fet;
                $counter++;
            }
        }
        return $result;
    }

    function mkSafe($string) {
        /* $string = strip_tags($string);
          if (!get_magic_quotes_gpc()) {
          $string = addslashes($string);
          } else {
          $string = stripslashes($string);
          }
          $string = str_ireplace("script", "blocked", $string);
          $string = addcslashes($escaped, '%_');

          $string = trim($string); */
        //$newString = mysqli_escape_string($this->dblink, $string); 

        return $string;
    }

    function getRows($sql) {
        $rows = 0;
        if ($sql != null || $sql != '') {
            $result = mysqli_query($this->dblink, $sql);
            $rows = mysqli_num_rows($result);
        }
        return $rows;
    }

}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

