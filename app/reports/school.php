<?php
include_once '../../dirs.php';
require_once(DB_PATH . "MySqlConnection.php");
require_once(UTIL_PATH . "PDF.php");

if (isset($_POST['scAREAPDF']) && isset($_POST['scSCHOOLPDF']) && isset($_POST['scPROCESSPDF'])) {

    $scAREA = $_POST['scAREAPDF'];
    $scSCHOOL = $_POST['scSCHOOLPDF'];
    $scPROCESS = $_POST['scPROCESSPDF'];

    $heightTitleCell = 8;
    $fontSizeTitle = 13;
    $fontSizeSubtitle = 8;

    $width1C = 10;
    $width2C = 25;
    $width3C = 50;
    $width4C = 80;
    $heightTableCell = 8;
    $cellLineWidth = 0.05;
    $fontSizeTableHeader = 9;
    $fontSizeTableBody = 9;

    if ($scAREA != '' && $scSCHOOL != '' && $scPROCESS != '') {
        $pdf = new PDF('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $conn = (new MySqlConnection())->getConnection();

        //Title of document
        $pdf->SetFont('Helvetica', 'B', 15);
        $pdf->Cell(0, 10, 'Reporte General por curso', 0, 0, 'C', 0);
        $pdf->Ln(20);

        /* $sql = "SELECT * FROM vstudents WHERE id = " . $stdID;
        $response = $conn->query($sql);
        $student = $response->fetch(); */

        $pdf->SetTextColor(33, 37, 41);
        $pdf->SetFont('Helvetica', '', $fontSizeTitle);
        $pdf->Cell(0, $heightTitleCell, utf8_decode(strtoupper($scSCHOOL)), 0, 1, 'L');
        $pdf->Ln(2);
        $pdf->SetFont('Helvetica', 'B', $fontSizeSubtitle);
        $pdf->Cell(15, $heightTitleCell - 2, utf8_decode('Area: '), 0, 0, 'L');
        $pdf->SetFont('Helvetica', '', $fontSizeSubtitle);
        $pdf->Cell(80, $heightTitleCell - 2, utf8_decode($scAREA), 0, 0, 'L');
        $pdf->SetFont('Helvetica', 'B', $fontSizeSubtitle);
        $pdf->Cell(20, $heightTitleCell - 2, utf8_decode('Proceso: '), 0, 0, 'L');
        $pdf->SetFont('Helvetica', '', $fontSizeSubtitle);
        $pdf->Cell(0, $heightTitleCell - 2, utf8_decode($scPROCESS), 0, 1, 'L');

        $pdf->Ln(10);
        $pdf->SetFont('Helvetica', '', $fontSizeSubtitle + 2);
        $pdf->Cell(40, $heightTitleCell - 2, utf8_decode('Estudiantes '), 0, 0, 'L');
        $pdf->Ln(10);

        //Table Header
        $pdf->SetDrawColor(222, 226, 230);
        $pdf->SetLineWidth($cellLineWidth);
        $pdf->SetFillColor(233, 236, 239);
        $pdf->SetFont('Helvetica', 'B', $fontSizeTableHeader);
        $pdf->Cell($width1C, $heightTableCell, '#', 1, 0, 'C', 1);
        $pdf->Cell($width3C, $heightTableCell, 'DNI', 1, 0, 'L', 1);
        $pdf->Cell($width3C, $heightTableCell, utf8_decode('Código'), 1, 0, 'L', 1);
        $pdf->Cell($width4C, $heightTableCell, 'Alumno **', 1, 1, 'L', 1);;

        $sql = "call spShowStudentsBySchool('" . $scSCHOOL . "', '" . $scPROCESS . "');";
        $std = $conn->query($sql);
        $num = 1;
        //$response = $conn->query($sql);
        foreach ($std as $row) {
            $pdf->SetTextColor(73, 80, 87);
            $pdf->SetFont('Helvetica', 'B', $fontSizeTableBody);
            $pdf->Cell($width1C, $heightTableCell, $num, 1, 0, 'C');
            $pdf->SetTextColor(33, 37, 41);
            $pdf->SetFont('Helvetica', '', $fontSizeTableBody);
            $pdf->Cell($width3C, $heightTableCell, utf8_decode($row['dni']), 1, 0, 'L');
            $pdf->Cell($width3C, $heightTableCell, utf8_decode($row['code']), 1, 0, 'L');
            $pdf->Cell($width4C, $heightTableCell, utf8_decode($row['lastname'] . ' ' . $row['name']), 1, 1, 'L');
            $num++;
        }

        $pdf->Ln(5);

        $pdf->SetTextColor(86, 97, 108);
        $pdf->SetFont('Helvetica', '', $fontSizeTableBody - 2);
        $pdf->Cell(0, 4, utf8_decode("**\t Alumnos por escuela seleccionada."), 0, 1, 'L');


        $pdf->Output();
    } else {
        header("Location: error");
    }
} else {
    header("Location: error");
}
