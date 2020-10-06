<?php
include '../vendor/autoload.php';

use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord;


if($_FILES["filename"]["name"] != '')
{
    $allowed_extension = array('docx', 'doc');
    $file_array = explode(".", $_FILES['filename']['name']);
    $file_extension = end($file_array);
    if(in_array($file_extension, $allowed_extension))
    {
        $reader = IOFactory::createReader('Word2007');
        $word = $reader->load($_FILES['filename']['tmp_name']);
        $writer = IOFactory::createWriter($word, 'Word2007');
        $writer->save('php://output');
        $message = readfile('php://output');

    }
    else
    {
        $message = '<div class="alert alert-danger">Only .doc or .docx file allowed</div>';
    }
}
else
{
    $message = '<div class="alert alert-danger">Please Select File</div>';
}

echo $message;

?>