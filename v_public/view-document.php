<?php
require_once __DIR__ . '/../partials/_init.php';
require_once Config::getApplicationManagerPath() . "DocumentManager.php";
require_once Config::getApplicationManagerPath() . "CategoryManager.php";
require_once Config::getApplicationManagerPath() . "HistoricManager.php";
require_once Config::getApplicationManagerPath() . "UserManager.php";
require_once Config::getApplicationManagerPath() . "CommentManager.php";
require_once Config::getApplicationUtilsPath() . 'Permissions.php';

$doc_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$docManager = new DocumentManager();
$userManager = new UserManager();


try {
    $doc = $docManager->getDocumentByID($doc_id);
} catch (DocumentException $ex) {
    $doc = false;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include_once '../partials/_head.php'; ?>
        <script src="../scripts/details.js" type="text/javascript"></script>
        <script src="../scripts/comments.js" type="text/javascript"></script>
        <script src="../scripts/sideNotes.js" type="text/javascript"></script>
        <title><?= (!$doc) ? 'Documento não existe' : $doc->getDocumentTITLE() ?></title>
    </head>
    <body id="<?= $doc_id ?> ">
        <?php include_once '../partials/_header.php'; ?>
        <h1 id="main-title"><?= (!$doc) ? '######' : $doc->getDocumentTITLE() ?></h1>
        <?php
        if (!$doc) {
            $string = 'Documento não existe';
            $url = '../v_public/index.php';
            $text = 'Sair';
            include_once __DIR__ . '/../partials/_error.php';
        } else {
            $userID = (SessionManager::keyExists('authUsername')) ? SessionManager::getSessionValue('authUsername') : null;
            if (Permissions::checkViewPermitions($doc, $userID)) {
                $categoryManager = new CategoryManager();
                $cat = $categoryManager->getCategoryByID($doc->getDocumentCategoryId());
                $cat = reset($cat);
                $tagsDump = $docManager->getTagsByDocumentID($doc_id);
                ?>
        <input id="show" type="button" value="Observações"/>
                <div id="notes">
                  
                    <input id="add" type="button" value="+"/>
                    
                </div>
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
                                <a href="../v_public/view-docs-by.php?type=tag&id=<?= $value['TagName'] ?>"><?= $value['TagName'] ?></a>
                                <?php
                            }
                            ?>

                            <h3>Resumo</h3>
                            <span><?= $doc->getDocumentSUMMARY() ?></span>
                            <h3>Autor</h3>

                            <?php
                            $user = $userManager->getUserByID($doc->getDocumentUserId());
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
                            foreach ($histDump as $value) {
                                ?>
                                <h3>Data da Edição</h3>
                                <span><?= $value->getEditingDATE() ?></span>
                                <h3>Razões</h3>
                                <span><?= $value->getEditingReason() ?></span> 
                                <hr>
                                <?php
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
                        <h2><span><?= count($comments) ?></span> Comentário(s)</h2>
                        <ol>
                            <?php
                            foreach ($comments as $value) {
                                if ($value->getCommentUserID() == null) { //comentário feito sem login
                                    $link = 'mailto:' . $value->getCommentEMAIL();
                                } else {
                                    $link = '../v_private/profile-page.php?id=' . $value->getCommentUserID();
                                }
                                ?>
                                <li class="comment" id="c-<?= $value->getCommentID() ?>"> 
                                    <a href="<?= $link ?>"><h3><?= $value->getCommentNAME() ?></h3></a><a class="time" href="#c-<?= $value->getCommentID() ?>">◷ <?= $value->getCommentDATE() ?></a>
                                    <p><?= $value->getCommentCONTENT() ?></p>
                                </li>
                                <?php
                            }
                            ?>
                        </ol>
                        <?php
                        if (Permissions::checkCommentPermitions($doc, $userID)) {
                            ?>
                            <div id="newComment">
                                <label for="commentArea">Comentário:</label>
                                <p><textarea title="Introduza o seu comentário" id="commentArea" rows="5"></textarea></p>
                                <div id="inputcontainer">
                                    <?php
                                    if (SessionManager::keyExists('authUsername')) {

                                        $user = $userManager->getUserByID(SessionManager::getSessionValue('authUsername'));
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
                $string = 'Não tem permissões para ver o documento';
                $url = '../v_public/index.php';
                $text = 'Sair';
                include_once __DIR__ . '/../partials/_error.php';
            }
        }
        include_once '../partials/_footer.php';
        ?>
    </body>
</html>
