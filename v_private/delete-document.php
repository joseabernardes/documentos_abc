<?php
$doc_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
require_once __DIR__ . '/../partials/_init.php';
require_once Config::getApplicationManagerPath() . "CategoryManager.php";
require_once Config::getApplicationManagerPath() . "DocumentManager.php";
$docManager = new DocumentManager();

try {
    $doc = $docManager->getDocumentByID($doc_id);
} catch (DocumentException $ex) {
    $doc = false;
    $doc_id = '#####';
}
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include_once __DIR__ . '/../partials/_head.php'; ?>
        <title>Eliminar Documento #<?= $doc_id ?></title>
    </head>
    <body>
        <?php include_once '../partials/_header.php'; ?>
        <?php
        if (SessionManager::keyExists('authUsername')) {
            if ($doc != false) {
                if (SessionManager::getSessionValue('authUsername') == $doc->getDocumentUserId()) {
                    try {
                        require_once Config::getApplicationManagerPath() . "HistoricManager.php";
                        require_once Config::getApplicationManagerPath() . "CommentManager.php";
                        require_once Config::getApplicationManagerPath() . "AlertManager.php";
                        $alertManager = new AlertManager();
                        $alertManager->deleteAlertByDocument($doc_id);
                        $commManager = new CommentManager();
                        $hist = new HistoricManager();
                        $shared = $docManager->getSharedUsersByDocumentID($doc_id);
                        $title = $doc->getDocumentTITLE();
                        $hist->deleteHistoricByDocument($doc_id);
                        $commManager->deleteCommentbyDocument($doc_id);
                        $docManager->deleteSharedUsers($doc_id);
                        $docManager->deleteTagsDocument($doc_id);
                        if ($doc->getDocumentPATH()) { // eliminar o ficheiro, caso exista
                            $path = realpath(__DIR__ . '/..' . $doc->getDocumentPATH());
                            if (is_writable($path)) {
                                unlink($path);
                                echo 'path: ' . $path;
                            } else {
                                throw new Exception();
                            }
                        }
                        $docManager->deleteDocument($doc);
                        $string = 'Documento eliminado com sucesso';
                        $url = 'my-docs.php';
                        $text = 'Voltar';
                        $warning = true;
                        include_once __DIR__ . '/../partials/_error.php';
                        foreach ($shared as $value) {
                            $alertManager->add(new AlertModel('', $value['UserID'], SessionManager::getSessionValue('authUsername'), null, date("Y-m-d H:i:s"), AlertModel::DELETE, $title));
                        }
                    } catch (Exception $ex) {
                        $string = 'Não foi possivel eliminar o documento';
                        $url = 'my-docs.php';
                        $text = 'Voltar';
                        include_once __DIR__ . '/../partials/_error.php';
                    }
                } else {
                    $string = 'Não tem permissões para eliminar o documento';
                    $url = '../v_public/index.php';
                    $text = 'Sair';
                    include_once __DIR__ . '/../partials/_error.php';
                }
            } else {
                $string = 'Documento não existe';
                $url = '../v_public/index.php';
                $text = 'Sair';
                include_once __DIR__ . '/../partials/_error.php';
            }
        } else {
            $string = 'Necessário autenticação';
            $url = '../v_public/authentication.php';
            $text = 'Login';
            include_once __DIR__ . '/../partials/_error.php';
        }

        include_once __DIR__ . '/../partials/_footer.php';
        ?>
    </body>
</html>
