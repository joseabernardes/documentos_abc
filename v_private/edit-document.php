<!DOCTYPE html>
<html>
    <head>
        <?php include_once '../partials/_head.php'; ?>
        <script src="../lib/jquery-3.2.1.js" type="text/javascript"></script>
        <script src="../scripts/details.js" type="text/javascript"></script>
        <title>Editar Documento</title>
    </head>
    <body>
        <?php include_once '../partials/_header.php'; ?>
        <h1 id="main-title">Editar Documento</h1>
        <form id="document" action="import-document.php" method="post" enctype="multipart/form-data">
            <label for="title">Titulo</label>
            <p><input required id="title" type="text" name="title" maxlength="50" value="<?= "Eu vi um sapo" ?>"/></p>
            <label for="summary">Resumo</label>
            <p><textarea name="summary" required id="summary" rows="5"/><?= "Este documento é belissssimo" ?></textarea></p>


            <label for="category">Categoria</label>
            <p><select id="category" name="category">
                    <?php $ana = 'CD' ?>
                    <option value="AI" <?php echo ($ana === 'AI' ? 'selected' : '' ) ?>>Album Information</option>
                    <option value="MR" <?php echo ($ana === 'MR' ? 'selected' : '' ) ?>>Music Record</option>
                    <option value="CD" <?php echo ($ana === 'CD' ? 'selected' : '' ) ?>>Concert's date</option>
                </select></p> 
            <label>Visibilidade</label>
            <p>
                <?php $an = 'partilhado' ?>
                <input <?php echo ($an === 'publico' ? 'checked' : '' ) ?> id="publico" type="radio" name="visibility" value="publico"><label class="visibility" for="publico">Público</label>
                <input <?php echo ($an === 'partilhado' ? 'checked' : '' ) ?> id="partilhado" type="radio"  name="visibility" value="partilhado"><label class="visibility" for="partilhado">Partilhado</label>                
                <input <?php echo ($an === 'privado' ? 'checked' : '' ) ?> id="privado" type="radio" name="visibility"  value="privado"><label class="visibility"  for="privado">Privado</label></p>
            <label for="tags">Palavras-chave</label>
            <p><textarea name="tags" required id="tags" rows="5" placeholder="separadas,por,virgulas"><?= "as, minhas, palavras, chave" ?></textarea></p>
            <label for="file">Documento</label>
            <p><textarea name="doc" required id="doc" rows="15"><?= "este é o meu documento, e é LIIINDO :)" ?> </textarea></p>
            <label for="reasons">Razões da edição</label>
            <p><textarea name="reasons" required id="tags" rows="5"></textarea></p>

            <p><input type="submit" value="Guardar" name="submit"></p>
        </form>
        <?php include_once '../partials/_footer.php'; ?>
    </body>
</html>
