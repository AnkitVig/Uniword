<?php
// ==========================================================================
// Project: UniWord
// ==========================================================================

/**
 * Class to Download the data entered by the user and stored in the database.
 */
namespace Uniword\Module;
require_once "../vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class DownloadFile
{
    function downloadFile($spreadsheet)
    {
//        $readFile = new Upload();
//        $sp = $readFile->readFile();
        echo $spreadsheet;
    }
}