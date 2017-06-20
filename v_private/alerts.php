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
        <?php include_once __DIR__ . '/../partials/_head.php'; ?>
        <title></title>
    </head>
    <body>
        <?php include_once '../partials/_header.php'; ?>
        <h1 id="main-title">Alertas</h1>
        <?php
        if (SessionManager::keyExists('authUsername')) {
            
        } else {
            $string = 'Necessário Login';
            $url = "../v_public/authentication.php";
            $text = 'Login';
            include_once __DIR__ . '/../partials/_error.php';
        }
        ?>
        <?php include_once '../partials/_footer.php'; ?>
    </body>
</html>
