<?php
require_once __DIR__ . '/../partials/_init.php';
require_once Config::getApplicationManagerPath() . 'DocumentManager.php';
require_once Config::getApplicationManagerPath() . 'UserManager.php';
require_once Config::getApplicationManagerPath() . 'CategoryManager.php';

$catid = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$manDocs = new DocumentManager();
$arrayUsersCat = $manDocs->getDocumentByCategory($catid);
$manCat = new CategoryManager();
$arrayCats = $manCat->getCategoryByID($catid);
$catNameAtual = reset($arrayCats);
?>



<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <?php include_once __DIR__ . '/../partials/_head.php'; ?>
        <meta charset="UTF-8">
        <title></title> 
    </head>
    <body>
        <?php include_once '../partials/_header.php'; ?>
        <h1 id="main-title">Documentos -<?= $catNameAtual->getCategoryNAME()?></h1>
        <?php
        foreach ($arrayUsersCat as $value) {
            
        }
        ?>
        
        

        <?php include_once '../partials/_footer.php'; ?>
    </body>
</html>
