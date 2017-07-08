<?php

require_once Config::getApplicationManagerPath() . 'UserManager.php';
require_once Config::getApplicationManagerPath() . 'AddressManager.php';
require_once Config::getApplicationManagerPath() . 'UserManager.php';

$inputType = INPUT_POST;

$input = array();
$errors = array();
$input['emailR'] = $input['PassR'] = $input['PassR2'] = $input['NameR'] = $input['PhoneR'] = $input['countryR'] = $input['CityR'] = '';
$added = false;
if ((filter_has_var($inputType, 'registar') || filter_has_var($inputType, 'guardar')) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $rules = array(
        'emailR' => array('sanitize' => FILTER_SANITIZE_EMAIL, 'validate' => FILTER_VALIDATE_EMAIL),
        'PassR' => array('options' => array('regexp' => '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&+*-])[0-9a-zA-Z#?!@$%^&+*-]{8,}$/'), 'sanitize' => FILTER_SANITIZE_SPECIAL_CHARS, 'validate' => FILTER_VALIDATE_REGEXP),
        'PassR2' => array('sanitize' => FILTER_SANITIZE_SPECIAL_CHARS, 'validate' => FILTER_DEFAULT),
        'NameR' => array('options' => array('regexp' => '/^[\p{L} ]{1,100}$/u'), 'sanitize' => FILTER_SANITIZE_SPECIAL_CHARS, 'validate' => FILTER_VALIDATE_REGEXP),
        'PhoneR' => array('options' => array('regexp' => '/^[9]{1}\d{8}$/'), 'sanitize' => FILTER_SANITIZE_SPECIAL_CHARS, 'validate' => FILTER_VALIDATE_REGEXP),
        'countryR' => array('options' => array('regexp' => '/^.{1,30}$/'), 'sanitize' => FILTER_SANITIZE_SPECIAL_CHARS, 'validate' => FILTER_VALIDATE_REGEXP),
        'CityR' => array('options' => array('regexp' => '/^[\p{L} ]{1,30}$/u'), 'sanitize' => FILTER_SANITIZE_SPECIAL_CHARS, 'validate' => FILTER_VALIDATE_REGEXP),
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
                try {
                    $u1 = $userManager->getUserByID(SessionManager::getSessionValue('authUsername'));
                    if (password_verify($input['PassR'], $u1->getUserPASS())) {
                        if ($input['PassRNOVA'] !== $input['PassRNOVA2']) {
                            $errors['PassRNOVA'] = 'Password não confirmada';
                            $errors['PassRNOVA2'] = 'Password não confirmada';
                        }
                    } else {
                        $errors['PassR'] = 'Password errada';
                    }
                } catch (Exception $ex) {
                    $errors['final'] = 'Falha ao identificar utilizador logado';
                }
            }
            unset($errors['PassR2']);

            $u6 = $userManager->getUserByEmail($input['emailR']);
            if ($u6 != false) {
                if ($u6->getUserID() !== SessionManager::getSessionValue('authUsername')) {
                    $errors['emailR'] = 'Email ja existe';
                }
            }
            unset($errors['file']);
        } else {
            unset($errors['PassRNOVA']);
            unset($errors['PassRNOVA2']);
            //------Verificar email igual----------

            if ($userManager->getUserByEmail($input['emailR']) != false) {
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
        $addressManager = new AddressManager();
        $added = true;
        if ($input['type'] === 'registar') {
            try {
                $addressID = $addressManager->add(new AddressModel('', $input['countryR'], $input['CityR']));
                $password = password_hash($input['PassR'], PASSWORD_DEFAULT);
                $userManager->add(new UserModel('', $password, $input['emailR'], $input['NameR'], '/upload/images/' . $fileName, $input['PhoneR'], 'USERINACTIVE', $addressID, null));
                $input['emailR'] = $input['PassR'] = $input['PassR2'] = $input['NameR'] = $input['PhoneR'] = $input['countryR'] = $input['CityR'] = '';
            } catch (UserException $ex) {
                $added = false;
                $addressManager->deleteAddress($addressID); //rollback
            } catch (AddressException $ex) {
                $added = false;
            } catch (Exception $ex) {
                $added = false;
            }
        } else if ($input['type'] === 'change') {
            try {
                $user = $userManager->getUserByID(SessionManager::getSessionValue('authUsername'));
                $address = $addressManager->getAddressByID($user->getUserADDRESS());
                $addressBackup = clone $address;
//                $address = new AddressModel();
                $address->setAddressCOUNTRY($input['countryR']);
                $address->setAddressCITY($input['CityR']);
                $addressManager->updateAdress($address);
                $user->setUserEMAIL($input['emailR']);
                $user->setUserNAME($input['NameR']);
                if ($uploadImage) {
                    $user->setUserPHOTO('/upload/images/' . $fileName);
                }
                $user->setUserPHONE($input['PhoneR']);
                if ($checkbox === 'on') {
                    $password = password_hash($input['PassRNOVA'], PASSWORD_DEFAULT);
                    $user->setUserPASS($password);
                }
                $userManager->updateUser($user);
            } catch (UserException $ex) {
                $added = false;
                if ($ex->getCode() == Config::CUD_EXCEPTION) {
                    $addressManager->updateAdress($addressBackup); //rollback
                }
            } catch (AddressException $ex) {
                $added = false;
            } catch (Exception $ex) {
                $added = false;
            }
        }

        if (!$added) {
            $errors['final'] = 'Falha ao inserir na base de dados, contacte um administrador';
        }
    }
}