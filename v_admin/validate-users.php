<?php
require_once __DIR__ . '/../partials/_init.php';
require_once Config::getApplicationManagerPath() . 'UserManager.php';
require_once Config::getApplicationManagerPath() . 'AddressManager.php';
require_once Config::getApplicationModelPath() . 'UserModel.php';
require_once Config::getApplicationModelPath() . 'AddressModel.php';
$UserManager = new UserManager();
$usersAuthLevel = $UserManager->getUserByAuthLevel('USERINACTIVE');
$addressM = new AddressManager();

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
        <title>Validar Utilizadores</title>
        <?php include_once '../partials/_head.php'; ?>
    </head>
    <body>
        <?php include_once '../partials/_header.php'; ?> 
        <h1 id="main-title">Validar Utilizadores</h1>

        <section>
            <?php foreach ($usersAuthLevel as $value) {
                $ad = $addressM->getAddressByID($value->getUserADDRESS());
                $ad= reset($ad);
                ?>
            <article class="article">
                    <ul>
                        <li class="classe"> <img id="image" src="..<?= $value->getUserPHOTO()?>" alt="ALT"></li>
                        <li class="classe"> <label>Nome:</label> <?= $value->getUserNAME()?></li>
                        <li class="classe"> <label>Tele:</label> <?= $value->getUserPHONE()?></li>
                        <li class="classe"> <label>Nome:</label> <?= $ad->getAddressCITY()?></li>
                        <input type="checkbox"><label>Validar</label>
                    </ul>           
                </article>
            <?php } ?>
        </section>
    <?php include_once '../partials/_footer.php'; ?>
    </body>
</html>
