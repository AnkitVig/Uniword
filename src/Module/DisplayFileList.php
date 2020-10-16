<?php

/*
 * Class to display list of all the files uploaded and created by the user.
 */
namespace Uniword\Module;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpWord\IOFactory as IOFactoryWord;

class DisplayFileList
{
    public function displayFileList()
    {
        $currentData=file_get_contents("Files/fileList.json");
        $arrayData=json_decode($currentData, true);


        if(is_array($arrayData))
        {
        foreach($arrayData as $key=>$val)
        {
            echo  $val['fileName'].",";

        }}

    }

    public function viewFile($fileDisplay)
    {
        $filePath = "Files/".$fileDisplay;
        if ($fileDisplay != '') {
            $excelExtension = array('xls', 'xlsx');
            $wordExtension = array('doc', 'docx');
            $fileArray = explode(".",$fileDisplay);
            $fileExtension = end($fileArray);


            if (in_array($fileExtension, $excelExtension)) {
                $reader = IOFactory::createReader('Xlsx');
                $reader->setReadDataOnly(true);
                $spreadsheet = $reader->load($filePath);
                $writer = IOFactory::createWriter($spreadsheet, 'Html');
                $message = $writer->save('php://output');
                echo $message;

                echo '<br><br><a href="Files/'.$fileDisplay .'" >Download</a><br/>';
                // unlink($file_name);

                exit;

            } elseif (in_array($fileExtension, $wordExtension)){
                $phpWord = IOFactoryWord::createReader('Word2007')->load($filePath);
                $writer = IOFactoryWord::createWriter($phpWord, 'HTML');
                $message = $writer->save('php://output');

                echo $message;
                echo '<br><br><a href="Files/'.$fileDisplay .'" >Download</a><br/>';


                exit;
            }
    }}
}