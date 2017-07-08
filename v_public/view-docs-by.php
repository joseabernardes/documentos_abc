<?php
require_once __DIR__ . '/../partials/_init.php';
require_once Config::getApplicationManagerPath() . 'UserManager.php';
require_once Config::getApplicationManagerPath() . 'CategoryManager.php';
require_once Config::getApplicationUtilsPath() . 'Permissions.php';
$type = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


if ($type === 'category') {
    $title = 'Categoria';
} else if ($type === 'tag') {
    $title = 'Palavra-Chave';
} else {
    $title = '';
}
$exist = false;
$invalid = true;
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include_once __DIR__ . '/../partials/_head.php'; ?>
        <title>Documentos por <?= $title ?></title> 
    </head>
    <body>
        <?php
        include_once '../partials/_header.php';
        if (!empty($title)) { //cat ou tag
            $invalid = false;
            require_once Config::getApplicationManagerPath() . 'DocumentManager.php';
            $docManager = new DocumentManager();

            if (!empty($id)) {
                $invalid = false;
                $arrayDocs1 = array();
                if ($type === 'tag') {
                    $arrayDocs1 = $docManager->getDocumentByTag($id);
                    ?>
                    <h1 id="main-title">#<?= $id ?></h1>
                    <?php
                } else if ($type === 'category') {

                    $arrayDocs1 = $docManager->getDocumentByCategory($id);
                    $categoryManager = new CategoryManager();
                    
                    $arrayCats = $categoryManager->getCategoryByID($id);
                    $catNameAtual = reset($arrayCats);
                    $name = ($catNameAtual) ? $catNameAtual->getCategoryNAME() : '#####';
                    ?>
                    <h1 id="main-title">Categoria - <?= $name ?></h1>
                    <?php
                }
                $tempArrayDocs = array();
                if (!empty($arrayDocs1)) {
                    $exist = true;
                    $userID = (SessionManager::keyExists('authUsername')) ? SessionManager::getSessionValue('authUsername') : null;
                    foreach ($arrayDocs1 as $value) {
                        if (Permissions::checkViewPermitions($value, $userID)) {
                            $tempArrayDocs[] = $value;
                        }
                    }
                    if (!empty($tempArrayDocs)) {
                        $userManager = new UserManager();
                        ?>   
                        <ul id="searchResults">
                            <?php
                            foreach ($tempArrayDocs as $value) {
                                $userDocAtual = $userManager->getUserByID($value->getDocumentUserId());
                                ?>
                                <li>
                                    <a href="view-document.php?id=<?= $value->getDocumentID() ?>">
                                        <h3><?= $value->getDocumentTITLE() ?></h3>
                                    </a>
                                    por 
                                    <a class="user" href="../v_private/profile-page.php?id=<?= $value->getDocumentUserId() ?>"><?= $userDocAtual->getUserNAME() ?></a>
                                    <span class="date"><?= $value->getDocumentDATE() ?></span>
                                    <h4>Resumo:</h4>
                                    <span class="sum"><?= $value->getDocumentSUMMARY() ?></span>
                                    <h4 class="tagsTitle">Tags:</h4>
                                    <?php
                                    $tagsDump = $docManager->getTagsByDocumentID($value->getDocumentID());
                                    foreach ($tagsDump as $value) {
                                        ?>
                                        <a href="view-docs-by.php?type=tag&id=<?= $value['TagName'] ?>"><?= $value['TagName'] ?></a>
                                    <?php } ?>
                                </li>
                            <?php } ?>
                        </ul>
                        <?php
                    }else{
                         $exist = false;
                    }
                }
                if (!$exist) {
                    $string = 'Nenhum documento encontrado';
                    $url = "index.php";
                    $text = 'Sair';
                    include_once __DIR__ . '/../partials/_error.php';
                }
            }
        }
        if ($invalid) {
            ?>
            <h1 id="main-title">Documentos</h1>   
            <?php
            $string = 'Parametro Inválido';
            $url = "index.php";
            $text = 'Sair';
            include_once __DIR__ . '/../partials/_error.php';
        }
        ?>
        <?php include_once '../partials/_footer.php'; ?>
    </body>
</html>
