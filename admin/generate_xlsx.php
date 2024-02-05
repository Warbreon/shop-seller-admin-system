<?php
require_once '../libraries/phpspreadsheet/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

require "../db.php";

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A1', 'User ID');
$sheet->setCellValue('B1', 'User Name');
$sheet->setCellValue('C1', 'User Fullname');
$sheet->setCellValue('D1', 'User Group');

$sql = "SELECT * FROM users WHERE user_group = 'p'";
$result = mysqli_query($conn, $sql);

// FILLING TABLE WITH DUOMENYS
$rowIndex = 2;
while ($row = mysqli_fetch_assoc($result)) {
    $sheet->setCellValue('A'.$rowIndex, $row['user_id']);
    $sheet->setCellValue('B'.$rowIndex, $row['user_name']);
    $sheet->setCellValue('C'.$rowIndex, $row['user_fullname']);
    $sheet->setCellValue('D'.$rowIndex, $row['user_group']);
    $rowIndex++;
}

$sheet->setAutoFilter($sheet->calculateWorksheetDimension());

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="generatedXLSX.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
?>
