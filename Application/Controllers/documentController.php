<?php

        const INPUT_CLASS_ERROR_NAME = 'input_erro';
        const SPAN_CLASS_ERROR_NAME = 'span_erro';
$inputType = INPUT_POST;
$errors = array();

$input = array();
$input['title'] = $input['summary'] = $input['tags'] = $input['doc'] = $input['reasons'] = '';
$input['category'] = 1; //valores predefinidos
$input['visibility'] = 3; //valores predefinidos
$input['comment_public'] = 'on'; //valores predefinidos
if (filter_has_var($inputType, 'submit') && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $rules = array(
        'title' => array('options' => array('regexp' => '/^[\pL\d ]{1,90}$/u'), 'sanitize' => FILTER_SANITIZE_FULL_SPECIAL_CHARS, 'validate' => FILTER_VALIDATE_REGEXP), //só carateres e numero entre 1 e 90
        'summary' => array('options' => array('regexp' => '/^[\p{L}\d ]{1,200}$/u'), 'sanitize' => FILTER_SANITIZE_FULL_SPECIAL_CHARS, 'validate' => FILTER_VALIDATE_REGEXP),
        'tags' => array('options' => array('regexp' => '/^([\p{L}\d]+,)*[\p{L}\d]+$/u'), 'sanitize' => FILTER_SANITIZE_FULL_SPECIAL_CHARS, 'validate' => FILTER_VALIDATE_REGEXP), //só caraeres e numeros separados por ,
        'doc' => array('sanitize' => FILTER_SANITIZE_FULL_SPECIAL_CHARS, 'validate' => FILTER_DEFAULT),
        'category' => array('sanitize' => FILTER_SANITIZE_FULL_SPECIAL_CHARS, 'validate' => FILTER_DEFAULT),
        'visibility' => array('options' => array('min_range' => 1, 'max_range' => 3), 'sanitize' => FILTER_SANITIZE_NUMBER_INT, 'validate' => FILTER_VALIDATE_INT),
        'comment_public' => array('sanitize' => FILTER_SANITIZE_FULL_SPECIAL_CHARS, 'validate' => FILTER_DEFAULT),
        'reasons' => array('sanitize' => FILTER_SANITIZE_FULL_SPECIAL_CHARS, 'validate' => FILTER_DEFAULT),
        'type' => array('sanitize' => FILTER_SANITIZE_FULL_SPECIAL_CHARS, 'validate' => FILTER_DEFAULT)
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
    /*
     * Validar Categorias
     */
    if (!array_key_exists('category', $errors)) {
        $cat = new CategoryManager();
        $catDump = $cat->getAllCategories();
        $flag = false;
        foreach ($catDump as $value) {
            if (!$flag && $input['category'] == $value->getCategoryID()) {
                $flag = true;
            }
        }
        if (!$flag) {
            $errors['category'] = 'Parametro Invalido';
        }
    }
    /*
     * Validar comment_public
     */
    if ($input['visibility'] == 1) {
        if (!array_key_exists('comment_public', $errors) && $input['comment_public'] != 'on' && $input['comment_public'] != 'off') {
            $errors['comment_public'] = 'Parametro Invalido';
        }
    } else if (array_key_exists('comment_public', $errors)) { //significa que nao é publico e tem erros de comment_public(malicioso!)
        unset($errors['comment_public']); //devem ser ignorados estes erros
        unset($input['comment_public']); //para ser enviado null
    }

    /*
     * Validar type
     */
    if (!array_key_exists('type', $errors) && $input['type'] !== 'edit' && $input['type'] !== 'import' && $input['type'] !== 'create') {
        $errors['type'] = 'Parametro Invalido';
    }

    /*
     * Validar file
     */
    if ($input['type'] === 'import' && is_uploaded_file($_FILES["file"]["tmp_name"])) {

        $file_path = __DIR__ . "/../../upload/" . basename($_FILES["file"]["name"]);
        $fileName = basename($_FILES["file"]["name"]);

        //Verificar extenção do ficheiro
        $extension = pathinfo($file_path, PATHINFO_EXTENSION);
        if ($extension != "doc" && $extension != "docx") {
            $errors['file'] = 'Extensão não permitida';
        }

        //Verificar mime_type do ficheiro
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $_FILES['file']['tmp_name']);
        finfo_close($finfo);
        echo $mime;
        if ($mime != 'application/msword' && $mime != 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
            $errors['file'] = 'Ficheiro não permitido';
            echo $mime;
        }

        //Verificar se existe ficheiro igual, e acrescentar um numero antes
        while (file_exists($file_path)) {
            $fileName = uniqid() . '-' . $_FILES["file"]["name"];
            $file_path = __DIR__ . "/../../upload/" . basename($fileName);
        }

        //Verificar tamanho do ficheiro
        if ($_FILES["file"]["size"] > 400000) {
            $errors['file'] = 'Ficheiro demasiado grande';
        }
    } else {
        $errors['file'] = 'Parametro não enviado';
    }
    /*
     * Ajustar erros ás 3 paginas especificas
     */
    if (!array_key_exists('type', $errors)) {

        if ($input['type'] === 'edit') {
            unset($errors['file']);
        } else if ($input['type'] === 'import') {
            unset($errors['doc']);
            unset($errors['reasons']);
        } else if ($input['type'] === 'create') {
            unset($errors['file']);
            unset($errors['reasons']);
        }
    }

    if (count($errors) == 0) { //se nao tem erros
        require_once Config::getApplicationManagerPath() . "DocumentManager.php";
        require_once Config::getApplicationModelPath() . "DocumentModel.php";


        echo 'sem erros';
        if ($input['type'] === 'edit') {
            echo '<br>';
            echo 'EDITAR';
        } else if ($input['type'] === 'import') {
            echo '<br>';
            echo 'IMPORTAR';
//            if (!move_uploaded_file($_FILES["file"]["tmp_name"], $file_path)) {
//               echo 'nao upload';
//            }
        } else if ($input['type'] === 'create') {
            $docManager = new DocumentManager();
            $document = new DocumentModel('', $input['title'], $input['summary'], 1, $input['category'], date("Y-m-d H:i:s"), $input['doc'], $input['visibility'], $input['comment_public']);
            $docManager->add($document);

            echo '<br>';
            echo 'CRIAR';
        }
//        , "upload/" . $fileName,
    } else {
        echo 'com erros';
    }
}    