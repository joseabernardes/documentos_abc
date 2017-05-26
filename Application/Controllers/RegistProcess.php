<?php

require_once Config::getApplicationManagerPath() . 'UserManager.php';
require_once Config::getApplicationModelPath() . 'UserModel.php';
require_once Config::getApplicationManagerPath() . 'AddressManager.php';
require_once Config::getApplicationModelPath() . 'AddressModel.php';
require_once Config::getApplicationManagerPath() . 'UserManager.php';
$inputType = INPUT_POST;

$input = array();
$errors = array();
$input['emailR'] = $input['PassR'] = $input['PassR2'] = $input['NameR'] = $input['file'] = $input['PhoneR'] = $input['Addressr'] = $input['CityR'] = $input['Cp1R'] = $input['Cp2R'] = '';

if (filter_has_var($inputType, 'registar') && $_SERVER['REQUEST_METHOD'] === 'POST') {

    $rules = array(
        'emailR' => array('sanitize' => FILTER_SANITIZE_EMAIL, 'validate' => FILTER_VALIDATE_EMAIL),
        'PassR' => array('options' => array('regexp' => '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&+*-])[0-9a-zA-Z#?!@$%^&+*-]{8,}$/'), 'sanitize' => FILTER_SANITIZE_FULL_SPECIAL_CHARS, 'validate' => FILTER_VALIDATE_REGEXP),
        'PassR2' => array('sanitize' => FILTER_SANITIZE_FULL_SPECIAL_CHARS, 'validate' => FILTER_DEFAULT),
        'NameR' => array('options' => array('regexp' => '/^[\p{L} ]{1,100}$/'), 'sanitize' => FILTER_SANITIZE_FULL_SPECIAL_CHARS, 'validate' => FILTER_VALIDATE_REGEXP),
        'file' => array('sanitize' => FILTER_SANITIZE_FULL_SPECIAL_CHARS, 'validate' => FILTER_DEFAULT),
        'PhoneR' => array('options' => array('min_range' => 9, 'max_range' => 9), 'sanitize' => FILTER_SANITIZE_NUMBER_INT, 'validate' => FILTER_DEFAULT),
        'Addressr' => array('options' => array('regexp' => '/^.{1,100}$/'), 'sanitize' => FILTER_SANITIZE_FULL_SPECIAL_CHARS, 'validate' => FILTER_VALIDATE_REGEXP),
        'CityR' => array('options' => array('regexp' => '/^[\p{L} ]{1,30}$/'), 'sanitize' => FILTER_SANITIZE_FULL_SPECIAL_CHARS, 'validate' => FILTER_VALIDATE_REGEXP),
        'Cp1R' => array('options' => array('regexp' => '/^4\d{3}/'), 'sanitize' => FILTER_SANITIZE_FULL_SPECIAL_CHARS, 'validate' => FILTER_VALIDATE_REGEXP),
        'Cp2R' => array('options' => array('regexp' => '/^\d{3}/'), 'sanitize' => FILTER_SANITIZE_FULL_SPECIAL_CHARS, 'validate' => FILTER_VALIDATE_REGEXP)
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
        $input[$key] = trim($input[$key]);
    }

    //----Verificar password-----

    if ($input['PassR'] !== $input['PassR2']) {
        $errors['PassR'] = 'Password não confirmada';
        $errors['PassR2'] = 'Password não confirmada';
    }

    //------Verificar email igual----------

    $userManager = new UserManager();

    if (count($userManager->getUserByEmail($input['emailR'])) > 0) {
        $errors['emailR'] = 'Este email ja existe';
    }

    //-----Verificar imagem------

    /*
     * Validar file
     */
    if ( is_uploaded_file($_FILES["file"]["tmp_name"])) {

        $file_path = __DIR__ . "/../../images/" . basename($_FILES["file"]["name"]);


        //Verificar extenção do ficheiro
        $extension = pathinfo($file_path, PATHINFO_EXTENSION);
        if ($extension != "png" && $extension != "jpg" && $extension!="jpeg") {
            $errors['file'] = 'Extensão não permitida';
            
        }

        //Verificar se existe ficheiro igual, e acrescentar um numero antes
        while (file_exists($file_path)) {
            $fileName = uniqid() . '-' . $_FILES["file"]["name"];
            $file_path = __DIR__ . "/../../images/" . basename($fileName);
        }

        //Verificar tamanho do ficheiro
        if ($_FILES["file"]["size"] > 10000000) {
            $errors['file'] = 'Ficheiro demasiado grande';
        }
        //verificar se é uma imagem 
        
        
        
    } else {
        $errors['file'] = 'Parametro não enviado';
    }

    if (count($errors) == 0) {

        $address = new AddressModel($input['Addressr'], $input['CityR'], $input['Cp1R'], $input['Cp2R']);
        $addressManager = new AddressManager();
        $addressManager->add($address);

        $password = password_hash($input['PassR'], PASSWORD_DEFAULT);

        $user = new UserModel('', $input['emailR'], $password, $input['NameR'], $input['file'], $input['PhoneR'], 'USERINACTIVE', $address->getAddressID(), null);
        $manager = new UserManager();
        $manager->add($user);
    }
}
    