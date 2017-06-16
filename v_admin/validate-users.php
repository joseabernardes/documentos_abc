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
        <script src="../scripts/validateusers.js" type="text/javascript"></script>
    </head>
    <body>
        <?php include_once '../partials/_header.php'; ?> 
        <h1 id="main-title">Validar Utilizadores</h1>

        <section>
            <?php
            foreach ($usersAuthLevel as $value) {
                $ad = $addressM->getAddressByID($value->getUserADDRESS());
                $ad = reset($ad);
                ?>
                <article class="article">
                    <img id="image" src="..<?= $value->getUserPHOTO() ?>" alt="ALT">
                    <p><?= $value->getUserNAME() ?></p>
                    <p><?= $ad->getAddressCITY() ?></p>
                    <p><?= $value->getUserPHONE() ?></p>

                    <input class="check" id="<?= $value->getUserID() ?>"type="checkbox"><label for="<?= $value->getUserID() ?>" class="valid">Validar</label>

                </article>
            <?php } ?>
        </section>
        <?php include_once '../partials/_footer.php'; ?>
    </body>
</html>
