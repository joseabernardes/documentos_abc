<label for="title">Titulo</label>
<p><input required id="title" type="text" name="title" maxlength="50" value="<?= $input['title'] ?>"/></p>
<label for="summary">Resumo</label>
<p><textarea name="summary" required id="summary" rows="5"/><?= $input['summary'] ?></textarea></p>
<label for="category">Categoria</label>
<p><select id="category" name="category">

        <option value="AI" <?php echo ($input['category'] === 'AI' ? 'selected' : '' ) ?>>Album Information</option>
        <option value="MR" <?php echo ($input['category'] === 'MR' ? 'selected' : '' ) ?>>Music Record</option>
        <option value="CD" <?php echo ($input['category'] === 'CD' ? 'selected' : '' ) ?>>Concert's date</option>
    </select></p> 
<label>Visibilidade</label>
<p>
    <input <?php echo ($input['visibility'] === 'publico' ? 'checked' : '' ) ?> id="publico" type="radio" name="visibility" value="publico"><label class="visibility noselect" for="publico">Público</label>
    <input <?php echo ($input['visibility'] === 'partilhado' ? 'checked' : '' ) ?> id="partilhado" type="radio" name="visibility" value="partilhado"><label class="visibility noselect" for="partilhado">Partilhado</label>                
    <input <?php echo ($input['visibility'] === 'privado' ? 'checked' : '' ) ?> id="privado" type="radio" name="visibility"  value="privado"><label class="visibility noselect"  for="privado">Privado</label>
</p>



<div id="sharedBox">
    <p><input type="text" id="addUser" placeholder="Escolher utilizadores"/>
        <input type="button" id="addButton" value="+">
    </p>
    <p id="1" class="results"><input type="button" class="removeButton" value="x"><span>José Bernardes</span><input checked class="commentBox" type="checkbox" id="comment_1"><label class="commentLabel" for="comment_1">Comentar</label></p>
    <p id="2" class="results"><input type="button" class="removeButton" value="x"><span>Joel Pereira</span><input checked type="checkbox" class="commentBox" id="comment_2"><label class="commentLabel" for="comment_2">Comentar</label></p>
    <p id="3" class="results"><input type="button" class="removeButton" value="x"><span>Sir Alberto Xia</span><input checked type="checkbox" class="commentBox" id="comment_3" ><label class="commentLabel" for="comment_3">Comentar</label></p>
    <p id="4" class="results"><input type="button" class="removeButton" value="x"><span>Don Carlos Covas</span><input checked type="checkbox" class="commentBox" id="comment_4"><label class="commentLabel" for="comment_4">Comentar</label></p>
</div>
<div id="publicBox">
    <p><input checked class="commentBox" id="comment_public" type="checkbox"><label class="commentLabel" for="comment_public">Comentar</label>
    </p>
</div>
<label for="tags">Palavras-chave</label>
<p><textarea name="tags" required id="tags" rows="5" placeholder="separadas,por,virgulas"><?= $input['tags'] ?></textarea></p>