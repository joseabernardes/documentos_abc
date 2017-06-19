<?php
require_once __DIR__ . '/../partials/_init.php';
require_once Config::getApplicationManagerPath() . "UserManager.php";
$userManager = new UserManager();
require_once Config::getApplicationManagerPath() . "AddressManager.php";
require_once Config::getApplicationControllersPath() . 'RegistProcess.php';


        const INPUT_CLASS_ERROR_NAME = 'input_erro';
        const SPAN_CLASS_ERROR_NAME = 'span_erro';
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include_once '../partials/_head.php'; ?>
        <title>Editar Perfil</title>
    </head>
    <body>
        <?php include_once '../partials/_header.php'; ?>
        <h1 id="main-title">Editar Informação</h1>
        <?php
        if (SessionManager::keyExists('authUsername')) {
            $mrdMan = new AddressManager();
            $arrayU = $userManager->getUserByID(SessionManager::getSessionValue('authUsername'));
            $util = reset($arrayU);
            $mrdArray = $mrdMan->getAddressByID($util->getUserADDRESS());
            $mrd = reset($mrdArray);
            if (!$added) {
                if (count($errors) == 0) {

                    $input['emailR'] = $util->getUserEMAIL();
                    $input['NameR'] = $util->getUserNAME();
                    $input['PhoneR'] = $util->getUserPHONE();
                    $input['addressR'] = $mrd->getAddressADDRESS();
                    $input['CityR'] = $mrd->getAddressCITY();
                    $input['Cp1R'] = $mrd->getAddressCP1();
                    $input['Cp2R'] = $mrd->getAddressCP2();
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
                    <input  class="<?= array_key_exists('file', $errors) ? INPUT_CLASS_ERROR_NAME : '' ?>"  accept="image/*" id="file" type="file" name="file"/>
                    <?php if (array_key_exists('file', $errors)) { ?><span class="<?= SPAN_CLASS_ERROR_NAME ?>"> &bull; <?= $errors['file'] ?></span> <?php } ?>
                    <p><input class="<?= array_key_exists('PhoneR', $errors) ? INPUT_CLASS_ERROR_NAME : '' ?>" required id="PhoneR" type="tel"  value="<?= $input['PhoneR'] ?>" name="PhoneR" maxlength="50"></p>
                    <?php if (array_key_exists('PhoneR', $errors)) { ?><span class="<?= SPAN_CLASS_ERROR_NAME ?>"> &bull; <?= $errors['PhoneR'] ?></span> <?php } ?>
                    <p><input class="<?= array_key_exists('addressR', $errors) ? INPUT_CLASS_ERROR_NAME : '' ?>" required id="addressR" type="text"  value="<?= $input['addressR'] ?>" name="addressR" maxlength="50"></p>
                    <?php if (array_key_exists('addressR', $errors)) { ?><span class="<?= SPAN_CLASS_ERROR_NAME ?>"> &bull; <?= $errors['AddressR'] ?></span> <?php } ?>
                    <p><input class="<?= array_key_exists('CityR', $errors) ? INPUT_CLASS_ERROR_NAME : '' ?>" required id="CityR" type="text"  value="<?= $input['CityR'] ?>" name="CityR" maxlength="50"></p>
                    <?php if (array_key_exists('CityR', $errors)) { ?><span class="<?= SPAN_CLASS_ERROR_NAME ?>"> &bull; <?= $errors['PhoneR'] ?></span> <?php } ?>
                    <input class="<?= array_key_exists('Cp1R', $errors) ? INPUT_CLASS_ERROR_NAME : '' ?>" required id="Cp1R" type="text" value="<?= $input['Cp1R'] ?>" name="Cp1R" maxlength="4"><!--                
                    --><span>-</span><!--
                    --><input  class="<?= array_key_exists('Cp2R', $errors) ? INPUT_CLASS_ERROR_NAME : '' ?>" required id="Cp2R" type="text" value="<?= $input['Cp2R'] ?>" name="Cp2R" maxlength="3">
                    <div id="postError">
                        <?php if (array_key_exists('Cp1R', $errors)) { ?><span id="left" class="<?= SPAN_CLASS_ERROR_NAME ?>"> &bull; <?= $errors['Cp1R'] ?></span> <?php } ?>
                        <?php if (array_key_exists('Cp2R', $errors)) { ?><span id="right" class="<?= SPAN_CLASS_ERROR_NAME ?>"> &bull; <?= $errors['Cp2R'] ?></span> <?php } ?>
                    </div>
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
