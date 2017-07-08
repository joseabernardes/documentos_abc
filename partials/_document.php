<label for="title">Titulo</label>
<p><input class="<?= array_key_exists('title', $errors) ? INPUT_CLASS_ERROR_NAME : '' ?>" required title="Maximo 90 caracteres" id="title" type="text" name="title" maxlength="100" value="<?= $input['title'] ?>"/></p>
<?php if (array_key_exists('title', $errors)) { ?><span class="<?= SPAN_CLASS_ERROR_NAME ?>"> &bull; <?= $errors['title'] ?></span> <?php } ?>
<label for="summary">Resumo</label>
<p><textarea  title="Maximo 200 carateres" name="summary" required class="<?= array_key_exists('summary', $errors) ? INPUT_CLASS_ERROR_NAME : '' ?>" maxlength="200" id="summary" rows="5"/><?= $input['summary'] ?></textarea></p>
<?php if (array_key_exists('summary', $errors)) { ?><span class="<?= SPAN_CLASS_ERROR_NAME ?>"> &bull; <?= $errors['summary'] ?></span> <?php } ?>
<label for="category">Categoria</label>
<p><select id="category" class="<?= array_key_exists('category', $errors) ? INPUT_CLASS_ERROR_NAME : '' ?>" name="category">
        <?php
        $categoryManager = new CategoryManager();
        $catDump = $categoryManager->getAllCategories();

        foreach ($catDump as $value) {
            ?>
            <option value="<?= $value->getCategoryID() ?>" <?php echo ($input['category'] == $value->getCategoryID() ? 'selected' : '' ) ?>><?= $value->getCategoryNAME() ?></option>
        <?php } ?>
    </select></p> 
<?php if (array_key_exists('category', $errors)) { ?><span class="<?= SPAN_CLASS_ERROR_NAME ?>"> &bull; <?= $errors['category'] ?></span> <?php } ?>
<label class="<?= array_key_exists('visibility', $errors) ? INPUT_CLASS_ERROR_NAME : '' ?>">Visibilidade</label>
<p>
    <input <?= ($input['visibility'] == 1 ? 'checked' : '' ) ?> id="publico" type="radio" name="visibility" value="1"><label class="visibility noselect <?= array_key_exists('comment_public', $errors) ? INPUT_CLASS_ERROR_NAME : '' ?>" for="publico">Público</label>
    <input <?= ($input['visibility'] == 3 ? 'checked' : '' ) ?> id="partilhado" type="radio" name="visibility" value="3"><label class="visibility noselect <?= array_key_exists('sharedUsers', $errors) ? INPUT_CLASS_ERROR_NAME : '' ?>" for="partilhado">Partilhado</label>                
    <input <?= ($input['visibility'] == 2 ? 'checked' : '' ) ?> id="privado" type="radio" name="visibility"  value="2"><label class="visibility noselect"  for="privado">Privado</label>
</p>
<div id="sharedBox">
    <div id="searchBar">
        <input type="text" id="addUser" placeholder="Escolher utilizadores por email"/>
        <input type="button" id="addButton" value="+">
        <ul>
        </ul>
    </div>
    <?php if (array_key_exists('sharedUsers', $errors)) { ?><span class="<?= SPAN_CLASS_ERROR_NAME ?>"> &bull; <?= $errors['sharedUsers'] ?></span> <?php } ?>

    <!--List of users-->
</div>
<div id="publicBox">
    <p><input <?php echo ($input['comment_public'] == 1 ? 'checked' : '' ) ?> class="commentBox <?= array_key_exists('comment_public', $errors) ? INPUT_CLASS_ERROR_NAME : '' ?>" id="comment_public" name="comment_public" type="checkbox"><label class="commentLabel" for="comment_public">Comentar</label>
    </p>
    <?php if (array_key_exists('comment_public', $errors)) { ?><span class="<?= SPAN_CLASS_ERROR_NAME ?>"> &bull; <?= $errors['comment_public'] ?></span> <?php } ?>
</div>
<?php if (array_key_exists('visibility', $errors)) { ?><span class="<?= SPAN_CLASS_ERROR_NAME ?>"> &bull; <?= $errors['visibility'] ?></span> <?php } ?>
<label for="tags">Palavras-chave</label>
<p><textarea title="Separadas por virgulas" name="tags" class="<?= array_key_exists('tags', $errors) ? INPUT_CLASS_ERROR_NAME : '' ?>" id="tags" rows="5" placeholder="separadas,por,virgulas"><?= $input['tags'] ?></textarea></p>
<?php if (array_key_exists('tags', $errors)) { ?><span class="<?= SPAN_CLASS_ERROR_NAME ?>"> &bull; <?= $errors['tags'] ?></span> <?php } ?>
<input type="hidden" id="sharedUsers" value="<?= $input['sharedUsers'] ?>" name="sharedUsers">