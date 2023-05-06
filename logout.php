<?php
ob_start();
session_start();

include 'header.php';

$lgnObject = new Login();
$lgnObject->logout();

header('Location: index.php');
exit;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

