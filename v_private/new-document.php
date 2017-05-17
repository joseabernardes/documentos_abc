<?php
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
        <title><?= $name ?> Documentos</title>
    </head>
    <body>
        <?php include_once '../partials/_header.php'; ?>
        <h1 id="main-title"><?= $name ?> Documentos</h1>
        <form id="document" action="import-document.php" method="post" enctype="multipart/form-data">
            <label for="title">Titulo</label>
            <p><input required id="title" type="text" name="title" maxlength="50"/></p>
            <label for="summary">Resumo</label>
            <p><textarea name="summary" required id="summary" rows="5"/></textarea></p>


            <label for="category">Categoria</label>
            <p><select id="category" name="category">
                    <option value="AI">Album Information</option>
                    <option value="MR" selected>Music Record</option>
                    <option value="CD">Concert's date</option>
                </select></p> 
            <label>Visibilidade</label>
            <p>
                <input checked id="publico" type="radio" name="visibility" value="publico"><label class="visibility" for="publico">Público</label>
                <input id="partilhado" type="radio"  name="visibility" value="partilhado"><label class="visibility" for="partilhado">Partilhado</label>                
                <input id="privado" type="radio" name="visibility"  value="privado"><label class="visibility"  for="privado">Privado</label></p>
            <label for="tags">Palavras-chave</label>
            <p><textarea name="tags" required id="tags" rows="5" placeholder="separadas,por,virgulas"></textarea></p>

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
