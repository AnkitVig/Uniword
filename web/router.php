<?php
// ==========================================================================
// Project: UniWord
// ==========================================================================

/**
 * Class is used to fetch data from defferent server files.
 */

require_once __DIR__ . '/../vendor/autoload.php';

    if( isset($_FILES['filename']['name']) != '' ) {
        $readFile = new \Uniword\Module\Upload();
        $readFile->readFile();
    }

    if (isset($_POST['first_name'])) {
        $addStudent = new \Uniword\Database\Addstudent();
        $addStudent->generateQuery();
    }

    if (isset($_GET)) {
        $download = new \Uniword\Module\Download();
        $download->downloadFile();
    }



?>
