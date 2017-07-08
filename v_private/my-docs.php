<?php
require_once __DIR__ . '/../partials/_init.php';
?>
<html>
    <head>

        <?php include_once __DIR__ . '/../partials/_head.php'; ?>
        <title>Os Meus Documentos</title>
    </head>
    <body>
        <?php include_once '../partials/_header.php'; ?>
        <script src="../scripts/my-docs.js" type="text/javascript"></script>
        <h1 id="main-title">Meus Documentos</h1> 
        <?php
        if (SessionManager::keyExists('authUsername')) {
            require_once Config::getApplicationManagerPath() . "DocumentManager.php";
            $docManager = new DocumentManager();
            $arrayDocsAtual = $docManager->getDocumentByUserID(SessionManager::getSessionValue('authUsername'));
            $sharedDocs = $docManager->getSharedDocsByUserID(SessionManager::getSessionValue('authUsername'));
            ?>
            <div class="topIndex docsContainer">
                <div id="mydocs">
                    <h3>Os Meus Documentos</h3>
                    <ul>
                        <?php
                        foreach ($arrayDocsAtual as $value) {
                            ?>
                            <li class="docs"><a href="../v_public/view-document.php?id=<?= $value->getDocumentID() ?>"><?= $value->getDocumentTITLE() ?></a><a class="edit" href="edit-document.php?id=<?= $value->getDocumentID() ?>">Editar</a><a href="delete-document.php?id=<?= $value->getDocumentID() ?>">Eliminar</a></li>

                            <?php
                        }
                        ?>
                    </ul>  
                </div>

                <div id="sharedDocs">
                    <h3>Documentos Partilhados</h3>
                    <ul>
                        <?php
                        foreach ($sharedDocs as $value) {
                            ?>
                            <li class="docs">
                                <?php
                                try {
                                    $document = $docManager->getDocumentByID($value['DocumentID']);
                                    ?>
                                    <a href="../v_public/view-document.php?id=<?= $document->getDocumentID() ?>"> <?= $document->getDocumentTITLE() ?></a>
                                    <?php
                                } catch (DocumentException $ex) {
                                    ?>
                                    <a href="#">Erro ao identificar o documento</a> 
                                    <?php
                                }
                                ?>
                            </li>
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
