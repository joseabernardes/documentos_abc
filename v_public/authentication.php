<?php
require_once __DIR__ . '/../partials/_init.php';
require_once Config::getApplicationControllersPath() . 'AuthProcess.php';
require_once Config::getApplicationControllersPath() . 'RegistProcess.php';
const INPUT_CLASS_ERROR_NAME = 'input_erro';
const SPAN_CLASS_ERROR_NAME = 'span_erro';

$loggedIn = false;
if (SessionManager::keyExists('authUsername')) {
    $loggedIn = true;
} else if (filter_input(INPUT_COOKIE, 'rememberme')) {
    $cookie = filter_input(INPUT_COOKIE, 'rememberme');
    $tokens = explode('___', $cookie);
    if (count($tokens) == 2) {

        $tokenID = $tokens[0];
        $tokenVALUE = $tokens[1];

        $userDump = $userManager->getUserByTokenID($tokenID);
        $user = reset($userDump); //retorna o primeiro (e presumivelmente o UNICO) user
        if ($user) {
            $passDump = $userManager->getTokenByID($tokenID);
            if (password_verify($tokenVALUE, reset($passDump))) {
                SessionManager::addSessionValue('authUsername', $user->getUserID());
                $loggedIn = true;
            } else {
                $userManager->deleteToken($user); //remover o TOKEN
            }
        }
    }
}
print_r($loginErrors);
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include_once '../partials/_head.php'; ?>
        <title>Autenticação</title>
        <script src="../scripts/password.js" type="text/javascript"></script>
    </head>
    <body>
        <?php include_once '../partials/_header.php'; ?>
        <h1 id="main-title">Autenticação</h1>
        <?php
        if (!$loggedIn) {

            if ($added) {
                $string = 'Registo Efetuado';
                $url = 'authentication.php';
                $text = 'Login';
                $warning = true;
                include_once __DIR__ . '/../partials/_error.php';
            } else {
                ?>


                <main id="auth">


                    <form method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" id="login" class="auth-form">
                        <h2>LOGIN</h2>

                        <input class="<?= array_key_exists('email', $loginErrors) ? INPUT_CLASS_ERROR_NAME : '' ?>" required id="email" type="text" placeholder="email@email.com" name="email" maxlength="50" value="<?= $email ?>">
                        <?php if (array_key_exists('email', $loginErrors)) { ?><span class="<?= SPAN_CLASS_ERROR_NAME ?>"> &bull; <?= $loginErrors['email'] ?></span> <?php } ?>
                        <div id="passCont">
                            <input class="<?= array_key_exists('password', $loginErrors) ? INPUT_CLASS_ERROR_NAME : '' ?>" required id="Pass" type="password" placeholder="password" name="Pass" maxlength="50" value="<?= $pass ?>">
                            <?php if (array_key_exists('password', $loginErrors)) { ?><span class="<?= SPAN_CLASS_ERROR_NAME ?>"> &bull; <?= $loginErrors['password'] ?></span> <?php } ?>
                            <img id="pwdLogin" src="../images/password/hide.png" alt=""/>
                        </div>

                        <input type="checkbox" id="remember" name="remember" <?php echo ($remember == 'on' ? 'checked' : '' ) ?> ><label for="remember">Remember Me</label>

                        <input type="submit" value="Login" name="login">
                        <?php if (array_key_exists('permition', $loginErrors)) { ?><span class="<?= SPAN_CLASS_ERROR_NAME ?>"> &bull; <?= $loginErrors['permition'] ?></span> <?php } ?>

                    </form>
                    <!--<hr>-->
                    <form id="registar" class="auth-form" method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" enctype="multipart/form-data">
                        <h2>REGISTAR</h2>
                        <input value="<?= $input['emailR'] ?>" class="<?= array_key_exists('emailR', $errors) ? INPUT_CLASS_ERROR_NAME : '' ?>" required id="emailR" type="text" placeholder="email@email.com" name="emailR" maxlength="50">
                        <?php if (array_key_exists('emailR', $errors)) { ?><span class="<?= SPAN_CLASS_ERROR_NAME ?>"> &bull; <?= $errors['emailR'] ?></span> <?php } ?>
                        <div id="passCont">
                            <input  title="8 caracteres (1 Maiuscula, 1 Minuscula, 1 numero e um caracter especial[#?!@$%^&+*-])" pattern='(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&+*-])[0-9a-zA-Z#?!@$%^&+*-]{8,}' class="<?= array_key_exists('PassR', $errors) ? INPUT_CLASS_ERROR_NAME : '' ?>" required id="PassR" type="password" placeholder="password" name="PassR" maxlength="50">
                            <img id="pwd1" src="../images/password/hide.png" alt=""/>
                        </div>
                        <?php if (array_key_exists('PassR', $errors)) { ?><span class="<?= SPAN_CLASS_ERROR_NAME ?>"> &bull; <?= $errors['PassR'] ?></span> <?php } ?>
                        <div id="passCont">
                            <input class="<?= array_key_exists('PassR2', $errors) ? INPUT_CLASS_ERROR_NAME : '' ?>" required id="PassR2" type="password" placeholder="Confirme Password" name="PassR2" maxlength="50">
                            <img id="pwd2" src="../images/password/hide.png" alt=""/>
                        </div>
                        <?php if (array_key_exists('PassR2', $errors)) { ?><span class="<?= SPAN_CLASS_ERROR_NAME ?>"> &bull; <?= $errors['PassR2'] ?></span> <?php } ?>                  
                        <input value="<?= $input['NameR'] ?>" class="<?= array_key_exists('NameR', $errors) ? INPUT_CLASS_ERROR_NAME : '' ?>" required id="NameR" type="text" placeholder="Nome" name="NameR" maxlength="50">
                        <?php if (array_key_exists('NameR', $errors)) { ?><span class="<?= SPAN_CLASS_ERROR_NAME ?>"> &bull; <?= $errors['NameR'] ?></span> <?php } ?>
                        <label>Fotografia</label>
                        <input  class="<?= array_key_exists('file', $errors) ? INPUT_CLASS_ERROR_NAME : '' ?>" require accept="image/*" id="file" type="file" name="file"/>
                        <?php if (array_key_exists('file', $errors)) { ?><span class="<?= SPAN_CLASS_ERROR_NAME ?>"> &bull; <?= $errors['file'] ?></span> <?php } ?>
                        <input value="<?= $input['PhoneR'] ?>" class="<?= array_key_exists('PhoneR', $errors) ? INPUT_CLASS_ERROR_NAME : '' ?>" required id="PhoneR" type="tel" placeholder="Telemovel" name="PhoneR" maxlength="50">
                        <?php if (array_key_exists('PhoneR', $errors)) { ?><span class="<?= SPAN_CLASS_ERROR_NAME ?>"> &bull; <?= $errors['PhoneR'] ?></span> <?php } ?>
                        <input value="<?= $input['addressR'] ?>" class="<?= array_key_exists('addressR', $errors) ? INPUT_CLASS_ERROR_NAME : '' ?>" required id="addressR" type="text" placeholder="Rua" name="addressR" maxlength="50">
                        <?php if (array_key_exists('addressR', $errors)) { ?><span class="<?= SPAN_CLASS_ERROR_NAME ?>"> &bull; <?= $errors['addressR'] ?></span> <?php } ?>
                        <input value="<?= $input['CityR'] ?>" class="<?= array_key_exists('CityR', $errors) ? INPUT_CLASS_ERROR_NAME : '' ?>" required id="CityR" type="text" placeholder="Cidade" name="CityR" maxlength="50">
                        <?php if (array_key_exists('CityR', $errors)) { ?><span class="<?= SPAN_CLASS_ERROR_NAME ?>"> &bull; <?= $errors['CityR'] ?></span> <?php } ?>
                        <input value="<?= $input['Cp1R'] ?>" class="<?= array_key_exists('Cp1R', $errors) ? INPUT_CLASS_ERROR_NAME : '' ?>" required id="Cp1R" type="text" placeholder="Codigo "name="Cp1R" maxlength="4"><!--                
                        --><span>-</span><!--
                        --><input value="<?= $input['Cp2R'] ?>" class="<?= array_key_exists('Cp2R', $errors) ? INPUT_CLASS_ERROR_NAME : '' ?>" required id="Cp2R" type="text" placeholder="Postal" name="Cp2R" maxlength="3">
                        <div id="postError">
                            <?php if (array_key_exists('Cp1R', $errors)) { ?><span id="left" class="<?= SPAN_CLASS_ERROR_NAME ?>"> &bull; <?= $errors['Cp1R'] ?></span> <?php } ?>
                            <?php if (array_key_exists('Cp2R', $errors)) { ?><span id="right" class="<?= SPAN_CLASS_ERROR_NAME ?>"> &bull; <?= $errors['Cp2R'] ?></span> <?php } ?>
                        </div>
                        <input type="hidden" name="type" value="registar">
                        <input type="submit" value="Registar" name="registar">
                        <?php if (array_key_exists('final', $errors)) { ?><p class="<?= P_CLASS_ERROR_NAME ?>"> <?= $errors['final'] ?></p> <?php } ?>

                    </form>
                </main>
                <?php
            }
        } else {
            $string = 'Login Efetuado';
            $url = 'index.php';
            $text = 'Continuar';
            $warning = true;
            include_once __DIR__ . '/../partials/_error.php';
        }


        include_once '../partials/_footer.php';
        ?>
    </body>
</html>

