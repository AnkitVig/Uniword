<?php

/*
 * File to load excel file in browser using Excel Spread Sheet.
 */
namespace Uniword\Module;

    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpWord\IOFactory as IOFactory2;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpWord;


    class Upload
    {
        public function readFile()
        {
            if ($_FILES["filename"]["name"] != '') {
                $excelExtension = array('xls', 'xlsx');
                $wordExtension = array('doc', 'docx');
                $file_array = explode(".", $_FILES['filename']['name']);
                $file_extension = end($file_array);
                if (in_array($file_extension, $excelExtension)) {
                    $reader = IOFactory::createReader('Xlsx');
                    $reader->setReadDataOnly(true);
                    $spreadsheet = $reader->load($_FILES['filename']['tmp_name']);
                    $writer = IOFactory::createWriter($spreadsheet, 'Html');
                    $message = $writer->save('php://output');
                    exit;
                    echo $message;
                } elseif (in_array($file_extension, $wordExtension)){
                    $phpWord = IOFactory2::createReader('Word2007')->load($_FILES['filename']['tmp_name']);
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

                    echo '<div align="center"> <textarea placeholder="noticeboard" cols="50" rows="15">';
                    foreach ($text as $key) {
                        echo $key;
                        exit;
                    }
                    echo '</textarea> </div>';
                } else {
                    $message = '<div class="alertMsg">Only .xls or .xlsx file allowed</div>';
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