<?php
$doc_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
require_once __DIR__ . '/../partials/_init.php';
require_once Config::getApplicationManagerPath() . "CategoryManager.php";
require_once Config::getApplicationManagerPath() . "DocumentManager.php";
$docManager = new DocumentManager();
require_once Config::getApplicationControllersPath() . "documentController.php";
$doc = $docManager->getDocumentByID($doc_id);
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include_once __DIR__ . '/../partials/_head.php'; ?>
        <script src="../scripts/visibility.js" type="text/javascript"></script>
        <script src="../scripts/addShared.js" type="text/javascript"></script>
        <title>Editar Documento #<?= empty($doc) ? '#####' : $doc_id ?></title>
    </head>
    <body>
        <?php include_once '../partials/_header.php'; ?>
        <?php
        if (SessionManager::keyExists('authUsername')) {
            if (empty($doc)) {
                ?>
                <h1 id="main-title">Editar Documento ######</h1>
                <?php
                $string = 'Documento não existe';
                $url = '../v_public/index.php';
                $text = 'Sair';

                include_once __DIR__ . '/../partials/_error.php';
            } else {
                $doc = reset($doc);
                if (SessionManager::getSessionValue('authUsername') == $doc->getDocumentUserId()) {
                    if (!$added) {
                        if (count($errors) == 0) {
                            $input['title'] = $doc->getDocumentTITLE();
                            $input['summary'] = $doc->getDocumentSUMMARY();
                            $tags = $docManager->getTagsByDocumentID($doc_id);
                            $input['tags'] = '';
                            foreach ($tags as $value) {
                                $input['tags'] = $input['tags'] . ',' . $value['TagName'];
                            }
                            $input['tags'] = substr($input['tags'], 1);
                            $input['doc'] = $doc->getDocumentCONTENT();
                            $input['title'] = $doc->getDocumentTITLE();
                            $input['title'] = $doc->getDocumentTITLE();
                            $input['category'] = $doc->getDocumentCategoryId();
                            $input['visibility'] = $doc->getDocumentVisibilityId();
                            $input['comment_public'] = $doc->getDocumentCOMMENTS();
                            $shared = $docManager->getSharedUsersByDocumentID($doc_id);
                            $rett = array();
                            foreach ($shared as $value) {
                                $userD = $userMan->getUserByID($value['UserID']);
                                $userD = reset($userD);
                                $rett[] = array(
                                    'userID' => $value['UserID'],
                                    'userEMAIL' => $userD->getUserEMAIL(),
                                    'allowComments' => $value['DocumentUserCOMMENTS']
                                );
                            }
                            $rett = json_encode($rett);
                            $input['sharedUsers'] = urlencode($rett);
                        }
                        ?>
                        <h1 id="main-title">Editar Documento #<?= $doc_id ?></h1>

                        <form id="document" action="<?= htmlspecialchars($_SERVER["PHP_SELF"] . "?id=" . filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)) ?>" method="post" enctype="multipart/form-data">
                            <?php include_once __DIR__ . '/../partials/_document.php'; ?>
                            <label for="file">Documento</label>
                            <p><textarea required name="doc"  class="<?= array_key_exists('doc', $errors) ? INPUT_CLASS_ERROR_NAME : '' ?>"  id="doc" rows="15"><?= $input['doc'] ?></textarea></p>
                            <?php if (array_key_exists('doc', $errors)) { ?><span class="<?= SPAN_CLASS_ERROR_NAME ?>"> &bull; <?= $errors['doc'] ?></span> <?php } ?>
                            <label for="reasons">Razões da edição</label>
                            <p><textarea required name="reasons" class="<?= array_key_exists('reasons', $errors) ? INPUT_CLASS_ERROR_NAME : '' ?>" id="reasons" rows="5"><?= $input['reasons'] ?></textarea></p>
                            <?php if (array_key_exists('reasons', $errors)) { ?><span class="<?= SPAN_CLASS_ERROR_NAME ?>"> &bull; <?= $errors['reasons'] ?></span> <?php } ?>
                            <input type="hidden" name="type" value="edit">
                            <p><input type="submit"  id="submit" value="Guardar" name="submit"></p>
            <?php if (array_key_exists('final', $errors)) { ?><p class="<?= P_CLASS_ERROR_NAME ?>"> <?= $errors['final'] ?></p> <?php } ?>

                        </form>
                        <?php
                    } else {
                        $string = 'Documento guardado com sucesso';
                        $url = "../v_private/view-document.php?id=" . $doc_id;
                        $text = 'Ver Documento';
                        $warning = true;
                        include_once __DIR__ . '/../partials/_error.php';
                    }
                } else {
                    $string = 'Não tem permissões para editar o documento';
                    $url = '../v_public/index.php';
                    $text = 'Sair';
                    include_once __DIR__ . '/../partials/_error.php';
                }
            }
        } else {
            ?>
                <h1 id="main-title">Editar Documento</h1>
                <?php 
            $string = 'Necessário autenticação';
            $url = '../v_public/authentication.php';
            $text = 'Login';
            include_once __DIR__ . '/../partials/_error.php';
        }
        include_once __DIR__ . '/../partials/_footer.php';
        ?>
    </body>
</html>
