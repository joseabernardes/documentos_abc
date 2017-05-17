<label for="title">Titulo</label>
<p><input required id="title" type="text" name="title" maxlength="50" value="<?= $title ?>"/></p>
<label for="summary">Resumo</label>
<p><textarea name="summary" required id="summary" rows="5"/><?= $summary ?></textarea></p>
<label for="category">Categoria</label>
<p><select id="category" name="category">

        <option value="AI" <?php echo ($category === 'AI' ? 'selected' : '' ) ?>>Album Information</option>
        <option value="MR" <?php echo ($category === 'MR' ? 'selected' : '' ) ?>>Music Record</option>
        <option value="CD" <?php echo ($category === 'CD' ? 'selected' : '' ) ?>>Concert's date</option>
    </select></p> 
<label>Visibilidade</label>
<p>
    <input <?php echo ($visibility === 'publico' ? 'checked' : '' ) ?> id="publico" type="radio" name="visibility" value="publico"><label class="visibility" for="publico">Público</label>
    <input <?php echo ($visibility === 'partilhado' ? 'checked' : '' ) ?> id="partilhado" type="radio"  name="visibility" value="partilhado"><label class="visibility" for="partilhado">Partilhado</label>                
    <input <?php echo ($visibility === 'privado' ? 'checked' : '' ) ?> id="privado" type="radio" name="visibility"  value="privado"><label class="visibility"  for="privado">Privado</label></p>
<div id="shared"></div>
<label for="tags">Palavras-chave</label>
<p><textarea name="tags" required id="tags" rows="5" placeholder="separadas,por,virgulas"><?= $tags ?></textarea></p>
<label for="file">Documento</label>
<p><textarea name="doc" required id="doc" rows="15"><?= $document ?></textarea></p>