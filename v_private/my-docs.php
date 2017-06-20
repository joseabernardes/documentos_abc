<?php
require_once __DIR__ . '/../partials/_init.php';

require_once Config::getApplicationManagerPath() . "DocumentManager.php";
require_once Config::getApplicationModelPath() . "DocumentModel.php";

$docs1 = new DocumentManager();
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
        <title>Os Meus Documentos</title>
        <?php include_once __DIR__ . '/../partials/_head.php'; ?>
    </head>
    <body>
        <?php include_once '../partials/_header.php'; ?>
        <h1 id="main-title">Meus Documentos</h1> 
        <?php
        if (SessionManager::keyExists('authUsername')) {
            $arrayDocsAtual = $docs1->getDocumentByUserID(SessionManager::getSessionValue('authUsername'));
            $sharedDocs = $docs1->getSharedDocsByUserID(SessionManager::getSessionValue('authUsername'));
            ?>
            <div id="all">
                <div id="mydocs">
                    <h2>Os Meus Documentos</h2>
                    <ul>
                        <?php
                        foreach ($arrayDocsAtual as $value) {
                            ?>
                            <li class="docs"><a href="view-document.php?id=<?= $value->getDocumentID() ?>"> <?= $value->getDocumentTITLE() ?></a> <a class="edit" href="view-document.php?id=<?= $value->getDocumentID() ?>">Editar</a></li>

                            <?php
                        }
                        ?>
                    </ul>  
                </div>

                <div id="sharedDocs">
                    <h2>Documentos Partilhados</h2>
                    <ul>
                        <?php
                        foreach ($sharedDocs as $value) {
                            $arrayD = $docs1->getDocumentByID($value['DocumentID']);
                            $arrayDAtual = reset($arrayD);
                            ?>
                            <li class="docs"><a href="view-document.php?id=<?= $arrayDAtual->getDocumentID() ?>"> <?= $arrayDAtual->getDocumentTITLE() ?></a></li>
                                <?php
                            }
                            ?>
                    </ul>  
                </div>
            </div>
            <?php
        } else {
            $string = 'Necessário autenticação';
            $url = '../v_public/authentication.php';
            $text = 'Login';
            include_once __DIR__ . '/../partials/_error.php';
        }
        ?>
        <?php include_once __DIR__ . '/../partials/_footer.php'; ?>
    </body>
</html>
