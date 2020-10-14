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


    if (isset($_POST['file_name'])) {
        $createFile = new \Uniword\Module\CreateFile();
        $createFile->createFile($_POST['file_name'],$_POST['file_type'],$_POST['content']);
    }
    if (isset($_GET['fileList'])) {
        $display = new \Uniword\Module\DisplayFileList();
        $display->displayFileList();
        unset($_GET);
    }


?>
