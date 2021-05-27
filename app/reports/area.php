<?php
include_once '../../dirs.php';
require_once(DB_PATH . "MySqlConnection.php");
require_once(UTIL_PATH . "PDF.php");
require_once(REPORT_PATH . "class/PDF_Area.php");

if (isset($_POST['processPdf'])) {

    $areaPdf = $_POST['areaPdf'] ?? '';
    $processPdf = $_POST['processPdf'];

    $pdf = new PDF('P', 'mm', 'A4');
    $pdf->AliasNbPages();
    $conn = (new MySqlConnection())->getConnection();
    $pdfArea = new PDF_Area($pdf);

    //Areas
    if ($areaPdf != '') {
        $sql = "SELECT * FROM areas WHERE name='$areaPdf';";
    } else {
        $sql = "SELECT * FROM areas";
    }
    $response = $conn->query($sql);

    foreach ($response as $row1) {
        $pdf->AddPage();
        //Programs

        //Report header
        $pdf->HeaderReport($pdf->GetY());

        //Proceso:
        $pdf->ProcessHeader(73, "Reporte por áreas", $processPdf);
        $pdf->AreaHeader($row1['name'], $row1['description']);
        $pdf->Ln(10);
        $area = $row1['name'];
        $sql = "SELECT 
        id, code, name, lastname, score, program, area, process, 
        if (score < (SELECT percent*4 FROM process WHERE name = '$processPdf'), 3, 1) stat, 
        if (score < (SELECT percent*4 FROM process WHERE name = '$processPdf'), 'Requiere nivelacion obligatorio', 'No requiere nivelacion') recomendation 
        FROM vstudents WHERE area ='$area' and 
            process = '$processPdf' AND 
            score < (SELECT percent*4 FROM process WHERE name = '$processPdf') 
        ORDER BY program ASC, lastname ASC";

        $result = $conn->query($sql);
        //Table Header
        $pdfArea->TableHeader();
        //Table body            
        if ($result->rowCount() > 0) {
            foreach ($result as $i => $row2) {
                $pdfArea->TableBody(($i + 1),$row2['code'],$row2['name'],$row2['lastname'],$row2['score'],$row2['program'],$row2['recomendation']);
            }
        } else {
            $pdfArea->TableBody('--','--','--','--','--','--','--');
        }
        $pdf->Ln(5);
    }
    $pdf->Ln(10);
    $pdf->SetTextColor(86, 97, 108);
    $pdf->SetFont('Helvetica', '', $pdfArea->fontSizeTableBody + 1);
    $pdf->Cell(0, 5, utf8_decode("*\t\t\t Puntaje del estudiante en el proceso de admisión."), 0, 1, 'L');
    $pdf->Output();
} else {
    header("Location: error");
}
