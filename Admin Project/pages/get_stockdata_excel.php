<?php
require_once("../includes/db_connection.php");
require_once("../includes/functions.php");
require_once './../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$sql = "SELECT * FROM product_stock_information ORDER BY product_id DESC";
$query = $con->query($sql);

// Create a new Excel file and set up the worksheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set the column headers in the Excel file
$sheet->setCellValue('A1', 'Product ID');
$sheet->setCellValue('B1', 'Product Name');
$sheet->setCellValue('C1', 'Total Sold');
$sheet->setCellValue('D1', 'Total Purchased');
$sheet->setCellValue('E1', 'Available Stock');

// Set the data rows in the Excel file
$row = 2; // Start from row 2 (below the header)
while ($data = $query->fetch_assoc()) {
    $sheet->setCellValue('A' . $row, $data["product_id"]);
    $sheet->setCellValue('B' . $row, $data["product_name"]);
    $sheet->setCellValue('C' . $row, $data["total_sold_quantity"]);
    $sheet->setCellValue('D' . $row, $data["total_buy_quantity"]);
    $sheet->setCellValue('E' . $row, intval($data["total_stock"]));
    $row++;
}

// Create a new Excel file and save it
$writer = new Xlsx($spreadsheet);
$filename = 'product_stock_details.xlsx';
$writer->save($filename);

// Download the Excel file
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Cache-Control: max-age=0');
$writer->save('php://output');
exit;

?>