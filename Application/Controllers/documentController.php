<?php

        const INPUT_CLASS_ERROR_NAME = 'input_erro';
        const SPAN_CLASS_ERROR_NAME = 'span_erro';
        const P_CLASS_ERROR_NAME = 'final_erro';
$inputType = INPUT_POST;
$errors = array();

$input = array();
$input['title'] = $input['summary'] = $input['tags'] = $input['doc'] = $input['reasons'] = $input['sharedUsers'] = '';
$input['category'] = 1; //valores predefinidos
$input['visibility'] = 2; //valores predefinidos
$input['comment_public'] = 'on'; //valores predefinidos
$added = false;
if (filter_has_var($inputType, 'submit') && $_SERVER['REQUEST_METHOD'] === 'POST' && SessionManager::keyExists('authUsername')) {
    $rules = array(
        'title' => array('options' => array('regexp' => '/^[\p{L}\d ]{1,90}$/u'), 'sanitize' => FILTER_SANITIZE_SPECIAL_CHARS, 'validate' => FILTER_VALIDATE_REGEXP), //só carateres e numero entre 1 e 90
        'summary' => array('sanitize' => FILTER_SANITIZE_SPECIAL_CHARS, 'validate' => FILTER_DEFAULT),
        'tags' => array('options' => array('regexp' => '/^([\p{L}\d]+,)*[\p{L}\d]+$/u'), 'sanitize' => FILTER_SANITIZE_SPECIAL_CHARS, 'validate' => FILTER_VALIDATE_REGEXP), //só caraeres e numeros separados por ,
        'doc' => array('sanitize' => FILTER_SANITIZE_SPECIAL_CHARS, 'validate' => FILTER_DEFAULT),
        'category' => array('sanitize' => FILTER_SANITIZE_SPECIAL_CHARS, 'validate' => FILTER_DEFAULT),
        'visibility' => array('options' => array('min_range' => 1, 'max_range' => 3), 'sanitize' => FILTER_SANITIZE_NUMBER_INT, 'validate' => FILTER_VALIDATE_INT),
        'comment_public' => array('sanitize' => FILTER_SANITIZE_SPECIAL_CHARS, 'validate' => FILTER_DEFAULT),
        'reasons' => array('sanitize' => FILTER_SANITIZE_SPECIAL_CHARS, 'validate' => FILTER_DEFAULT),
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
        $input[$key] = trim($input[$key]);  //erraddooo
    }
    /*
     * Validar e Sanitizar utilizadores partilhados
     */
    $input['sharedUsers'] = urldecode(filter_input($inputType, 'sharedUsers'));
    $sharedUsers = json_decode($input['sharedUsers']);
    foreach ($sharedUsers as $value) {
        $value->userEMAIL = filter_var($value->userEMAIL, FILTER_SANITIZE_EMAIL);
        $value->userID = filter_var($value->userID, FILTER_SANITIZE_NUMBER_INT);
        $value->allowComments = filter_var($value->allowComments, FILTER_VALIDATE_BOOLEAN);

        if (!$value->userEMAIL || !filter_var($value->userEMAIL, FILTER_VALIDATE_EMAIL) || !$value->userID || !filter_var($value->userID, FILTER_VALIDATE_INT)) {
            $errors['sharedUsers'] = 'Parametro Invalido';
        }
    }
    $input['sharedUsers'] = urlencode($input['sharedUsers']);


    /**
     * Validar Summary
     */
    $size = mb_strlen($input['summary'], "UTF-8");
    if ($size < 1 || $size > 200) {
        $errors['summary'] = 'Parametro Invalido';
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
//                RETURN;
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
        unset($errors['comment_public']);
        if ($input['comment_public'] == 'on') {
            $input['comment_public'] = 1;
        } else {
            $input['comment_public'] = 0;
        }
    } else if (array_key_exists('comment_public', $errors)) { //significa que nao é publico e tem erros de comment_public(malicioso!)
        unset($errors['comment_public']); //devem ser ignorados estes erros
        $input['comment_public'] = 0; //para ser enviado 0
    }

    /*
     * Validar type
     */
    if (!array_key_exists('type', $errors) && $input['type'] !== 'edit' && $input['type'] !== 'import' && $input['type'] !== 'create') {
        $errors['type'] = 'Parametro Invalido'; // NÃO USO
    }

    /*
     * Validar file
     */
    if (!array_key_exists('type', $errors) && $input['type'] === 'import' && is_uploaded_file($_FILES["file"]["tmp_name"])) {

        $file_path = __DIR__ . "/../../upload/docs/" . basename($_FILES["file"]["name"]);
        $fileName = basename($_FILES["file"]["name"]);

        //Verificar extenção do ficheiro
        $extension = pathinfo($file_path, PATHINFO_EXTENSION);
        if ($extension != "docx") { //$extension != "doc" && 
            $errors['file'] = 'Extensão não permitida';
        }

        //Verificar mime_type do ficheiro
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $_FILES['file']['tmp_name']);
        finfo_close($finfo);
        if ($mime != 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') { //$mime != 'application/msword' && 
            $errors['file'] = 'Ficheiro não permitido';
        }

        //Verificar se existe ficheiro igual, e acrescentar um numero antes
        while (file_exists($file_path)) {
            $fileName = uniqid() . '-' . $_FILES["file"]["name"];
            $file_path = __DIR__ . "/../../upload/docs/" . basename($fileName);
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
        if ($input['type'] === 'edit') {
            $added = true;
            try {
                $document = $docManager->getDocumentByID($doc_id);
                $document = reset($document);
                $documentBackup = clone $document;
                if ($document) {
                    $document->setDocumentTITLE($input['title']);
                    $document->setDocumentSUMMARY($input['summary']);
                    $document->setDocumentCategoryId($input['category']);
                    $document->setDocumentCONTENT($input['doc']);
                    $document->setDocumentVisibilityId($input['visibility']);
                    $document->setDocumentCOMMENTS($input['comment_public']);
                    $docManager = new DocumentManager();
                    $oldShared = $docManager->getSharedUsersByDocumentID($doc_id);
                    $docManager->deleteSharedUsers($doc_id);
                    $docManager->deleteTagsDocument($doc_id);
                    $documentid = $doc_id;
                    $docManager->updateDocument($document);
                    require_once Config::getApplicationManagerPath() . "HistoricManager.php";
                    $hist = new HistoricManager();
                    $hism = new HistoricModel('', $doc_id, $input['reasons'], date("Y-m-d H:i:s"));
                    $hism->setEditingID($hist->add($hism));
                } else {
                    throw new Exception();
                }
            } catch (Exceptions $ex) {
                $added = false;
            }
        } else if ($input['type'] === 'import') {
            $added = true;
            try {
                /* Importar Documento */
                if (!move_uploaded_file($_FILES["file"]["tmp_name"], $file_path)) {
                    $errors['file'] = 'Falha ao fazer upload';
                    throw new Exception();
                }
                require_once Config::getApplicationUtilsPath() . "ReadDocs.php";
                $input['doc'] = ReadDocs::readDocx($file_path);
                $document = new DocumentModel('', $input['title'], $input['summary'], SessionManager::getSessionValue('authUsername'), $input['category'], date("Y-m-d H:i:s"), $input['doc'], $input['visibility'], $input['comment_public'], "/upload/docs/" . basename($fileName));
                $documentid = $docManager->add($document);
                if ($documentid == -1) {
                    throw new Exception();
                }
                $document->setDocumentID($documentid);
            } catch (Exception $ex) {
                $added = false;
            }
        } else if ($input['type'] === 'create') {
            $added = true;
            /* Criar Documento */
            try {
                $document = new DocumentModel('', $input['title'], $input['summary'], SessionManager::getSessionValue('authUsername'), $input['category'], date("Y-m-d H:i:s"), $input['doc'], $input['visibility'], $input['comment_public']);

                $documentid = $docManager->add($document);
                if ($documentid == -1) {
                    throw new Exception();
                }
                $document->setDocumentID($documentid);
            } catch (Exception $ex) {
                $added = false;
            }
        }
        if ($added) {
            try {
                try {
                    /* Criar Tags */
                    $tags = explode(',', $input['tags']);
                    foreach ($tags as $value) {
                        $docManager->addTagtoDocument($value, $documentid);
                    }
                } catch (Exception $ex) {
                    $errors['tags'] = 'Falha ao inserir, possiveis tags iguais';
                    throw $ex;
                }

                try {
                    /* Shared Users */
                    if ($input['visibility'] == '3') {
                        require_once Config::getApplicationManagerPath() . 'AlertManager.php';
                        $alertManager = new AlertManager();
                        foreach ($sharedUsers as $value) {
                            if ($input['type'] === 'edit') {
                                $boolean = true;
                                foreach ($oldShared as $old) { //ver se os utilizadores partilhados são os mesmo que estavam, se sim, nao manda alerta!
                                    if ($old['UserID'] == $value->userID) {
                                        $boolean = false;
                                        break;
                                    }
                                }
                                if ($boolean) {
                                    $alertManager->add(new AlertModel('', $value->userID, $documentid,date("Y-m-d H:i:s")));
                                }
                            } else {
                                $alertManager->add(new AlertModel('', $value->userID, $documentid,date("Y-m-d H:i:s")));
                            }
                            $docManager->addSharedUsers($documentid, $value->userID, $value->allowComments);
                        }
                    }
                    if ($input['type'] === 'edit' && $input['visibility'] != '3') {
                        /* Eliminar possiveis utilizadores partilhados* */
                        try {
                            $docManager->deleteSharedUsers($documentid);
                        } catch (Exception $ex) {
                            //caso não exista
                        }
                    }
                } catch (Exception $ex) {
                    $errors['sharedUsers'] = 'Falha ao associar os utilizadores';
                    throw $ex;
                }
                //SUCESSO
            } catch (Exception $ex) {
                /* Reverter */
                $docManager->deleteSharedUsers($documentid);
             
                $docManager->deleteTagsDocument($documentid);
                if ($input['type'] === 'edit') {
                    $hist->deleteHistoric($hism);
                    $docManager->updateDocument($documentBackup);
                } else {
                    $docManager->deleteDocument($document);
                }
                $added = false;
            }
        } else {
            $errors['final'] = 'Falha ao submeter o documento!';
        }
    }
}
