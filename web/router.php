<?php
// ==========================================================================
// Project: UniWord
// ==========================================================================

/**
 * Class is used to fetch data from defferent server files.
 */

require_once __DIR__ . '/../vendor/autoload.php';

if( isset($_FILES['filename']['name']) != '' ) {
        $file = $_FILES['filename'];
        $excel_extension = array('xls', 'xlsx');
        $word_extension = array('doc', 'docx');
        if ($_FILES["filename"]["name"] != '') {
            $file_array = explode(".", $_FILES['filename']['name']);
            $file_extension = end($file_array);

        }
        if (in_array($file_extension, $excel_extension)) {
            $spreadsheet = new \Uniword\Module\Upload();
            $spreadsheet->readFile();

        }
        if (in_array($file_extension, $word_extension)) {
            $word = new \Uniword\Module\Readword();
            $word->readFile();
        }
    }
    if (isset($_POST['Add'])) {
        $addsstudent = new Addsstudent();
    }

?>
