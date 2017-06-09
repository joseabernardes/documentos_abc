<?php
require_once __DIR__ . '/../partials/_init.php';

require_once Config::getApplicationManagerPath() . 'AddressManager.php';
require_once Config::getApplicationModelPath() . 'AddressModel.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include_once '../partials/_head.php'; ?>
        <title>Perfil</title>
    </head>
    <body>
        <?php include_once '../partials/_header.php'; ?>
        <h1 id="main-title">Perfil</h1>
        <div class="card">
            <img src="..<?= $userModel->getUserPHOTO(); ?>" alt="COta" style="width:100%"/>
            <?php
            $addressManagement = new AddressManager();
            $addressQ = $addressManagement->getAddressByID($userModel->getUserADDRESS());
            $addModel = reset($addressQ);
            ?>
            <p><?= $userModel->getUserNAME(); ?></p>
            <p><?= $addModel->getAddressCITY(); ?></p>
            <a>Contact</a>
        </div>
        APRESENTAR LISTA DE DOCUMENTOS INSERIDOS, CONSIDERANDO AS PERMISSÕES

        <?php include_once '../partials/_footer.php'; ?>
    </body>
</html>
