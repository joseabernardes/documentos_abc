<!DOCTYPE html>
<html>
    <head>
        <?php include_once '../partials/_head.php'; ?>
        <title>Importar Documentos</title>
    </head>
    <body>
        <?php include_once '../partials/_header.php'; ?>
        <h1 id="main-title">Importar Documento</h1>

        <form id="import" action="import-document.php" method="post" enctype="multipart/form-data">
           <?php include_once '../partials/_document.php'; ?>
        <label for="file">Documento</label><input required id="file" type="file" name="file"/>
        <input type="submit" value="Importar" name="submit">
    </form>

    <?php include_once '../partials/_footer.php'; ?>
</body>
</html>
