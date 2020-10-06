<?php
$target_dir = "uploads/";
$filename = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
echo "file Uploaded"
echo $filename;

$phpWord = \PhpOffice\PhpWord\IOFactory::load($filename);

                $sections = $phpWord->getSections();
                foreach ($sections as $key => $value) {
                    $sectionElement = $value->getElements();
                    foreach ($sectionElement as $elementKey => $elementValue) {
                        if ($elementValue instanceof \PhpOffice\PhpWord\Element\TextRun) {
                            $secondSectionElement = $elementValue->getElements();
                            foreach ($secondSectionElement as $secondSectionElementKey => $secondSectionElementValue) {
                                if ($secondSectionElementValue instanceof \PhpOffice\PhpWord\Element\Text) {
                                    echo $secondSectionElementValue->getText();
                                    echo "<br>";
                                }
                            }
                        }
                    }
                }

?>