<?php
require_once __DIR__ . '/../partials/_init.php';
require_once Config::getApplicationManagerPath() . 'UserManager.php';
require_once Config::getApplicationManagerPath() . 'CategoryManager.php';
require_once Config::getApplicationManagerPath() . 'DocumentManager.php';

$catid = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$manDocs = new DocumentManager();
$arrayDocsCat = $manDocs->getDocumentByCategory($catid);
$manCat = new CategoryManager();
$arrayCats = $manCat->getCategoryByID($catid);
$catNameAtual = reset($arrayCats);

$tempArrayDocs = array();
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
        <?php
        include_once '../partials/_header.php';
        if (empty($catNameAtual)) {
            ?>
            <h1 id="main-title">Documentos</h1>
            <?php
            $string = 'Categoria não existe';
            $url = "index.php";
            $text = 'Sair';
            include_once __DIR__ . '/../partials/_error.php';
        } else {
            ?>
            <h1 id="main-title">Documentos - <?= $catNameAtual->getCategoryNAME() ?></h1>
            <?php
            if (!empty($arrayDocsCat)) {
                ?>
                <?php
                foreach ($arrayDocsCat as $value) {
                    if ($value->getDocumentVisibilityId() == 1) {
                        array_push($tempArrayDocs,$value);
                    } else if ($value->getDocumentVisibilityId() == 2) {
                        if (SessionManager::keyExists('authUsername')) {
                            if ($value->getDocumentUserId() === SessionManager::getSessionValue('authUsername')) {
                                array_push($tempArrayDocs, $value);
                            }
                        }
                    } else if ($value->getDocumentVisibilityId() == 3) {
                        if (SessionManager::keyExists('authUsername')) {
                            $sharedDocsAtual = $manDocs->getSharedUsersByUser_DocumentID(SessionManager::getSessionValue('authUsername'), $value->getDocumentID());
                            $sharedDocsAtual = reset($sharedDocsAtual);
                            if ($sharedDocsAtual || $value->getDocumentUserId() === SessionManager::getSessionValue('authUsername')) {
                                array_push($tempArrayDocs, $value);
                            }
                        }
                    }
                }
            } else {
                $string = 'Nenhum documento com essa categoria';
                $url = "index.php";
                $text = 'Sair';
                include_once __DIR__ . '/../partials/_error.php';
            }
        }
        ?>
        <div>
            <?php
            if (!empty($tempArrayDocs)) {
                $ManagerUsers = new UserManager();
                foreach ($tempArrayDocs as $value) {
                    $arrayUserDocsAtual = $ManagerUsers->getUserByID($value->getDocumentUserId());
                    $userDocAtual = reset($arrayUserDocsAtual);
                    ?>
                    <p><a href="../v_private/view-document.php?id=<?=$value->getDocumentID() ?>"><?= $value->getDocumentTITLE()?></a></p>
                    <p><a href="../v_private/profile-page.php?id=<?=$value->getDocumentUserId() ?>"><?= $userDocAtual->getUserNAME()?></a></p>
                    <p><?= $value->getDocumentDATE() ?></p>
                    <?php
                }
            }
            ?>             
        </div>


        <?php include_once '../partials/_footer.php'; ?>
    </body>
</html>
