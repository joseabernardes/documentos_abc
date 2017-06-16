<?php
require_once __DIR__ . '/../partials/_init.php';

require_once Config::getApplicationManagerPath() . "UserManager.php";
require_once Config::getApplicationManagerPath() . "AddressManager.php";
require_once Config::getApplicationControllersPath() . 'RegistProcess.php';


        const INPUT_CLASS_ERROR_NAME = 'input_erro';
        const SPAN_CLASS_ERROR_NAME = 'span_erro';
$mrdMan = new AddressManager();
$usermng = new UserManager();
$arrayU = $usermng->getUserByID(SessionManager::getSessionValue('authUsername'));
$util = reset($arrayU);
$mrdArray = $mrdMan->getAddressByID($util->getUserADDRESS());
$mrd = reset($mrdArray);
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
        <form id="change-profile" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" enctype="multipart/form-data">

            <p><input class="<?= array_key_exists('emailR', $errors) ? INPUT_CLASS_ERROR_NAME : '' ?>" required id="emailR" type="text" value="<?= $util->getUserEMAIL() ?>" name="emailR" maxlength="50"></p>
            <?php if (array_key_exists('emailR', $errors)) { ?><span class="<?= SPAN_CLASS_ERROR_NAME ?>"> &bull; <?= $errors['emailR'] ?></span> <?php } ?>
            <p><input class="<?= array_key_exists('PassRNOVA', $errors) ? INPUT_CLASS_ERROR_NAME : '' ?>"  id="PassRNOVA" type="password" placeholder="Insira nova password" name="PassRNOVA" maxlength="50"></p>
            <?php if (array_key_exists('PassRNOVA', $errors)) { ?><span class="<?= SPAN_CLASS_ERROR_NAME ?>"> &bull; <?= $errors['PassRNOVA'] ?></span> <?php } ?>
            <p><input class="<?= array_key_exists('PassR', $errors) ? INPUT_CLASS_ERROR_NAME : '' ?>"  id="PassR" type="password" placeholder="Insira password atual" name="PassR" maxlength="50"></p>
            <?php if (array_key_exists('PassR', $errors)) { ?><span class="<?= SPAN_CLASS_ERROR_NAME ?>"> &bull; <?= $errors['PassR'] ?></span> <?php } ?>
            <p><input class="<?= array_key_exists('PassR2', $errors) ? INPUT_CLASS_ERROR_NAME : '' ?>"  id="PassR2" type="password" placeholder="Confirme password atual" name="PassR2" maxlength="50"></p>
            <?php if (array_key_exists('PassR2', $errors)) { ?><span class="<?= SPAN_CLASS_ERROR_NAME ?>"> &bull; <?= $errors['PassR2'] ?></span> <?php } ?>
            <p><input class="<?= array_key_exists('NameR', $errors) ? INPUT_CLASS_ERROR_NAME : '' ?>" required id="NameR" type="text"  value="<?= $util->getUserNAME() ?>" name="NameR" maxlength="50"></p>
            <?php if (array_key_exists('NameR', $errors)) { ?><span class="<?= SPAN_CLASS_ERROR_NAME ?>"> &bull; <?= $errors['NameR'] ?></span> <?php } ?>
            <p><input class="<?= array_key_exists('PhotoR', $errors) ? INPUT_CLASS_ERROR_NAME : '' ?>" required id="PhotoR" type="file" name="PhotoR"></p>
            <?php if (array_key_exists('PhotoR', $errors)) { ?><span class="<?= SPAN_CLASS_ERROR_NAME ?>"> &bull; <?= $errors['PhotoR'] ?></span> <?php } ?>
            <p><input class="<?= array_key_exists('PhoneR', $errors) ? INPUT_CLASS_ERROR_NAME : '' ?>" required id="PhoneR" type="tel"  value="<?= $util->getUserPHONE() ?>" name="PhoneR" maxlength="50"></p>
            <?php if (array_key_exists('PhoneR', $errors)) { ?><span class="<?= SPAN_CLASS_ERROR_NAME ?>"> &bull; <?= $errors['PhoneR'] ?></span> <?php } ?>
            <p><input class="<?= array_key_exists('AddressR', $errors) ? INPUT_CLASS_ERROR_NAME : '' ?>" required id="addressR" type="text"  value="<?= $mrd->getAddressADDRESS() ?>" name="Addressr" maxlength="50"></p>
            <?php if (array_key_exists('AddressR', $errors)) { ?><span class="<?= SPAN_CLASS_ERROR_NAME ?>"> &bull; <?= $errors['AddressR'] ?></span> <?php } ?>
            <p><input class="<?= array_key_exists('CityR', $errors) ? INPUT_CLASS_ERROR_NAME : '' ?>" required id="CityR" type="text"  value="<?= $mrd->getAddressCITY() ?>" name="CityR" maxlength="50"></p>
            <?php if (array_key_exists('CityR', $errors)) { ?><span class="<?= SPAN_CLASS_ERROR_NAME ?>"> &bull; <?= $errors['PhoneR'] ?></span> <?php } ?>
            <input class="<?= array_key_exists('Cp1R', $errors) ? INPUT_CLASS_ERROR_NAME : '' ?>" required id="Cp1R" type="text" value="<?= $mrd->getAddressCP1() ?>" name="Cp1R" maxlength="4"><!--                
            --><span>-</span><!--
            --><input  class="<?= array_key_exists('Cp2R', $errors) ? INPUT_CLASS_ERROR_NAME : '' ?>" required id="Cp2R" type="text" value="<?= $mrd->getAddressCP2() ?>" name="Cp2R" maxlength="3">
            <div id="postError">
                <?php if (array_key_exists('Cp1R', $errors)) { ?><span id="left" class="<?= SPAN_CLASS_ERROR_NAME ?>"> &bull; <?= $errors['Cp1R'] ?></span> <?php } ?>
                <?php if (array_key_exists('Cp2R', $errors)) { ?><span id="right" class="<?= SPAN_CLASS_ERROR_NAME ?>"> &bull; <?= $errors['Cp2R'] ?></span> <?php } ?>
            </div>
            <p><input type="submit" name="guardar" value="Guardar"><input type="reset" name="cancelar" value="Cancelar"></p>
        </form>
        <?php include_once '../partials/_footer.php'; ?>
    </body>
</html>
