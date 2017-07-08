<?php

/**
 * Description of Validations
 *
 * @author jam
 */
class Validations {

    public static function validateFileToUpload($type, $extensions, $mimes, $maxSize, &$errors) {
        $file_path = __DIR__ . "/../../upload/{$type}/" . basename($_FILES["file"]["name"]);
        $fileName = basename($_FILES["file"]["name"]);

        //Verificar extenção do ficheiro
        $extension = pathinfo($file_path, PATHINFO_EXTENSION);
        $find = false;
        foreach ($extensions as $value) {
            if ($extension == $value) {
                $find = true;
                break;
            }
        }
        if (!$find) {
            $errors['file'] = 'Extensão não permitida';
        }

        //Verificar mime_type do ficheiro
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $_FILES['file']['tmp_name']);
        finfo_close($finfo);
        $find = false;
        foreach ($mimes as $value) {
            if ($mime == $value) {
                $value = true;
                break;
            }
        }
        if (!$find) {
            $errors['file'] = 'Ficheiro não permitido';
        }

        //Verificar se existe ficheiro igual, e acrescentar um numero antes
        while (file_exists($file_path)) {
            $fileName = uniqid() . '-' . $_FILES["file"]["name"];
            $file_path = __DIR__ . "/../../upload/{$type}/" . basename($fileName);
        }

        //Verificar tamanho do ficheiro
        if ($_FILES["file"]["size"] > $maxSize) {
            $errors['file'] = 'Ficheiro demasiado grande';
        }
    }

}
