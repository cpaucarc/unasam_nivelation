<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(DB_PATH . "MySqlConnection.php");
require_once(UTIL_PATH . "PDF.php");

$width1C = 7;
$width2C = 30;
$width3C = 50;
$width4C = 30;
$width5C = 30;
$heightCell = 6;
$cellLineWidth = 0.05;

$pdf = new PDF('P', 'mm', 'A4');
$pdf->AliasNbPages();
$pdf->AddPage();

//Title
$pdf->SetFont('Helvetica', '', 14);
//$pdf->Ln(10);

//$pdf->SetMargins(10, 44, 11.7);
$pdf->Cell(0, 10, 'Estudiantes Registrados en la Base de Datos', 1, 0, 'L', 0);
$pdf->Ln(15);

//Table Header
$pdf->SetTextColor(33, 37, 41);
$pdf->SetDrawColor(222, 226, 230);
$pdf->SetLineWidth($cellLineWidth);
$pdf->SetFillColor(233, 236, 239);
$pdf->SetFont('Helvetica', 'B', 8);
$pdf->Cell($width1C, $heightCell, '#', 1, 0, 'C', 1);
$pdf->Cell($width2C, $heightCell, 'Code', 1, 0, 'L', 1);
$pdf->Cell($width3C, $heightCell, 'Name', 1, 0, 'L', 1);
$pdf->Cell($width4C, $heightCell, 'School', 1, 0, 'L', 1);
$pdf->Cell($width5C, $heightCell, 'Proceso', 1, 1, 'L', 1);

//Table content


$num = 1;
$conn = (new MySqlConnection())->getConnection();
$sql = "SELECT code, concat(lastname, ' ', name) as student, school, process FROM vstudents;";

foreach ($conn->query($sql) as $row) {
    $pdf->SetTextColor(73, 80, 87);
    $pdf->SetFont('Helvetica', 'B', 7);
    $pdf->Cell($width1C, $heightCell, $num, 1, 0, 'C');
    $pdf->SetTextColor(33, 37, 41);
    $pdf->SetFont('Helvetica', '', 7);
    $pdf->Cell($width2C, $heightCell, utf8_decode($row['code']), 1, 0, 'L');
    $pdf->Cell($width3C, $heightCell, utf8_decode($row['student']), 1, 0, 'L');
    $pdf->Cell($width4C, $heightCell, utf8_decode($row['school']), 1, 0, 'L');
    $pdf->Cell($width5C, $heightCell, utf8_decode($row['process']), 1, 1, 'L');
    $num++;
}

$pdf->Output();

?>


