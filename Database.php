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
        $this->dblink = mysqli_connect('localhost', 'u202002084', 'u202002084', 'db202002084') or die('CAN NOT CONNECT');
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
    
       function prepare($sql) {
        return mysqli_prepare($this->dblink, $sql);
    }


    function singleFetch($sql) {
        $sql = $this->mkSafe($sql);
        $fet = null;
        if ($sql != null || $sql != '') {
            $stmt = mysqli_prepare($this->dblink, $sql);
            if ($stmt === false) {
                die('Error in preparing statement: ' . mysqli_error($this->dblink));
            }
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $fet = mysqli_fetch_object($result);
            mysqli_stmt_close($stmt);
        }
        return $fet;
    }
    function multiFetch($sql) {
        $sql = $this->mkSafe($sql);
        $result = null;
        $counter = 0;
        if ($sql != null || $sql != '') {
            $stmt = mysqli_prepare($this->dblink, $sql);
            if ($stmt === false) {
                die('Error in preparing statement: ' . mysqli_error($this->dblink));
            }
            mysqli_stmt_execute($stmt);
            $stmt_result = mysqli_stmt_get_result($stmt);
            while ($fet = mysqli_fetch_object($stmt_result)) {
                $result[$counter] = $fet;
                $counter++;
            }
            mysqli_stmt_close($stmt);
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

