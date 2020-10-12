<?php
namespace Uniword\Module;
require_once "../vendor/autoload.php";


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;



class Download
{
    function downloadFile()
    {
        $db = new \Uniword\Database\DBConnect();
        $connect = $db->connectDB();
        $connect = $db->connectDB();


        $query_students = 'SELECT * FROM Student ORDER BY student_id';
        $student_statement = $connect->prepare($query_students);
        $student_statement->execute();
        $students = $student_statement->fetchAll();

        $student_statement->closeCursor();
        $spreadsheet = new Spreadsheet();

        $Excel_writer = new Xlsx($spreadsheet);

        $spreadsheet->setActiveSheetIndex(0);
        $activeSheet = $spreadsheet->getActiveSheet();

        $activeSheet->setCellValue('A1', 'ID');
        $activeSheet->setCellValue('B1', 'Name');
        $activeSheet->setCellValue('C1', 'Email');
        $activeSheet->setCellValue('D1', 'Street');
        $activeSheet->setCellValue('E1', 'City');
        $activeSheet->setCellValue('F1', 'State');
        $activeSheet->setCellValue('G1', 'Zip');
        $activeSheet->setCellValue('H1', 'Phone');
        $activeSheet->setCellValue('I1', 'Birth Date');
        $activeSheet->setCellValue('J1', 'Sex');
        $activeSheet->setCellValue('K1', 'Date Entered');
        $activeSheet->setCellValue('L1', 'Lunch Cost');




        if ( count($students) > 0) {
            $i = 2;
            foreach($students as $student){
                $activeSheet->setCellValue('A' . $i, $student['student_id']);
                $activeSheet->setCellValue('B' . $i, $student['first_name']);
                $activeSheet->setCellValue('C' . $i, $student['email']);
                $activeSheet->setCellValue('C' . $i, $student['email']);
                $activeSheet->setCellValue('D' . $i, $student['street']);
                $activeSheet->setCellValue('E' . $i, $student['city']);
                $activeSheet->setCellValue('F' . $i, $student['state']);
                $activeSheet->setCellValue('G' . $i, $student['zip']);
                $activeSheet->setCellValue('H' . $i, $student['phone']);
                $activeSheet->setCellValue('I' . $i, $student['birth_date']);
                $activeSheet->setCellValue('J' . $i, $student['date_entered']);
                $activeSheet->setCellValue('K' . $i, $student['lunch_cost']);
                $i++;
            }
        }

        $spreadsheet->setActiveSheetIndex(0);
        $file_name= 'students.xlsx';
// Redirect output to a client's web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="simple.xlsx"');
        header('Cache-Control: max-age=0');

        $writer =\PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
    //    $writer->save('php://output');
        $writer->save($file_name);
        header('Content-Type: application/x-www-form-urlencoded');

        header('Content-Transfer-Encoding: Binary');

        header("Content-disposition: attachment; filename=\"".$file_name."\"");

        readfile($file_name);

        unlink($file_name);


        exit;
    }
}