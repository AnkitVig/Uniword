<?php

/*
 * File to load excel file in browser using Excel Spread Sheet.
 */
namespace Uniword\Module;

    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;

    class Upload
    {
        public function readFile()
        {
            if ($_FILES["filename"]["name"] != '') {
                $allowed_extension = array('xls', 'xlsx');
                $file_array = explode(".", $_FILES['filename']['name']);
                $file_extension = end($file_array);
                if (in_array($file_extension, $allowed_extension)) {
                    $reader = IOFactory::createReader('Xlsx');
                    $spreadsheet = $reader->load($_FILES['filename']['tmp_name']);
                    $writer = IOFactory::createWriter($spreadsheet, 'Html');
                    $message = $writer->save('php://output');
                } else {
                    $message = '<div class="alert alert-danger">Only .xls or .xlsx file allowed</div>';
                }
            } else {
                $message = '<div class="alert alert-danger">Please Select File</div>';
            }
            echo $message;
        }
    }






?>