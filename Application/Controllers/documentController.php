<?php

const INPUT_CLASS_ERROR_NAME = 'input_erro';
const SPAN_CLASS_ERROR_NAME = 'span_erro';
const P_CLASS_ERROR_NAME = 'final_erro';
$inputType = INPUT_POST;
$errors = array();


$input = array();
$input['title'] = $input['summary'] = $input['tags'] = $input['doc'] = $input['reasons'] = $input['sharedUsers'] = '';
$input['category'] = Config::DEFAULT_CATEGORY; //valores predefinidos
$input['visibility'] = Config::PRIVATE_DOC; //valores predefinidos
$input['comment_public'] = 'on'; //valores predefinidos
$added = false;
if (filter_has_var($inputType, 'submit') && $_SERVER['REQUEST_METHOD'] === 'POST' && SessionManager::keyExists('authUsername')) {
    $rules = array(
        'title' => array('options' => array('regexp' => '/^[\p{L}\d ]{1,90}$/u'), 'sanitize' => FILTER_SANITIZE_SPECIAL_CHARS, 'validate' => FILTER_VALIDATE_REGEXP), //só carateres e numero entre 1 e 90
        'summary' => array('options' => array('regexp' => '/^[\n\r\p{L}\d.?!-:;_, ]{1,200}$/u'), 'sanitize' => FILTER_SANITIZE_STRING, 'validate' => FILTER_VALIDATE_REGEXP), //só carateres e numero entre 1 e 90
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
        $input[$key] = trim($input[$key]);
        if (!isset($input[$key])) {
            $errors[$key] = 'Parametro não enviado';
        } else if (empty($input[$key])) {
            $errors[$key] = 'Parametro vazio';
        } else if (!filter_var($input[$key], $value['validate'], $value)) {
            $errors[$key] = 'Parametro Invalido';
        }
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

    /*
     * Validar Categorias
     */
    if (!array_key_exists('category', $errors)) {
        $categoryManager = new CategoryManager();
        if (!array_key_exists($input['category'], $categoryManager->getAllCategories())) { // a key do array é o ID da categoria
            $errors['category'] = 'Parametro Invalido';
        }
    }

    /*
     * Validar comment_public
     */
    if ($input['visibility'] == Config::PUBLIC_DOC) {
        unset($errors['comment_public']); //se não estiver selecionada irá dizer 'parametro vazio' devido ao procedimento padronizado de cima 
        $input['comment_public'] = ($input['comment_public'] == 'on') ? 1 : 0;
    } else if (array_key_exists('comment_public', $errors)) { //significa que nao é publico e tem erros de comment_public(inuteis)
        unset($errors['comment_public']); //devem ser ignorados estes erros
        $input['comment_public'] = 0; //para aparecer não selecionada
    }

    /*
     * Validar tipo de pagina
     */
    if (!array_key_exists('type', $errors) && $input['type'] !== 'edit' && $input['type'] !== 'import' && $input['type'] !== 'create') {
        $errors['final'] = 'Tipo de pagina invalido';
    }

    /*
     * Validar file
     */
    if ($input['type'] === 'import' && is_uploaded_file($_FILES["file"]["tmp_name"])) {
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
        if ($_FILES["file"]["size"] > 5000000) {
            $errors['file'] = 'Ficheiro demasiado grande';
        }
    } else if ($input['type'] === 'import') {
        $errors['file'] = 'Parametro não enviado';
    }
    /*
     * Ajustar erros ás 3 paginas especificas
     */
    if ($input['type'] === 'import') {
        unset($errors['doc']);
        unset($errors['reasons']);
    } else if ($input['type'] === 'create') {
        unset($errors['reasons']);
    }

    if (count($errors) == 0) { //se nao tem erros
        $docManager = new DocumentManager();
        if ($input['type'] === 'edit') {
            $added = true;
            try {
                $document = $docManager->getDocumentByID($doc_id);  //THROWS GET_EXCEPTION
                $documentBackup = clone $document;
                $document->setDocumentTITLE($input['title']);
                $document->setDocumentSUMMARY($input['summary']);
                $document->setDocumentCategoryId($input['category']);
                $document->setDocumentCONTENT($input['doc']);
                $document->setDocumentVisibilityId($input['visibility']);
                $document->setDocumentCOMMENTS($input['comment_public']);
                $oldShared = $docManager->getSharedUsersByDocumentID($doc_id);
                $oldSharedBackup = $oldShared;
                $oldTags = $docManager->getTagsByDocumentID($doc_id);
//                remove para mais abaixo atualizar
                $docManager->deleteSharedUsers($doc_id);
                $docManager->deleteTagsDocument($doc_id);
                $documentid = $doc_id;
                $docManager->updateDocument($document);  //THROWS CUD_EXCEPTION
                require_once Config::getApplicationManagerPath() . "HistoricManager.php";
                $historicManager = new HistoricManager();
                $historic = new HistoricModel('', $doc_id, $input['reasons'], date("Y-m-d H:i:s"));
                $historic->setEditingID($historicManager->add($historic));
            } catch (DocumentException $ex) {
                $added = false;
                echo $ex->getCode();
                if ($ex->getCode() == Config::CUD_EXCEPTION || $ex->getCode() == DocumentException::HIST_EXCEPTION) {

                    //roolback shared e tags
                    foreach ($oldShared as $old) {
                        $docManager->addSharedUsers($old['DocumentID'], $old['UserID'], $old['DocumentUserCOMMENTS']);
                    }
                    foreach ($oldTags as $old) {
                        $docManager->addTagtoDocument($old['TagName'], $old['DocumentID']);
                    }
                }
                if ($ex->getCode() == DocumentException::HIST_EXCEPTION) {
                    $docManager->updateDocument($documentBackup);
                }
            } catch (Exception $ex) {
                $added = false;
            }
        } else if ($input['type'] === 'import') {
            $added = true;
            try {
                /* Importar Documento */
                if (!move_uploaded_file($_FILES["file"]["tmp_name"], $file_path)) {
                    $errors['file'] = 'Falha ao fazer upload';
                    throw new DocumentException();
                }
                require_once Config::getApplicationUtilsPath() . "ReadDocs.php";
                $document = new DocumentModel('', $input['title'], $input['summary'], SessionManager::getSessionValue('authUsername'), $input['category'], date("Y-m-d H:i:s"), ReadDocs::readDocx($file_path), $input['visibility'], $input['comment_public'], "/upload/docs/" . basename($fileName));
                $documentid = $docManager->add($document);
                $document->setDocumentID($documentid);
            } catch (DocumentException $ex) {
                $added = false; //falha ao inserir na bd
            }
        } else if ($input['type'] === 'create') {
            $added = true;
            /* Criar Documento */
            try {
                $document = new DocumentModel('', $input['title'], $input['summary'], SessionManager::getSessionValue('authUsername'), $input['category'], date("Y-m-d H:i:s"), $input['doc'], $input['visibility'], $input['comment_public']);
                $documentid = $docManager->add($document);
                $document->setDocumentID($documentid);
            } catch (DocumentException $ex) {
                $added = false; //falha ao inserir na bd
            }
        }
        if ($added) { // se o documento foi adicionado
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
                    if ($input['visibility'] == Config::SHARED_DOC) {
                        require_once Config::getApplicationManagerPath() . 'AlertManager.php';
                        $alertManager = new AlertManager();
                        
                        foreach ($sharedUsers as $value) {
                            if ($input['type'] === 'edit') {
                                $newSharedUser = true;
                                foreach ($oldSharedBackup as $key => $old) { //ver se os utilizadores partilhados são os mesmo que estavam, se sim, nao manda alerta!
                                    if ($old['UserID'] == $value->userID) {
                                        $newSharedUser = false;
                                        unset($oldSharedBackup[$key]); //foi encontrado logo pode ser eliminado
                                        break;
                                    }
                                }
                                if ($newSharedUser) {
                                    $alertManager->add(new AlertModel('', $value->userID,SessionManager::getSessionValue('authUsername'), $documentid, date("Y-m-d H:i:s"), AlertModel::SHARE));
                                }
                            } else {
                                $alertManager->add(new AlertModel('', $value->userID,SessionManager::getSessionValue('authUsername'), $documentid, date("Y-m-d H:i:s"), AlertModel::SHARE));
                            }
                            $docManager->addSharedUsers($documentid, $value->userID, $value->allowComments);
                        }
                        if ($input['type'] === 'edit') {
                            foreach ($oldSharedBackup as $value) { //os utilizadores partilhados que estavam, e deixaram de estar
                                $alertManager->add(new AlertModel('', $value['UserID'],SessionManager::getSessionValue('authUsername'), $documentid, date("Y-m-d H:i:s"), AlertModel::NOSHARE));
                            }
                        }
                    }
                    if ($input['type'] === 'edit' && $input['visibility'] != Config::SHARED_DOC) {
                        /* Eliminar possiveis utilizadores partilhados* */
                        try {
                            $docManager->deleteSharedUsers($documentid);
                        } catch (Exception $ex) {
                            
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

                    //voltar para os users partilhados e para as anteriores tags
                    foreach ($oldShared as $old) {
                        $docManager->addSharedUsers($old['DocumentID'], $old['UserID'], $old['DocumentUserCOMMENTS']);
                    }
                    foreach ($oldTags as $old) {
                        $docManager->addTagtoDocument($old['TagName'], $old['DocumentID']);
                    }
                    $historicManager->deleteHistoric($historic);
                    $docManager->updateDocument($documentBackup);
                } else {
                    $docManager->deleteDocument($document);
                }
                $added = false;
            }
        } else {
            $errors['final'] = 'Falha ao submeter o documento';
        }
    }
}
