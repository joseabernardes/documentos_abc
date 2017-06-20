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
        <?php include_once '../partials/_head.php'; ?>
        <script src="../scripts/search.js" type="text/javascript"></script>
        <title>Main</title>

    </head>
    <body>
        <?php include_once '../partials/_header.php'; ?>
        <main id="index">
         
            <div id="search">
                <input placeholder="Pesquise aqui os documentos" type="text" id="inputS"/>
                <div>
                    <input type="radio" id="radioUser" name="type" value="user"><label for="radioUser">Utilizador</label>
                    <input type="radio" checked id="radioTitle" name="type" value="title"><label for="radioTitle">Titulo</label>
                </div>
                <ul>
<!--                    <li>sdasdasdasdsffs</li>
                    <li>sdasdasdasdsffs</li>
                    <li>sdasdasdasdsffs</li>-->

                </ul>


            </div>
            <h3><span>0</span> Documento(s) Encontrado(s)</h3>
            <ul id="searchResults">
                <!--resultados-->
            </ul>

        </main>
        <?php include_once '../partials/_footer.php'; ?>
    </body>
</html>
