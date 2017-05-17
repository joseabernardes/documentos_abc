<?php
$doc_id = '';
$title = '';
$summary = '';
$category = 'AI';
$visibility = 'publico';
$tags = '';
$document = '';
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include_once __DIR__ . '/../partials/_head.php'; ?>
        <script src="../lib/jquery-3.2.1.js" type="text/javascript"></script>
        <script src="../scripts/details.js" type="text/javascript"></script>
        <title>Editar Documento #<?= $doc_id ?></title>
    </head>
    <body>
        <?php include_once '../partials/_header.php'; ?>
        <h1 id="main-title">Editar Documento #<?= $doc_id ?></h1>
        <form id="document" action="import-document.php" method="post" enctype="multipart/form-data">
            <?php include_once __DIR__ . '/../partials/_document.php'; ?>
            <label for="reasons">Razões da edição</label>
            <p><textarea name="reasons" required id="reasons" rows="5"></textarea></p>

            <p><input type="submit" value="Guardar" name="submit"></p>
        </form>
        <?php include_once __DIR__ . '/../partials/_footer.php'; ?>
    </body>
</html>