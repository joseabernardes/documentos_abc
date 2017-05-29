<?php
require_once __DIR__ . '/../Config.php';
require_once Config::getApplicationManagerPath() . 'SessionManager.php';
SessionManager::startSession();

?>




<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <?php include_once '../partials/_head.php'; ?>
        <title>Main</title>

    </head>
    <body>
        <?php include_once '../partials/_header.php'; ?>
        <br>
        <br>
        <input type="search">
        <br>
        <br> 
        <?php
        

       echo preg_match('/^[\pL\d ]{1,90}$/u', 'sdfghjçhjkl');
        
        
        
        
        
        ?>
        <br> 
        <br>
        <br>
        <br>
        <br> 
        <br>

        <?php include_once '../partials/_footer.php'; ?>
    </body>
</html>
