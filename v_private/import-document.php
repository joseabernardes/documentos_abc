<!DOCTYPE html>
<html>
    <head>
        <?php include_once '../partials/_head.php'; ?>
        <title>Importar Documentos</title>
    </head>
    <body>
        <?php include_once '../partials/_header.php'; ?>
        <h1 id="main-title">Importar Documento</h1>

        <form id="import">
           <?php include_once '../partials/_document.php'; ?>
        <label for="doc">Documento</label><input required id="doc" type="text" name="title" maxlength="50"/>
    </form>

    <?php include_once '../partials/_footer.php'; ?>
</body>
</html>
