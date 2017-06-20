<?php
require_once __DIR__ . '/../partials/_init.php';
require_once Config::getApplicationManagerPath() . 'UserManager.php';
require_once Config::getApplicationManagerPath() . 'AddressManager.php';

$UserManager = new UserManager();
$usersAuthLevel = $UserManager->getUserByAuthLevel('USER');
$usersAuthLevel1 = $UserManager->getUserByAuthLevel('USERINACTIVE');
$arrayAuthlevel2 = array_merge($usersAuthLevel, $usersAuthLevel1);
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
        <?php
        if (SessionManager::keyExists('authUsername')) {
            $um = new UserManager();
            $mu = $um->getUserByID(SessionManager::getSessionValue('authUsername'));
            $u = reset($mu);
            if ($u->getUserAUTHLEVEL() === 'ADMIN') {
                ?>
                <section>
                    <?php
                    foreach ($arrayAuthlevel2 as $value) {
                        $ad = $addressM->getAddressByID($value->getUserADDRESS());
                        $ad1 = reset($ad);
                        ?>
                        <article class="article">
                            <img id="image" src="..<?= $value->getUserPHOTO() ?>" alt="ALT">
                            <p><?= $value->getUserNAME() ?></p>
                            <p><?= $ad1->getAddressCITY() ?></p>
                            <p><?= $value->getUserPHONE() ?></p>

                            <input <?= ($value->getUserAUTHLEVEL() == 'USER') ? 'checked' : '' ?> class="check" id="<?= $value->getUserID() ?>"type="checkbox"><label for="<?= $value->getUserID() ?>" class="valid"><?= ($value->getUserAUTHLEVEL() == 'USER') ? 'Invalidar' : 'Validar' ?></label>
                        </article>
                    <?php } ?>
                </section>
                <?php
            } else {
                $string = 'Não tens permissões para tal!';
                $url = '../v_public/authentication.php';
                $text = 'Login';
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
