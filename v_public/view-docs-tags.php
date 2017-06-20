<?php
require_once __DIR__ . '/../partials/_init.php';
require_once Config::getApplicationManagerPath() . 'UserManager.php';
require_once Config::getApplicationManagerPath() . 'DocumentManager.php';

$tag = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$docsTag = new DocumentManager();
$arrDocsTag = $docsTag->getDocumentByTag($tag);
$tempArrayDocsTag = array();
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
        <title>Documentos - Palavras Chave</title>
    </head>
    <body>
        <?php
        include_once '../partials/_header.php';
        if (empty($arrDocsTag)) {
            ?>
            <h1 id = "main-title">Documentos</h1 >
            <?php
            $string = 'Nenhum documento com essa palavra-chave';
            $url = "index.php";
            $text = 'Sair';
            include_once __DIR__ . '/../partials/_error.php';
        } else {
            $docTagAtual = reset($arrDocsTag);
            ?>
            <h1 id = "main-title">Documentos - #<?= $tag ?> </h1 >
            <?php
            foreach ($arrDocsTag as $value) {
                if ($value->getDocumentVisibilityId() == 1) {
                    array_push($tempArrayDocsTag, $value);
                } else if ($value->getDocumentVisibilityId() == 2) {
                    if (SessionManager::keyExists('authUsername')) {
                        if ($value->getDocumentUserId() === SessionManager::getSessionValue('authUsername')) {
                            array_push($tempArrayDocs, $value);
                        }
                    }
                } else if ($value->getDocumentVisibilityId() == 3) {
                    if (SessionManager::keyExists('authUsername')) {
                        $sharedDocsAtual1 = $manDocs->getSharedUsersByUser_DocumentID(SessionManager::getSessionValue('authUsername'), $value->getDocumentID());
                        $sharedDocsAtual1 = reset($sharedDocsAtual1);
                        if ($sharedDocsAtual || $value->getDocumentUserId() === SessionManager::getSessionValue('authUsername')) {
                            array_push($tempArrayDocs, $value);
                        }
                    }
                }
            }
        }
        ?>


        <?php include_once '../partials/_footer.php'; ?>
    </body>
</html>
