<?php

function readDocx($filename) {
    $text = '';
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
        $text .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
        zip_entry_close($zip_entry);
    }

    zip_close($zip);
    $texts = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $text);
    $texts = str_replace('</w:r></w:p>', "\r\n", $texts);
    $strip_texts = (strip_tags($texts, ''));

    return $strip_texts;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <style>
            .comment {

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
            <?php
            $text = readDocx(__DIR__ . '/../../upload/docs/GPI.docx');
            if ($text !== false) {
                echo ($text);
            } else {
                echo 'Can\'t Read that file.';
            }
            ?>
            <textarea name="messege" id="messege"rows="30">
                <?php
                $text = readDocx(__DIR__ . '/../../upload/docs/GPI.docx');
                if ($text !== false) {
                    echo ($text);
                } else {
                    echo 'Can\'t Read that file.';
                }
                ?> </textarea>
        </div>

    </body>
</html>