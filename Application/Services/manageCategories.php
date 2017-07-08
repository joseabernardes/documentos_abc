<?php

require_once __DIR__ . '/../../Config.php';
require_once Config::getApplicationManagerPath() . 'SessionManager.php';
SessionManager::startSession();
$return = false;
$inputType = INPUT_POST;
if (SessionManager::keyExists('authUsername')) {
    require_once Config::getApplicationManagerPath() . 'UserManager.php';
    $userManager = new UserManager();
    try {
        $user = $userManager->getUserByID(SessionManager::getSessionValue('authUsername'));
        if ($user->getUserAUTHLEVEL() === 'ADMIN') {
            $type = filter_input($inputType, "type", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $input = filter_input($inputType, "input", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $input = trim($input);
            if (!empty($input)) {
                require_once Config::getApplicationManagerPath() . 'CategoryManager.php';
                $categoryManager = new CategoryManager();
                if ($type === 'add' && empty($categoryManager->getCategoryByName($input))) {  // se não existe uma com o mesmo nome
                    $return = $categoryManager->add(new CategoryModel('', $input));
                } else if ($type === 'remove' && $input != Config::DEFAULT_CATEGORY && !empty($categoryManager->getCategoryByID($input))) { // se existe a categoria
                    require_once Config::getApplicationManagerPath() . 'DocumentManager.php';
                    $docManager = new DocumentManager();
                    $docs = $docManager->getDocumentByCategory($input);
                    foreach ($docs as $value) {
                        $value->setDocumentCategoryId(Config::DEFAULT_CATEGORY);
                        $docManager->updateDocument($value);
                    }
                    $categoryManager->deleteCategory($input);
                    $return = true;
                }
            }
        }
    } catch (Exception $ex) {
        //false
    }
}
echo json_encode($return, JSON_UNESCAPED_UNICODE);