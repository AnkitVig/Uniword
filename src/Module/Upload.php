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
                    $file_name= 'downloaded.xlsx';
                    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                    header('Content-Disposition: attachment;filename=' . $file_name);
                    header('Cache-Control: max-age=0');
                    $writer =\PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
                    $writer->save($file_name);
                    echo '<a href="downloaded.xlsx" >Download</a><br/>';
                   // unlink($file_name);
                    exit;

                } elseif (in_array($fileExtension, $wordExtension)){
                    $phpWord = IOFactoryWord::createReader('Word2007')->load($_FILES['filename']['tmp_name']);
                    $text = [];
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

                    echo '<div align="center"> <textarea readonly placeholder="noticeboard" cols="50" rows="15">';
                    foreach ($text as $key) {
                        echo $key;

                    }
                    echo '</textarea> </div>';
                    $file_name= 'downloaded.docx';
                    header('Content-Type: application/txt');
                    header('Content-Disposition: attachment;filename=' . $file_name);
                    header('Cache-Control: max-age=0');
                    $writer =IOFactoryWord::createWriter($phpWord, 'Word2007');
                    $writer->save($file_name);
                    echo '<a href="downloaded.docx" >Download</a><br/>';
                    exit;
                } else {
                    $message = '<div class="alertMsg">Invalid file: allowed ectensions : (doc, docx, xls, xlsx)</div>';
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

?>