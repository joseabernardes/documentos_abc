<?php
require_once __DIR__ . '/../partials/_init.php';
require_once Config::getApplicationManagerPath() . "CategoryManager.php";
require_once Config::getApplicationControllersPath() . "documentController.php";
$doc_id = '';
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include_once __DIR__ . '/../partials/_head.php'; ?>
        <script src="../scripts/visibility.js" type="text/javascript"></script>
        <script src="../scripts/addShared.js" type="text/javascript"></script>
        <title>Editar Documento #<?= $doc_id ?></title>
    </head>
    <body>
        <?php include_once '../partials/_header.php'; ?>
        <h1 id="main-title">Editar Documento #<?= $doc_id ?></h1>
        <form id="document" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" enctype="multipart/form-data">
            <?php include_once __DIR__ . '/../partials/_document.php'; ?>
            <label for="file">Documento</label>
            <p><textarea name="doc"  class="<?= array_key_exists('doc', $errors) ? INPUT_CLASS_ERROR_NAME : '' ?>"  id="doc" rows="15"><?= $input['doc'] ?></textarea></p>
            <?php if (array_key_exists('doc', $errors)) { ?><span class="<?= SPAN_CLASS_ERROR_NAME ?>"> &bull; <?= $errors['doc'] ?></span> <?php } ?>
            <label for="reasons">Razões da edição</label>
            <p><textarea name="reasons" class="<?= array_key_exists('reasons', $errors) ? INPUT_CLASS_ERROR_NAME : '' ?>" id="reasons" rows="5"><?=$input['reasons'] ?></textarea></p>
            <?php if (array_key_exists('reasons', $errors)) { ?><span class="<?= SPAN_CLASS_ERROR_NAME ?>"> &bull; <?= $errors['reasons'] ?></span> <?php } ?>
            <p><input type="submit" value="Guardar" name="submit"></p>
            <input type="hidden" name="sharedUsers">
            <input type="hidden" name="type" value="edit">
        </form>
        <?php include_once __DIR__ . '/../partials/_footer.php'; ?>
    </body>
</html>
