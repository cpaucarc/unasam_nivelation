<?php
include_once '../../dirs.php';
require_once(DB_PATH . "MySqlConnection.php");
require_once(UTIL_PATH . "PDF.php");
require_once(REPORT_PATH . "class/PDF_Template.php");

if (isset($_POST['processPDF']) and intval($_POST['processPDF']) > 0) {

    $processID = $_POST['processPDF'];
    $areaID = $_POST['areaPDF'];
    $dimensionID = $_POST['dimensionPDF'];

    $pdf = new PDF('P', 'mm', 'Letter');
    $pdf->AliasNbPages();
    $conn = (new MySqlConnection())->getConnection();
    $pdf_DIM = new PDF_Template($pdf);

    $pdf->SetTextColor(86, 97, 108);
    $pdf->SetFont('Helvetica', '', $pdf_DIM->fontSizeTableBody + 1);
    $pdf->Cell(0, 5, utf8_decode("*\t\t Alumnos por dimensión/curso seleccionada."), 0, 1, 'L');
    $pdf->Cell(0, 5, utf8_decode("**\t Recomendación de alumnos por dimensión/curso seleccionada."), 0, 1, 'L');
    $pdf->Output();
} else {
    header("Location: error");
}
