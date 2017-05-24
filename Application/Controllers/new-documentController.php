<?php
$inputType = INPUT_POST;
$errors = array();

$input = array();
$input['title'] = $input['summary'] = $input['tags'] = $input['doc'] = '';
$input['category'] = 'AI';
$input['visibility'] = 'privado';
if (filter_has_var($inputType, 'submit') && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $rules = array(
        'title' => array('sanitize' => FILTER_SANITIZE_FULL_SPECIAL_CHARS, 'validate' => FILTER_DEFAULT),
        'summary' => array('sanitize' => FILTER_SANITIZE_EMAIL, 'validate' =>  FILTER_DEFAULT),
        'phone' => array('options' => array('default' => '', 'min_range' => 0, 'max_range' => 3), 'sanitize' => FILTER_SANITIZE_NUMBER_INT, 'validate' => FILTER_VALIDATE_INT),
        'address' => array('sanitize' => FILTER_SANITIZE_FULL_SPECIAL_CHARS, 'validate' => FILTER_DEFAULT),
        'postcode' => array('options' => array('regexp' => '/^4\d{3}-\d{3}$/'), 'sanitize' => FILTER_SANITIZE_FULL_SPECIAL_CHARS, 'validate' => FILTER_VALIDATE_REGEXP),
        'contry' => array('sanitize' => FILTER_SANITIZE_FULL_SPECIAL_CHARS, 'validate' => FILTER_DEFAULT),
        'card' => array('sanitize' => FILTER_SANITIZE_FULL_SPECIAL_CHARS, 'validate' => FILTER_DEFAULT),
        'cardnumber' => array('sanitize' => FILTER_SANITIZE_NUMBER_INT, 'validate' => FILTER_VALIDATE_INT),
        'securitycode' => array('sanitize' => FILTER_SANITIZE_FULL_SPECIAL_CHARS, 'validate' => FILTER_DEFAULT),
        'cardname' => array('sanitize' => FILTER_SANITIZE_FULL_SPECIAL_CHARS, 'validate' => FILTER_DEFAULT),
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

    if (count($errors) == 0) {
        header('Location: sales.php');
    }
}

