<?php
require_once __DIR__ . '/../partials/_init.php';
require_once Config::getApplicationManagerPath() . "DocumentManager.php";
require_once Config::getApplicationManagerPath() . "CategoryManager.php";
require_once Config::getApplicationManagerPath() . "HistoricManager.php";
require_once Config::getApplicationManagerPath() . "UserManager.php";
require_once Config::getApplicationManagerPath() . "CommentManager.php";

$doc_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$docManager = new DocumentManager();
$userMan = new UserManager();
$doc = $docManager->getDocumentByID($doc_id);
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include_once '../partials/_head.php'; ?>
        <script src="../scripts/details.js" type="text/javascript"></script>
        <script src="../scripts/addComment.js" type="text/javascript"></script>
        <title><?= empty($doc) ? 'Documento não existe' : reset($doc)->getDocumentTITLE() ?></title>
    </head>
    <body>
        <?php include_once '../partials/_header.php'; ?>
        <h1 id="main-title"><?= empty($doc) ? '#####' : reset($doc)->getDocumentTITLE() ?></h1>
        <?php
        if (empty($doc)) {
            $string = 'Documento não existe';
            $url = '../v_public/index.php';
            $text = 'Sair';
            include_once __DIR__ . '/../partials/_error.php';
        } else {
            $doc = reset($doc);
            $permitions = false;
            if ($doc->getDocumentVisibilityId() == 1) {
                $permitions = true;
            } else {
                if (SessionManager::keyExists('authUsername')) {
                    $userid = SessionManager::getSessionValue('authUsername');
                    if ($doc->getDocumentVisibilityId() == 2 && $userid == $doc->getDocumentUserId()) {
                        $permitions = true;
                    } else if ($doc->getDocumentVisibilityId() == 3) {
                        $shared = $docManager->getSharedUsersByUser_DocumentID($userid, $doc_id);
                        if (!empty($shared) || $userid == $doc->getDocumentUserId()) {
                            $permitions = true;
                        } else {
                            $string = 'Não tem permissões para ver o documento';
                            $url = '../v_public/index.php';
                            $text = 'Sair';
                        }
                    } else {
                        $string = 'Não tem permissões para ver o documento';
                        $url = '../v_public/index.php';
                        $text = 'Sair';
                    }
                } else {
                    $string = 'Este documento não é publico';
                    $url = '../v_public/authentication.php';
                    $text = 'Login';
                }
            }

            if ($permitions) {
                $catMan = new CategoryManager();
                $cat = $catMan->getCategoryByID($doc->getDocumentCategoryId());
                $cat = reset($cat);
                $tagsDump = $docManager->getTagsByDocumentID($doc_id);
                ?>



                <main id="view-doc">
                    <div class="top">
                        <div id="details" class="expand noselect"><span>Detalhes</span><span>+</span></div>
                        <div class="content">
                            <h3>Data de Criação</h3>
                            <span><?= $doc->getDocumentDATE() ?></span>
                            <h3>Categoria</h3>
                            <span><?= $cat->getCategoryNAME() ?></span> 
                            <h3>Palavras-Chave</h3>

                            <?php
                            foreach ($tagsDump as $value) {
                                ?>
                                <a href="../v_public/view-docs.php?type=tag&id=<?= $value['TagName'] ?>"><?= $value['TagName'] ?></a>
                                <?php
                            }
                            ?>

                            <h3>Resumo</h3>
                            <span><?= $doc->getDocumentSUMMARY() ?></span>
                            <h3>Autor</h3>

                            <?php
                            $user = $userMan->getUserByID($doc->getDocumentUserId());
                            $user = reset($user);
                            ?>
                            <a href="profile-page.php?id=<?= $user->getUserID() ?>"><?= $user->getUserNAME() ?></a>
                            <?php if ($doc->getDocumentPATH()) { ?>
                                <h3>Ficheiro Original</h3>
                                <a href="<?= '..' . $doc->getDocumentPATH() ?>">Download</a> 
                            <?php } ?>

                        </div>
                    </div>
                    <div class="top">
                        <div id="details" class="expand noselect"><span>Historico</span><span>+</span></div>
                        <div class="content">

                            <?php
                            $hist = new HistoricManager();
                            $histDump = $hist->getHistoricByDocumentID($doc_id);
                            if (!empty($histDump)) {

                                foreach ($histDump as $value) {
                                    ?>
                                    <h3>Data da Edição</h3>
                                    <span><?= $value->getEditingDATE() ?></span>
                                    <h3>Razões</h3>
                                    <span><?= $value->getEditingReason() ?></span> 
                                    <hr>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <p id="doc">
                        <?= $doc->getDocumentCONTENT() ?>
                    </p>
                    <?php
                    $commentManager = new CommentManager();
                    $comments = $commentManager->getCommentsByDocumentID($doc_id);
                    ?>


                    <div id="commentsBox">
                        <h2><?= count($comments) ?> Comentário(s)</h2>
                        <ol>
                            <?php
                            foreach ($comments as $value) {
                                if ($value->getCommentUserID() == null) {
                                    $link = 'mailto:' . $value->getCommentEMAIL();
                                } else {
                                    $link = 'profile-page.php?id=' . $value->getCommentUserID();
                                }
                                ?>
                                <li class="comment">
                                    <a href="<?= $link ?>"><h3><?= $value->getCommentNAME() ?></h3></a><span>◷ <?= $value->getCommentDATE() ?></span>
                                    <p><?= $value->getCommentCONTENT() ?></p>
                                </li>
                                <?php
                            }
                            ?>
                        </ol>
                        <?php
                        $visibility = $doc->getDocumentVisibilityId();
                        $bool = true;
                        if ($visibility == 2 || ($visibility == 1 && !$doc->getDocumentCOMMENTS())) { //não pode comentar
                            $bool = false;
                        } else if ($visibility == 3) {
                            $userid = SessionManager::getSessionValue('authUsername');
                            $shared = $docManager->getSharedUsersByUser_DocumentID($userid, $doc_id);

                            $shared = reset($shared);
                            if ($shared && !$shared['DocumentUserCOMMENTS']) {
                                $bool = false;
                            }
                            if ($userid == $doc->getDocumentUserId()) { //ownet
                                $bool = true;
                            }
                        }
                        if ($bool) {
                            ?>
                            <div id="newComment">
                                <label for="commentArea">Comentário:</label>
                                <p><textarea title="Introduza o seu comentário" id="commentArea" rows="5"></textarea></p>
                                <div id="inputcontainer">
                                    <?php
                                    if (SessionManager::keyExists('authUsername')) {

                                        $user = $userMan->getUserByID(SessionManager::getSessionValue('authUsername'));
                                        $user = reset($user);
                                        ?> 
                                        <p>Enviar como: <?= $user->getUserNAME() ?></p>
                                        <?php
                                    } else {
                                        ?>
                                        <p id="leftInput"><label for="name">Nome: *</label>
                                            <input required id="name" type="text"></p>
                                        <p id="rightInput"><label for="email">Email: *</label>
                                            <input required id="email" type="email"></p>
                                    <?php } ?>
                                </div>
                                <p><input type="button" id="send" value="Publicar"></p>
                                <input type="hidden" id="docid" value="<?= $doc_id ?>">
                            </div>

                        <?php } else { ?>

                            <p id="noComments">Não pode fazer comentários</p>
                            <?php
                        }
                        ?>
                    </div>
                </main>
                <?php
            } else {
                include_once __DIR__ . '/../partials/_error.php';
            }
        }
        include_once '../partials/_footer.php';
        ?>
    </body>
</html>
