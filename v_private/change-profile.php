<?php
require_once __DIR__ . '/../partials/_init.php';
require_once Config::getApplicationManagerPath() . "AddressManager.php";
require_once Config::getApplicationControllersPath() . 'RegistProcess.php';
const INPUT_CLASS_ERROR_NAME = 'input_erro';
const SPAN_CLASS_ERROR_NAME = 'span_erro';
$pageTitle = 'Alterar Perfil';
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include_once '../partials/_head.php'; ?>
        <script src="../scripts/changeProfile.js" type="text/javascript"></script>
        <title><?= $pageTitle ?></title>
    </head>
    <body>
        <?php include_once '../partials/_header.php'; ?>
        <h1 id="main-title"><?= $pageTitle ?></h1>
        <?php
   
        if (SessionManager::keyExists('authUsername')) {
            $addressManager = new AddressManager();
            try {
                $util = $userManager->getUserByID(SessionManager::getSessionValue('authUsername'));
                $mrd = $addressManager->getAddressByID($util->getUserADDRESS());
                if (!$added) {
                    if (count($errors) == 0) { // é a primeira vez que se entra na pagina
//                        $util = new UserModel();
                        $input['emailR'] = $util->getUserEMAIL();
                        $input['NameR'] = $util->getUserNAME();
                        $input['PhoneR'] = $util->getUserPHONE();
                        $input['countryR'] = $mrd->getAddressCOUNTRY();
                        $input['CityR'] = $mrd->getAddressCITY();
                        $file_path = $util->getUserPHOTO();
                    }else{
                         $file_path = $util->getUserPHOTO();
                    }
                    ?>
                    <form method="post" id="change-profile" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" enctype="multipart/form-data">

                        <p><input class="<?= array_key_exists('emailR', $errors) ? INPUT_CLASS_ERROR_NAME : '' ?>" required id="emailR" type="text" value="<?= $input['emailR'] ?>" name="emailR" maxlength="50"></p>
                        <?php if (array_key_exists('emailR', $errors)) { ?><span class="<?= SPAN_CLASS_ERROR_NAME ?>"> &bull; <?= $errors['emailR'] ?></span> <?php } ?>
                        <p><input id="alpwd" type="checkbox" name="changepwd"/><label for="alpwd">Alterar Password</label></p>
                        <p><input class="<?= array_key_exists('PassR', $errors) ? INPUT_CLASS_ERROR_NAME : '' ?>"  id="PassR" type="password" placeholder="Insira password atual" name="PassR" maxlength="50"></p>
                        <?php if (array_key_exists('PassR', $errors)) { ?><span class="<?= SPAN_CLASS_ERROR_NAME ?>"> &bull; <?= $errors['PassR'] ?></span> <?php } ?>
                        <p><input class="<?= array_key_exists('PassRNOVA', $errors) ? INPUT_CLASS_ERROR_NAME : '' ?>"  id="PassRNOVA" type="password" placeholder="Insira password nova" name="PassRNOVA" maxlength="50"></p>
                        <?php if (array_key_exists('PassRNOVA', $errors)) { ?><span class="<?= SPAN_CLASS_ERROR_NAME ?>"> &bull; <?= $errors['PassRNOVA'] ?></span> <?php } ?>
                        <p><input class="<?= array_key_exists('PassRNOVA2', $errors) ? INPUT_CLASS_ERROR_NAME : '' ?>"  id="PassRNOVA2" type="password" placeholder="Confirme nova password" name="PassRNOVA2" maxlength="50"></p>
                        <?php if (array_key_exists('PassRNOVA2', $errors)) { ?><span class="<?= SPAN_CLASS_ERROR_NAME ?>"> &bull; <?= $errors['PassRNOVA2'] ?></span> <?php } ?>
                        <p><input class="<?= array_key_exists('NameR', $errors) ? INPUT_CLASS_ERROR_NAME : '' ?>" required id="NameR" type="text"  value="<?= $input['NameR'] ?>" name="NameR" maxlength="50"></p>
                        <?php if (array_key_exists('NameR', $errors)) { ?><span class="<?= SPAN_CLASS_ERROR_NAME ?>"> &bull; <?= $errors['NameR'] ?></span> <?php } ?>
                        <img id="avatar" src="<?= $file_path ?>" alt="avatar"/>
                        <input  class="<?= array_key_exists('file', $errors) ? INPUT_CLASS_ERROR_NAME : '' ?>"  accept="image/*" id="file" type="file" name="file"/>
                        <?php if (array_key_exists('file', $errors)) { ?><span class="<?= SPAN_CLASS_ERROR_NAME ?>"> &bull; <?= $errors['file'] ?></span> <?php } ?>
                        <p><input class="<?= array_key_exists('PhoneR', $errors) ? INPUT_CLASS_ERROR_NAME : '' ?>" required id="PhoneR" type="tel"  value="<?= $input['PhoneR'] ?>" name="PhoneR" maxlength="50"></p>
                        <?php if (array_key_exists('PhoneR', $errors)) { ?><span class="<?= SPAN_CLASS_ERROR_NAME ?>"> &bull; <?= $errors['PhoneR'] ?></span> <?php } ?>
                        <p><input class="<?= array_key_exists('CityR', $errors) ? INPUT_CLASS_ERROR_NAME : '' ?>" required id="CityR" type="text"  value="<?= $input['CityR'] ?>" name="CityR" maxlength="50"></p>
                        <p><input class="<?= array_key_exists('countryR', $errors) ? INPUT_CLASS_ERROR_NAME : '' ?>" required id="countryR" type="text"  value="<?= $input['countryR'] ?>" name="countryR" maxlength="50"></p>
                        <?php if (array_key_exists('countryR', $errors)) { ?><span class="<?= SPAN_CLASS_ERROR_NAME ?>"> &bull; <?= $errors['countryR'] ?></span> <?php } ?>
                        <?php if (array_key_exists('CityR', $errors)) { ?><span class="<?= SPAN_CLASS_ERROR_NAME ?>"> &bull; <?= $errors['PhoneR'] ?></span> <?php } ?>
                        <input type="hidden" name="type" value="change">
                        <p><input type="submit" name="guardar" value="Guardar"><input type="reset" name="cancelar" value="Cancelar"></p>
                        <?php if (array_key_exists('final', $errors)) { ?><p class="<?= P_CLASS_ERROR_NAME ?>"> <?= $errors['final'] ?></p> <?php } ?>

                    </form> 
                    <?php
                } else {
                    $string = 'Utilizador atualizado com sucesso';
                    $url = "../v_private/profile-page.php?id=" . SessionManager::getSessionValue('authUsername');
                    $text = 'Pagina de Perfil';
                    $warning = true;
                    include_once __DIR__ . '/../partials/_error.php';
                }
            } catch (Exception $ex) {
                $string = 'Falha ao identificar utilizador';
                $url = '../v_public/index.php';
                $text = 'Sair';
                include_once __DIR__ . '/../partials/_error.php';
            }
        } else {
            $string = 'Necessário autenticação';
            $url = '../v_public/authentication.php';
            $text = 'Login';
            include_once __DIR__ . '/../partials/_error.php';
        }
        ?>






        <?php include_once '../partials/_footer.php'; ?>
    </body>
</html>
