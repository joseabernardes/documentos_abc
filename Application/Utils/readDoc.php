<?php

//header('Content-Type: text/html; charset=ISO-8859-1');

function convert($text) {
    $text = trim($text);
    return '<p>' . preg_replace('/[\r\n]+/', '</p><p>', $text) . '</p>';
}

function readTxt($filename) {
    $fh = fopen($filename, 'r');
    $concat = '';

    while ($line = fgets($fh)) {

        $concat = $concat . $line;
    }
    fclose($fh);
    $concat = iconv('', 'UTF-8//IGNORE', $concat);
    return $concat;
}

function readDoc($filename) {
    if (file_exists($filename)) {

        if (($fh = fopen($filename, 'r+')) !== false) {

            $headers = fread($fh, 0xA00);

# 1 = (ord(n)*1) ; Document has from 0 to 255 characters
            $n1 = ( ord($headers[0x21C]) - 1 );

# 1 = ((ord(n)-8)*256) ; Document has from 256 to 63743 characters
            $n2 = ( ( ord($headers[0x21D]) - 8 ) * 256 );

# 1 = ((ord(n)*256)*256) ; Document has from 63744 to 16775423 characters
            $n3 = ( ( ord($headers[0x21E]) * 256 ) * 256 );

# (((ord(n)*256)*256)*256) ; Document has from 16775424 to 4294965504 characters
            $n4 = ( ( ( ord($headers[0x21F]) * 256 ) * 256 ) * 256 );

# Total length of text in the document
            $textLength = ($n1 + $n2 + $n3 + $n4);
            $extracted_plaintext = fread($fh, $textLength);

//        echo $extracted_plaintext;
//        echo nl2br($extracted_plaintext);
//        $extracted_plaintext = convert($extracted_plaintext);
//        
            $extracted_plaintext = iconv('', 'UTF-8//TRANSLIT//IGNORE', $extracted_plaintext);
            $extracted_plaintext = trim($extracted_plaintext);
//            if (($fp = fopen("doc.txt", 'r+')) !== false) {
//                echo 'write';
//                echo fwrite($fp, $extracted_plaintext, strlen($extracted_plaintext));
//                fclose($fp);
//            }

            return $extracted_plaintext;
        }
    }
}

 function read_doc2($filename) {
    $fileHandle = fopen($filename, "r");
    $line = @fread($fileHandle, filesize($filename));   
    $lines = explode(chr(0x0D),$line);
    $outtext = "";
    foreach($lines as $thisline)
      {
        $pos = strpos($thisline, chr(0x00));
        if (($pos !== FALSE)||(strlen($thisline)==0))
          {
          } else {
            $outtext .= $thisline." ";
          }
      }
     $outtext = preg_replace("/[^a-zA-Z0-9\s\,\.\-\n\r\t@\/\_\(\)]/","",$outtext);
    return $outtext;
}

function getRawWordText($filename) {
    if(file_exists($filename)) {
        if(($fh = fopen($filename, 'r')) !== false ) {
            $headers = fread($fh, 0xA00);
            $n1 = ( ord($headers[0x21C]) - 1 );// 1 = (ord(n)*1) ; Document has from 0 to 255 characters
            $n2 = ( ( ord($headers[0x21D]) - 8 ) * 256 );// 1 = ((ord(n)-8)*256) ; Document has from 256 to 63743 characters
            $n3 = ( ( ord($headers[0x21E]) * 256 ) * 256 );// 1 = ((ord(n)*256)*256) ; Document has from 63744 to 16775423 characters
            $n4 = ( ( ( ord($headers[0x21F]) * 256 ) * 256 ) * 256 );// 1 = (((ord(n)*256)*256)*256) ; Document has from 16775424 to 4294965504 characters
            $textLength = ($n1 + $n2 + $n3 + $n4);// Total length of text in the document
            $extracted_plaintext = fread($fh, $textLength);
            $extracted_plaintext = mb_convert_encoding($extracted_plaintext,'UTF-8');
             // if you want to see your paragraphs in a new line, do this
             // return nl2br($extracted_plaintext);
             return ($extracted_plaintext);
        } else {
            return false;
        }
    } else {
        return false;
    }  
}

$filename = __DIR__ . '\..\..\upload\LEI2T3.doc';
//$filename = __DIR__ . '\doc.txt';
//readDoc($filename);
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
             <?= read_doc2($filename) ?> 
           <textarea name="messege" id="messege"rows="30" ><?= readDoc($filename) ?> </textarea>
        </div>
        
    </body>
</html>