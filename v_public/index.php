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
                <input type="text" id="inputS"/>
                <input type="button" id="addButton" value="⌕">
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
            <ul id="searchResults">
                <li>
                    <h3>#331 Enunciado PAW</h3><span class="date">2017-06-14 10:39:19</span>
                    <h4>Resumo:</h4><span class="sum">O que é um projeto:
                        É um empreendimento temporário que tem por finalidade criar uma obra única. Temporário porque tem início, meio e fim limitados e definidos. Obra única por resultar na criação de um produto ou serviço ou mesmo resultado que não ocorreu antes nas mesmas circunstancias.
                    </span>
                    <h4 class="tagsTitle">Tags:</h4><span>ola, bom, dia</span>

                </li>


            </ul>

            <!--            <div id="articles">dd
                        </div>
                        <div style="clear: right;"></div>-->
        </main>
        <?php include_once '../partials/_footer.php'; ?>
    </body>
</html>
