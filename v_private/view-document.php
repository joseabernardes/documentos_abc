<?php
require_once __DIR__ . '/../partials/_init.php';
require_once Config::getApplicationManagerPath() . "DocumentManager.php";
require_once Config::getApplicationManagerPath() . "CategoryManager.php";
require_once Config::getApplicationManagerPath() . "HistoricManager.php";

$doc_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$docManager = new DocumentManager();
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
                        $shared = $docManager->getSharedUsersByDocumentID($doc_id);
                        $found = false;
                        foreach ($shared as $value) {
                            if ($userid == $value['UserID']) {
                                $found = true;
                                break;
                            }
                        }
                        if ($found || $userid == $doc->getDocumentUserId()) {
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
//                $doc = new DocumentModel();
                $catMan = new CategoryManager();
                $cat = $catMan->getCategoryByID($doc->getDocumentCategoryId());
                $cat = reset($cat);
                $tagsDump = $docManager->getTagsByDocumentID($doc_id);
                $tags = '';
                foreach ($tagsDump as $value) {
                    $tags = $tags . ', ' . $value['TagName'];
                }
                $tags = substr($tags, 1);
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
                            <span><?= $tags ?> </span>
                            <h3>Resumo</h3>
                            <span><?= $doc->getDocumentSUMMARY() ?></span>
                            <?php if ($doc->getDocumentPATH()) { ?>
                                <h3>Ficheiro Original</h3>
                                <span><a href="<?= '..' . $doc->getDocumentPATH() ?>">Download</a></span> 
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

                    <div id="commentsBox">
                        <h2>3 Comentário(s)</h2>
                        <ol>
                            <li class="comment">
                                <h3>José Bernardes</h3><span>◷ 2017-06-14 10:39:19</span>
                                <p>Este documento é muito bonito, adorei!</p>
                            </li>
                            <li class="comment">
                                <h3>José Bernardes</h3><span>◷ 2017-06-14 10:39:19</span>
                                <p>Este documento é muito bonito, adorei!</p>
                            </li>
                            <li class="comment">
                                <h3>José Bernardes</h3><span>◷ 2017-06-14 10:39:19</span>
                                <p>Este documento é muito bonito, adorei!</p>
                            </li>
                        </ol>

                        <div id="newComment">
                            <label for="commentArea">Comentário:</label>
                            <p><textarea title="Introduza o seu comentário" id="commentArea" rows="5"></textarea></p>
                            <div id="inputcontainer">
                                <p id="leftInput"><label for="name">Nome: *</label>
                                    <input required id="name" type="text"></p>
                                <p id="rightInput"><label for="email">Email: *</label>
                                    <input required id="email" type="email"></p>
                            </div>
                            <p><input type="button" id="send" value="Publicar"></p>
                        </div>
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
