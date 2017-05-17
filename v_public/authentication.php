<!DOCTYPE html>
<html>
    <head>
        <?php include_once '../partials/_head.php'; ?>
        <title>Autenticação</title>

    </head>
    <body>
        <?php include_once '../partials/_header.php'; ?>
        <h1 id="main-title">Autenticação</h1>
        <main id="auth">
            <form id="login" class="auth-form">
                <h2>LOGIN</h2>
                <input required id="email" type="text" placeholder="email@email.com" name="email" maxlength="50">
                <input required id="Pass" type="text" placeholder="password" name="Pass" maxlength="50">
                <input type="submit" value="Login">
            </form>
            <!--<hr>-->
            <form id="registar" class="auth-form">
                <h2>REGISTAR</h2>
                <input required id="emailR" type="text" placeholder="email@email.com" name="emailR" maxlength="50">
                <input required id="PassR" type="text" placeholder="password" name="PassR" maxlength="50">
                <input required id="PassR2" type="text" placeholder="Confirme Password" name="PassR2" maxlength="50">
               <input required id="NameR" type="text" placeholder="Nome" name="NameR" maxlength="50">
                <label>Fotografia</label>
                <input required accept="image/*" id="file" type="file" name="file"/>
                <input required id="PhoneR" type="tel" placeholder="Telemovel" name="PhoneR" maxlength="50">
                <input required id="addressR" type="text" placeholder="Rua" name="Addressr" maxlength="50">
                <input required id="CityR" type="text" placeholder="Cidade" name="CityR" maxlength="50">
                <input required id="Cp1R" type="text" placeholder="Codigo "name="Cp1R" maxlength="4"><!--                
                --><span>-</span><!--
                --><input required id="Cp2R" type="text" placeholder="Postal" name="Cp2R" maxlength="3">
                <input type="submit" value="Registar" name="submit">
            </form>
        </main>



        <?php include_once '../partials/_footer.php'; ?>
    </body>
</html>
