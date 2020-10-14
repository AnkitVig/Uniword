<?php

/*
 * File to load excel file in browser using Excel Spread Sheet.
 */
namespace Uniword\Module;

    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpWord\IOFactory as IOFactoryWord;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpWord;


    class Upload
    {
        public function readFile()
        {
            if ($_FILES["filename"]["name"] != '') {
                $excelExtension = array('xls', 'xlsx');
                $wordExtension = array('doc', 'docx');
                $fileArray = explode(".", $_FILES['filename']['name']);
                $fileExtension = end($fileArray);


                if (in_array($fileExtension, $excelExtension)) {
                    $reader = IOFactory::createReader('Xlsx');
                    $reader->setReadDataOnly(true);
                    $spreadsheet = $reader->load($_FILES['filename']['tmp_name']);
                    $writer = IOFactory::createWriter($spreadsheet, 'Html');
                    $message = $writer->save('php://output');
                    echo $message;
                    //exit;
                    $fileName= $_FILES['filename']['name'];

                    $writer =\PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
                    $writer->save("Files/".$fileName);
                    echo '<br><br><a href="Files/'.$fileName .'" >Download</a><br/>';
                   // unlink($file_name);

                    $currentData=file_get_contents("Files/fileList.json");
                    $arrayData=json_decode($currentData, true);

                    $extra=array(
                        'fileName' =>  $fileName,
                       'filePath' => 'Files/'.$fileName
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

                } elseif (in_array($fileExtension, $wordExtension)){
                    $phpWord = IOFactoryWord::createReader('Word2007')->load($_FILES['filename']['tmp_name']);
                    $writer = IOFactoryWord::createWriter($phpWord, 'HTML');
                    $message = $writer->save('php://output');

                    echo $message;

                    $fileName= $_FILES['filename']['name'];

                    $writer =IOFactoryWord::createWriter($phpWord, 'Word2007');
                    $writer->save("Files/".$fileName);
                    echo '<br><br><a href="Files/'.$fileName .'" >Download</a><br/>';

                    $currentData=file_get_contents("Files/fileList.json");
                    $arrayData=json_decode($currentData, true);

                    $extra=array(
                        'fileName' =>  $fileName,
                        'filePath' => 'Files/'.$fileName
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
                } else {
                    $message = '<div class="alertMsg">Invalid file: allowed extensions : (doc, docx, xls, xlsx)</div>';
                    echo $message;
                    exit;
                }
            } else {
                $message = '<div class="alertMsg">Please Select File</div>';
                echo $message;
                exit;
            }

        }
    }

