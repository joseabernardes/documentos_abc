<?php
require_once __DIR__ . '/../partials/_init.php';
require_once Config::getApplicationModelPath() . 'CategoryModel.php';
require_once Config::getApplicationManagerPath() . 'CategoryManager.php';
$inputType=INPUT_POST;

$catMan = new CategoryManager();
$cat = new CategoryModel('','');

if(filter_has_var($inputType, 'guardar') && $_SERVER['REQUEST_METHOD'] === 'POST'){
    
}
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
        <title>Criar Categoria</title>
<?php include_once '../partials/_head.php'; ?>
    </head>
    <body>
<?php include_once '../partials/_header.php'; ?> 
        <h1 id="main-title">Gerir Categorias</h1>

        
<?php include_once '../partials/_footer.php'; ?>
    </body>
</html>