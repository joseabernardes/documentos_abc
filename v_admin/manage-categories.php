<?php
require_once __DIR__ . '/../partials/_init.php';
require_once Config::getApplicationManagerPath() . 'CategoryManager.php';
require_once Config::getApplicationModelPath() . 'CategoryModel.php';
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
        <?php
        if (SessionManager::keyExists('authUsername')) {

            $umng1 = new UserManager();
            $mu1 = $umng1->getUserByID(SessionManager::getSessionValue('authUsername'));
            $us1 = reset($mu1);
            if ($us1->getUserAUTHLEVEL() === 'ADMIN') {
                ?>
                <div id="search">
                    <input type="text" id="inputS"/>
                    <input type="button" id="addButton" value="+">
                </div>
                <ul id="manageCat">
                    <?php
                    $categMan = new CategoryManager();
                    $catArray = $categMan->getAllCategories();

                    foreach ($catArray as $value) {
                        ?>
                        <li class="cate"><input class="delete" type="button" value="-" id="<?= $value->getCategoryID() ?>"/><?= $value->getCategoryNAME() ?></li>
                        <?php } ?>
                </ul>       
                <?php
            } else {
                $string = 'Não tens permissões para tal!';
                $url = '../v_public/index.php';
                $text = 'Sair';
                include_once __DIR__ . '/../partials/_error.php';
            }
        } else {
            $string = 'Necessário autenticação';
            $url = '../v_public/authentication.php';
            $text = 'Login';
            include_once __DIR__ . '/../partials/_error.php';
        }
        ?>
        <?php include_once '../partials/_footer.php'; ?>
    </body>
</html>
