<!DOCTYPE html>
<html>
    <head>
        <?php include_once '../partials/_head.php'; ?>
        <title>Criar Documentos</title>
    </head>
    <body>
        <?php include_once '../partials/_header.php'; ?>
        <h1 id="main-title">Criar Documento</h1>

        <form id="import">
            <?php include_once '../partials/_document.php'; ?>
            <label for="doc">Documento</label><textarea name="doc" required id="doc" rows="5"></textarea>
        </form>

        <?php include_once '../partials/_footer.php'; ?>
    </body>
</html>
