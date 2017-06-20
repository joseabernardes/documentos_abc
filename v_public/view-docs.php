<?php
require_once __DIR__ . '/../partials/_init.php';
require_once Config::getApplicationManagerPath() . 'UserManager.php';
require_once Config::getApplicationManagerPath() . 'CategoryManager.php';
require_once Config::getApplicationManagerPath() . 'DocumentManager.php';

$type = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$manDocs = new DocumentManager();
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
        <title>Documentos - Categorias</title> 
    </head>
    <body>
        <?php
        include_once '../partials/_header.php';

        if ($type === 'category' || $type === 'tag') {

            if (!empty($id)) {
                $arrayDocs1 = array();
                if ($type === 'tag') {
                    $arrayDocs1 = $manDocs->getDocumentByTag($id);
                } else if ($type === 'category') {

                    $arrayDocs1 = $manDocs->getDocumentByCategory($id);
                    $manCat = new CategoryManager();
                    $arrayCats = $manCat->getCategoryByID($id);
                    $catNameAtual = reset($arrayCats);
                }
                $tempArrayDocs = array();
                if (empty($arrayDocs1)) {
                    ?>
                    <h1 id="main-title">Documentos</h1>
                    <?php
                    if ($type === 'category') {

                        $string = 'Nenhum documento com essa categoria';
                        $url = "index.php";
                        $text = 'Sair';
                        include_once __DIR__ . '/../partials/_error.php';
                    } else if ($type === 'tag') {

                        $string = 'Nenhum documento com essa palavra-chave';
                        $url = "index.php";
                        $text = 'Sair';
                        include_once __DIR__ . '/../partials/_error.php';
                    }
                } else {
                    if ($type === 'category') {
                        ?>
                        <h1 id="main-title">Documentos - <?= $catNameAtual->getCategoryNAME() ?></h1>
                        <?php
                    } else if ($type === 'tag') {
                        ?>
                        <h1 id="main-title">Documentos - #<?= $id ?></h1>
                        <?php
                    }
                    foreach ($arrayDocs1 as $value) {
                        if ($value->getDocumentVisibilityId() == 1) {
                            array_push($tempArrayDocs, $value);
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
                }
            } else {
                ?>
                <h1 id="main-title">Documentos</h1>         
                <?php
                $string = 'Parametro Inválido';
                $url = "index.php";
                $text = 'Sair';
                include_once __DIR__ . '/../partials/_error.php';
            }
        } else {
            ?>
            <h1 id="main-title">Documentos</h1>   
            <?php
            $string = 'Parametro Inválido';
            $url = "index.php";
            $text = 'Sair';
            include_once __DIR__ . '/../partials/_error.php';
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
                    <p><a href="../v_private/view-document.php?id=<?= $value->getDocumentID() ?>"><?= $value->getDocumentTITLE() ?></a></p>
                    <p><a href="../v_private/profile-page.php?id=<?= $value->getDocumentUserId() ?>"><?= $userDocAtual->getUserNAME() ?></a></p>
                    <p><?= $value->getDocumentDATE() ?></p>
                    <?php
                }
            }
            ?>             
        </div>


        <?php include_once '../partials/_footer.php'; ?>
    </body>
</html>
