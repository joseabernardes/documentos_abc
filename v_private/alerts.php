<?php
require_once __DIR__ . '/../partials/_init.php';

require_once Config::getApplicationManagerPath() . 'AlertManager.php';
require_once Config::getApplicationManagerPath() . 'UserManager.php';
require_once Config::getApplicationManagerPath() . 'DocumentManager.php';

$alerts = new AlertManager();
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
            $arrayAlerts = $alerts->getAlertsByUserID(SessionManager::getSessionValue('authUsername'));
            if (!empty($arrayAlerts)) {
                $alertUsers = new UserManager();
                $alertDocs = new DocumentManager();
                foreach ($arrayAlerts as $value) {
                    /*user o qual foi partilhado*/
                    $arrayAlertUsers = $alertUsers->getUserByID($value->getAlertUserID());
                    $userAlertAtual = reset($arrayAlertUsers);
                    /*documento que foi partilhado*/
                    $arrayAlertDocs = $alertDocs->getDocumentByID($value->getAlertDocumentID());
                    $docAlertAtual = reset($arrayAlertDocs);
                    /*user que partilhou*/
                    $userpart = $alertUsers->getUserByID($docAlertAtual->getDocumentUserId());
                    $userpart = reset($userpart);
                    ?>
                    <p>O<a href="profile-page.php?id=<?= $userpart->getUserID() ?>"><?= $userpart->getUserNAME()?></a> partilhou consigo o documento <a href="view-document.php?id<?=$docAlertAtual->getDocumentID()?>"><?= $docAlertAtual->getDocumentTITLE() ?></a></p>
                    <?php
                    $alerts->deleteAlert($value);
                }
            } else {
                $string = 'Não existem alertas';
                $url = "../v_public/index.php";
                $text = 'Sair';
                include_once __DIR__ . '/../partials/_error.php';
            }
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
