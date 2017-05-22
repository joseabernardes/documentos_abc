<?php
$type = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_SPECIAL_CHARS);

$doc_id = '';
$title = '';
$summary = '';
$category = 'AI';
$visibility = 'privado';
$tags = '';
$document = '';


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
        <script src="../lib/jquery-3.2.1.js" type="text/javascript"></script>
        <script src="../scripts/visibility.js" type="text/javascript"></script>
        <script src="../scripts/addShared.js" type="text/javascript"></script>
        <title><?= $name ?> Documentos</title>
    </head>
    <body>
        <?php include_once '../partials/_header.php'; ?>
        <h1 id="main-title"><?= $name ?> Documentos</h1>
        <form id="document" action="import-document.php" method="post" enctype="multipart/form-data">
            <?php include_once __DIR__ . '/../partials/_document.php'; ?>
            <label for="file">Documento</label>
            <?php
            if ($type === 'import') {
                ?>
                <p><input required id="file" accept="application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document" type="file" name="file"/></p>

            <?php } elseif ($type === 'create') {
                ?>
                <p><textarea name="doc" required id="doc" rows="15"></textarea></p>
                <?php }
                ?>
            <p><input type="submit" value="<?= $name ?> " name="submit"></p>
        </form>

        <?php include_once '../partials/_footer.php'; ?>
    </body>
</html>
