<?php
require_once __DIR__ . '/../partials/_init.php';
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Gerir Categorias</title>
        <?php include_once '../partials/_head.php'; ?>
        <script src="../scripts/categories.js" type="text/javascript"></script>
    </head>
    <body>
        <?php include_once '../partials/_header.php'; ?> 
        <h1 id="main-title">Gerir Categorias</h1>
        <div id="sharedBox">
            <div id="searchBar">
                <input type="text" id="addUser"/>
                <input type="button" id="addButton" value="+">
            </div>
            <!--for botao elimmine -->
        </div>    

        <?php include_once '../partials/_footer.php'; ?>
    </body>
</html>
