<?php

function readDocx($filename) {
    $strip_texts = '';
    $kv_texts = '';
    if (!$filename || !file_exists($filename)) {
        return false;
    }

    $zip = zip_open($filename);

    if (!$zip || is_numeric($zip)) {
        return false;
    }


    while ($zip_entry = zip_read($zip)) {

        if (zip_entry_open($zip, $zip_entry) == FALSE) {
            continue;
        }

        if (zip_entry_name($zip_entry) != "word/document.xml") {
            continue;
        }

        $kv_texts .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));

        zip_entry_close($zip_entry);
    }

    zip_close($zip);


    $texts = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $kv_texts);
    $texts = str_replace('</w:r></w:p>', "\r\n", $kv_texts);
    $strip_texts = (strip_tags($kv_texts, ''));

    return $strip_texts;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <style>
            .comment {
                /*width: 100px;*/
                padding: 5px;
                border: 1px dotted gray;
                white-space: pre-line;
                font: small sans-serif;
            }
        </style>
        <title>Test</title>
    </head>
    <body>
        <div class='comment'>
        
            <textarea name="messege" id="messege"rows="30">
                <?php
                $kv_texts = readDocx(__DIR__ . '\LEI2T3d.docx');
                if ($kv_texts !== false) {
                    echo ($kv_texts);
                } else {
                    echo 'Can\'t Read that file.';
                }
                ?> </textarea>
        </div>

    </body>
</html>