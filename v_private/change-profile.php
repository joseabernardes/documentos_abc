<?php require_once __DIR__ . '/../partials/_init.php'; ?>

<!DOCTYPE html>
<html>
    <head>
        <?php include_once '../partials/_head.php'; ?>
        <title></title>
    </head>
    <body>
        <?php include_once '../partials/_header.php'; ?>
        <h1 id="main-title">Editar Informação</h1>
        <form id="change-profile">
            <p><input required id="emailR" type="text" placeholder="email@email.com" name="emailR" maxlength="50"></p>
            <p><input required id="PassR" type="text" placeholder="password" name="PassR" maxlength="50"></p>
            <p><input required id="PassR2" type="text" placeholder="Confirme Password" name="PassR2" maxlength="50"></p>
            <p><input required id="NameR" type="text" placeholder="Nome" name="NameR" maxlength="50"></p>
            <p><input required id="PhotoR" type="text"placeholder="Fotografia" name="PhotoR" maxlength="50"></p>
            <p><input required id="PhoneR" type="tel" placeholder="Telemovel" name="PhoneR" maxlength="50"></p>
            <p><input required id="addressR" type="text" placeholder="Rua" name="Addressr" maxlength="50"></p>
            <p><input required id="CityR" type="text" placeholder="Cidade" name="CityR" maxlength="50"></p>
            <p><input required id="Cp1R" type="text" placeholder="Codigo "name="Cp1R" maxlength="4"><!--                
                --><span>-</span><!--
                --><input required id="Cp2R" type="text" placeholder="Postal" name="Cp2R" maxlength="3"></p>
            <p><input type="submit" value="Guardar"><input type="reset" value="Cancelar"></p>
        </form>
        <?php include_once '../partials/_footer.php'; ?>
    </body>
</html>
