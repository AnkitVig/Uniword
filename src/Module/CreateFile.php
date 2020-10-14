<?php

/*
 * File to create a new excel or word file using Phpword and PhpSpreadSheet
 */
namespace Uniword\Module;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpWord\IOFactory as IOFactoryWord;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpWord;

class CreateFile
{
    public function createFile($fileName, $fileType, $content)
    {
     $file = $fileName . $fileType;
        $excelExtension = array('.xls', '.xlsx');
        $wordExtension = array('.doc', '.docx');
        if (in_array($fileType, $excelExtension))
        {
            $spreadsheet = new Spreadsheet();

            $Excel_writer = new Xlsx($spreadsheet);

            $spreadsheet->setActiveSheetIndex(0);
            $activeSheet = $spreadsheet->getActiveSheet();

            $activeSheet->setCellValue('A1', $content);

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename=' . $file);
            header('Cache-Control: max-age=0');
            $writer =\PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save("Files/".$file);
            echo '<br><div class="okMsg">'.$file .' File created</div><a href="Files/'.$file .'" >Download</a><br/>';
            // unlink($file_name);
            $currentData=file_get_contents("Files/fileList.json");
            $arrayData=json_decode($currentData, true);

            $extra=array(
                'fileName' =>  $file,
                'filePath' => 'Files/'.$file
            );
            if (!is_array($arrayData))
            {
                $arrayData[] = $extra;
            }
            else{
                if(!in_array($extra, $arrayData)) {
                    $arrayData[] = $extra;
                }
            }


            $json= json_encode($arrayData);

            file_put_contents("Files/fileList.json", $json);
            exit;
        }
        elseif (in_array($fileType, $wordExtension))
        {
            $phpWord = new \PhpOffice\PhpWord\PhpWord();
            $section = $phpWord->addSection();
            $section->addText(
            $content
            );
            header('Content-Type: application/txt');
            header('Content-Disposition: attachment;filename=' . $file);
            header('Cache-Control: max-age=0');
            $writer =IOFactoryWord::createWriter($phpWord, 'Word2007');
            $writer->save("Files/".$file);
            echo '<br><div class="okMsg">'.$file .' File created</div><a href="Files/'.$file .'" >Download</a><br/>';
            $currentData=file_get_contents("Files/fileList.json");
            $arrayData=json_decode($currentData, true);

            $extra=array(
                'fileName' =>  $file,
                'filePath' => 'Files/'.$file
            );
            if (!is_array($arrayData))
            {
                $arrayData[] = $extra;
            }
            else{
                if(!in_array($extra, $arrayData)) {
                    $arrayData[] = $extra;
                }
            }


            $json= json_encode($arrayData);

            file_put_contents("Files/fileList.json", $json);
            exit;
        }
    }
}