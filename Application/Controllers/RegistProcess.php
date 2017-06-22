<?php

require_once Config::getApplicationManagerPath() . 'UserManager.php';
require_once Config::getApplicationModelPath() . 'UserModel.php';
require_once Config::getApplicationManagerPath() . 'AddressManager.php';
require_once Config::getApplicationModelPath() . 'AddressModel.php';
require_once Config::getApplicationManagerPath() . 'UserManager.php';
$inputType = INPUT_POST;

$input = array();
$errors = array();
$input['emailR'] = $input['PassR'] = $input['PassR2'] = $input['NameR'] = $input['PhoneR'] = $input['addressR'] = $input['CityR'] = $input['Cp1R'] = $input['Cp2R'] = '';
$added = false;
if ((filter_has_var($inputType, 'registar') || filter_has_var($inputType, 'guardar')) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $rules = array(
        'emailR' => array('sanitize' => FILTER_SANITIZE_EMAIL, 'validate' => FILTER_VALIDATE_EMAIL),
        'PassR' => array('options' => array('regexp' => '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&+*-])[0-9a-zA-Z#?!@$%^&+*-]{8,}$/'), 'sanitize' => FILTER_SANITIZE_SPECIAL_CHARS, 'validate' => FILTER_VALIDATE_REGEXP),
        'PassR2' => array('sanitize' => FILTER_SANITIZE_SPECIAL_CHARS, 'validate' => FILTER_DEFAULT),
        'NameR' => array('options' => array('regexp' => '/^[\p{L} ]{1,100}$/u'), 'sanitize' => FILTER_SANITIZE_SPECIAL_CHARS, 'validate' => FILTER_VALIDATE_REGEXP),
        'PhoneR' => array('options' => array('regexp' => '/^[9]{1}\d{8}$/'), 'sanitize' => FILTER_SANITIZE_SPECIAL_CHARS, 'validate' => FILTER_VALIDATE_REGEXP),
        'addressR' => array('options' => array('regexp' => '/^.{1,100}$/'), 'sanitize' => FILTER_SANITIZE_SPECIAL_CHARS, 'validate' => FILTER_VALIDATE_REGEXP),
        'CityR' => array('options' => array('regexp' => '/^[\p{L} ]{1,30}$/u'), 'sanitize' => FILTER_SANITIZE_SPECIAL_CHARS, 'validate' => FILTER_VALIDATE_REGEXP),
        'Cp1R' => array('options' => array('regexp' => '/^4\d{3}/'), 'sanitize' => FILTER_SANITIZE_SPECIAL_CHARS, 'validate' => FILTER_VALIDATE_REGEXP),
        'Cp2R' => array('options' => array('regexp' => '/^\d{3}/'), 'sanitize' => FILTER_SANITIZE_SPECIAL_CHARS, 'validate' => FILTER_VALIDATE_REGEXP),
        'PassRNOVA' => array('options' => array('regexp' => '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&+*-])[0-9a-zA-Z#?!@$%^&+*-]{8,}$/'), 'sanitize' => FILTER_SANITIZE_SPECIAL_CHARS, 'validate' => FILTER_VALIDATE_REGEXP),
        'PassRNOVA2' => array('sanitize' => FILTER_SANITIZE_SPECIAL_CHARS, 'validate' => FILTER_DEFAULT),
        'type' => array('sanitize' => FILTER_SANITIZE_SPECIAL_CHARS, 'validate' => FILTER_DEFAULT)
    );

    foreach ($rules as $key => $value) {
        $input[$key] = filter_input($inputType, $key, $value['sanitize']);
        if (!isset($input[$key])) {
            $errors[$key] = 'Parametro não enviado';
        } else if (empty($input[$key])) {
            $errors[$key] = 'Parametro vazio';
        } else if (!filter_var($input[$key], $value['validate'], $value)) {
            $errors[$key] = 'Parametro Invalido';
        }
        $input[$key] = trim($input[$key]); //trim tirar espaços fim e inicio da string      
    }
    $input['type'] = filter_input($inputType, 'type', FILTER_SANITIZE_SPECIAL_CHARS);

    /* ----------Verificar type---------- */
    if (!array_key_exists('type', $errors) && $input['type'] !== 'registar' && $input['type'] !== 'change') {
        $errors['type'] = 'Parametro invalido';
    }

    $userManager = new UserManager();

    if (!array_key_exists('type', $errors)) {
        if ($input['type'] === 'change') {
            $checkbox = filter_input($inputType, 'changepwd', FILTER_SANITIZE_SPECIAL_CHARS);
            if ($checkbox !== 'on') {
                unset($errors['PassR']);
                unset($errors['PassRNOVA']);
                unset($errors['PassRNOVA2']);
            } else {
                $userssArray = $userManager->getUserByID(SessionManager::getSessionValue('authUsername'));
                $u1 = reset($userssArray);
                if (password_verify($input['PassR'], $u1->getUserPASS())) {
                    if ($input['PassRNOVA'] !== $input['PassRNOVA2']) {
                        $errors['PassRNOVA'] = 'Password não confirmada';
                        $errors['PassRNOVA2'] = 'Password não confirmada';
                    }
                } else {
                    $errors['PassR'] = 'Password errada';
                }
            }
            unset($errors['PassR2']);

            $u5 = $userManager->getUserByEmail($input['emailR']);
            $u6 = reset($u5);
            if ($u6) {
                if ($u6->getUserID() !== SessionManager::getSessionValue('authUsername')) {
                    $errors['emailR'] = 'Email ja existe';
                }
            }
            unset($errors['file']);
        } else {
            unset($errors['PassRNOVA']);
            unset($errors['PassRNOVA2']);
            //------Verificar email igual----------

            if (count($userManager->getUserByEmail($input['emailR'])) > 0) {
                $errors['emailR'] = 'Este email ja existe';
            }

            //----Verificar password-----

            if ($input['PassR'] !== $input['PassR2']) {
                $errors['PassR'] = 'Password não confirmada';
                $errors['PassR2'] = 'Password não confirmada';
            }
        }
    }


    /*
     * Validar file
     */
    $uploadImage = false;
    if (is_uploaded_file($_FILES["file"]["tmp_name"])) {
        $uploadImage = true;

        $file_path = __DIR__ . "/../../upload/images/" . basename($_FILES["file"]["name"]);
        $fileName = basename($_FILES["file"]["name"]);

        //Verificar extenção do ficheiro
        $extension = pathinfo($file_path, PATHINFO_EXTENSION);
        if ($extension != "png" && $extension != "jpg" && $extension != "jpeg") {
            $errors['file'] = 'Extensão não permitida';
        }

        //Verificar se existe ficheiro igual, e acrescentar um numero antes
        while (file_exists($file_path)) {
            $fileName = uniqid() . '-' . $_FILES["file"]["name"];
            $file_path = __DIR__ . "/../../upload/images/" . basename($fileName);
        }

        //Verificar tamanho do ficheiro
        if ($_FILES["file"]["size"] > 10000000) {
            $errors['file'] = 'Ficheiro demasiado grande';
        }

        //verificar se é uma imagem 
        if (getimagesize($_FILES["file"]["tmp_name"]) === false) {
            $errors['file'] = 'Ficheiro não é uma imagem';
        }

        if (count($errors) === 0 && move_uploaded_file($_FILES["file"]["tmp_name"], $file_path) === false) {
            $errors['file'] = 'Upload nao feito';
        }
    } else if ($input['type'] === 'registar') {
        $uploadImage = false;
        $errors['file'] = 'Parametro não enviado';
    }
    if (count($errors) == 0) {

        if ($input['type'] === 'registar') {
            $added = true;
            try {
                $address = new AddressModel('', $input['addressR'], $input['CityR'], $input['Cp1R'], $input['Cp2R']);
                $addressManager = new AddressManager();
                $addressID = $addressManager->add($address);
                $password = password_hash($input['PassR'], PASSWORD_DEFAULT);
                $user = new UserModel('', $password, $input['emailR'], $input['NameR'], '/upload/images/' . $fileName, $input['PhoneR'], 'USERINACTIVE', $addressID, null);
                $manager = new UserManager();
                $manager->add($user);
                $input['emailR'] = $input['PassR'] = $input['PassR2'] = $input['NameR'] = $input['PhoneR'] = $input['addressR'] = $input['CityR'] = $input['Cp1R'] = $input['Cp2R'] = '';
            } catch (Exception $ex) {
                $added = false;
            }
        }

        if ($input['type'] === 'change') {
            $added = true;
            try {
                $u2 = $userManager->getUserByID(SessionManager::getSessionValue('authUsername'));
                $u3 = reset($u2);
                $addressManager = new AddressManager();
                $a1 = $addressManager->getAddressByID($u3->getUserADDRESS());
                $a2 = reset($a1);
                $a2->setAddressADDRESS($input['addressR']);
                $a2->setAddressCITY($input['CityR']);
                $a2->setAddressCP1($input['Cp1R']);
                $a2->setAddressCP2($input['Cp2R']);

                $addressManager->updateAdress($a2);

                $u3->setUserEMAIL($input['emailR']);
                $u3->setUserNAME($input['NameR']);
                if ($uploadImage) {
                    $u3->setUserPHOTO('/upload/images/' . $fileName);
                }
                $u3->setUserPHONE($input['PhoneR']);
                if ($checkbox === 'on') {
                    $password = password_hash($input['PassRNOVA'], PASSWORD_DEFAULT);
                    $u3->setUserPASS($password);
                }
                $userManager->updateUser($u3);
            } catch (Exception $ex) {
                $added = false;
            }
        }

        if (!$added) {
            $errors['final'] = 'Falha ao atualizar utilizador';
        }
    }
}
