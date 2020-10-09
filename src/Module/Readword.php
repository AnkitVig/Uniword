<?php
// ==========================================================================
// Project: UniWord
// ==========================================================================

/*
 * File to load excel file in browser using Word file.
 */
namespace Uniword\Module;

use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord;

class Readword{
    function readFile(){
        if ($_FILES["filename"]["name"] != '') {
            $allowed_extension = array('docx', 'doc');
            $file_array = explode(".", $_FILES['filename']['name']);
            $file_extension = end($file_array);
            if (in_array($file_extension, $allowed_extension)) {
                $phpWord = IOFactory::createReader('Word2007')->load($_FILES['filename']['tmp_name']);

                $text = [];


                /*
                 * Getting data of each section into array.
                 */
                foreach ($phpWord->getSections() as $section) {

                    foreach ($section->getElements() as $element) {

                        switch (get_class($element)) {
                            case 'PhpOffice\PhpWord\Element\Text' :
                                $text[] = $element->getText();
                                break;
                            case 'PhpOffice\PhpWord\Element\TextRun':
                                $textRunElements = $element->getElements();
                                foreach ($textRunElements as $textRunElement) {
                                    $text[] = $textRunElement->getText();
                                }
                                break;
                            case 'PhpOffice\PhpWord\Element\TextBreak':
                                $text[] = " ";
                                break;
                            default:
                                throw new Exception('Something went wrong...');
                        }
                    }
                }

            } else {
                $message = '<div class="alert alert-danger">Only .doc or .docx file allowed</div>';
            }
        } else {
            $message = '<div class="alert alert-danger">Please Select File</div>';
        }

        echo '<textarea>';
        foreach ($text as $key) {
            echo $key;
        }
        echo '</textarea>';
    }
}

?>