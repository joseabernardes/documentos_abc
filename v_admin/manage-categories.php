<?php
require_once __DIR__ . '/../partials/_init.php';
require_once Config::getApplicationManagerPath() . 'CategoryManager.php';
$pageTitle = 'Gerir Categorias';
?>
<!DOCTYPE html>
<html>
    <head>

        <?php include_once '../partials/_head.php'; ?>
        <script src="../scripts/categories.js" type="text/javascript"></script>
        <title><?= $pageTitle ?></title>
    </head>
    <body>
        <?php include_once '../partials/_header.php'; ?> 
        <h1 id="main-title"><?= $pageTitle ?></h1>
        <?php
        if (SessionManager::keyExists('authUsername')) {
            $userManager = new UserManager();
            try {
                $user = $userManager->getUserByID(SessionManager::getSessionValue('authUsername'));
                if ($user->getUserAUTHLEVEL() === 'ADMIN') {
                    ?>
                    <div id="search">
                        <input type="text" id="inputS"/>
                        <input type="button" id="addButton" value="+">
                    </div>
                    <ul id="manageCat">
                        <?php
                        $categoryManager = new CategoryManager();
                        $catArray = $categoryManager->getAllCategories();

                        foreach ($catArray as $value) {
                            ?>
                            <li class="cate"><input class="delete" type="button" value="x" id="<?= $value->getCategoryID() ?>"/><?= $value->getCategoryNAME() ?></li>
                            <?php } ?>
                    </ul>       
                    <?php
                } else {
                    $string = 'Necessário permissões de Administrador';
                    $url = '../v_public/index.php';
                    $text = 'Sair';
                    include_once __DIR__ . '/../partials/_error.php';
                }
            } catch (UserException $ex) {
                $string = 'Falha ao identificar utilizador';
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
        ?>
        <?php include_once '../partials/_footer.php'; ?>
    </body>
</html>
