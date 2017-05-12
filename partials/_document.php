<label for="title">Titulo</label><input required id="title" type="text" name="title" maxlength="50"/>
<label for="summary">Resumo</label>
<textarea name="summary" required id="summary" rows="5"/></textarea>


<label for="category">Categoria</label>
<select id="category" name="category">
    <option value="AI">Album Information</option>
    <option value="MR" selected>Music Record</option>
    <option value="CD">Concert's date</option>
</select>  
<fieldset>
    <legend>Visibilidade</legend>
    <input id="publico" type="radio" name="visibility" value="publico"><label class="notalabel" for="publico">Público</label>
    <input id="partilhado" type="radio"  name="visibility" value="partilhado"><label class="notalabel" for="partilhado">Partilhado</label>                
    <input id="privado" type="radio" name="visibility"  value="privado"><label class="notalabel"  for="privado">Privado</label>
</fieldset>
<label for="tags">Palavras-chave</label>
<textarea name="tags" required id="tags" rows="5" placeholder="separadas,por,virgulas"></textarea>