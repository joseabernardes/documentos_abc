<?php
require_once __DIR__ . '/../partials/_init.php';
require_once Config::getApplicationManagerPath() . "CategoryManager.php";
require_once Config::getApplicationManagerPath() . "DocumentManager.php";
require_once Config::getApplicationModelPath() . "DocumentModel.php";
$docManager = new DocumentManager();
require_once Config::getApplicationControllersPath() . "documentController.php";


$type = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_SPECIAL_CHARS);
$name;
if ($type === 'import') {
    $name = 'Importar';
} else if (($type === 'create')) {
    $name = 'Criar';
} else {
    header("Location: ../v_public/index.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include_once '../partials/_head.php'; ?>
        <script src="../scripts/visibility.js" type="text/javascript"></script>
        <script src="../scripts/shareDocument.js" type="text/javascript"></script>
        <title><?= $name ?> Documentos</title>
    </head>
    <body>
        <?php include_once '../partials/_header.php'; ?>
        <h1 id="main-title"><?= $name ?> Documentos</h1> 
        <?php
        if (SessionManager::keyExists('authUsername')) {
            if ($added) {
                $string = 'Documento guardado com sucesso';
                $url = "../v_public/view-document.php?id=" . $documentid;
                $text = 'Ver Documento';
                $warning = true;
                include_once __DIR__ . '/../partials/_error.php';
            } else {
                ?>
                <form id="document" action="<?= htmlspecialchars($_SERVER["PHP_SELF"] . "?type=" . filter_input(INPUT_GET, 'type', FILTER_SANITIZE_FULL_SPECIAL_CHARS)) ?>" method="POST" enctype="multipart/form-data">
                    <?php include_once __DIR__ . '/../partials/_document.php'; ?>
                    <label for="file">Documento</label>
                    <?php
                    if ($type === 'import') {
                        ?>
                        <p><input required class="<?= array_key_exists('file', $errors) ? INPUT_CLASS_ERROR_NAME : '' ?>" id="file" accept="application/vnd.openxmlformats-officedocument.wordprocessingml.document" type="file" name="file"/></p><!-- accept="application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document"  -->
                        <?php if (array_key_exists('file', $errors)) { ?><span class="<?= SPAN_CLASS_ERROR_NAME ?>"> &bull; <?= $errors['file'] ?></span> <?php } ?>
                    <?php } elseif ($type === 'create') {
                        ?>
                        <p><textarea required name="doc" class="<?= array_key_exists('doc', $errors) ? INPUT_CLASS_ERROR_NAME : '' ?>" id="doc" rows="15"><?= $input['doc'] ?></textarea></p>
                        <?php if (array_key_exists('doc', $errors)) { ?><span class="<?= SPAN_CLASS_ERROR_NAME ?>"> &bull; <?= $errors['doc'] ?></span> <?php
                        }
                    }
                    ?>
                    <input type="hidden" name="type" value="<?= $type ?> ">
                    <p><input type="submit" id="submit" value="<?= $name ?> " name="submit"></p>
                    <?php if (array_key_exists('final', $errors)) { ?><p class="<?= P_CLASS_ERROR_NAME ?>"> <?= $errors['final'] ?></p> <?php } ?>

                </form>





                <?php
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
