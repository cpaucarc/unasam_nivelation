<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(DB_PATH . "MySqlConnection.php");
require_once(UTIL_PATH . "PDF.php");

if (isset($_POST['csAREAPDF']) && isset($_POST['csCOURSEPDF']) && isset($_POST['csPROCESSPDF'])) {

    $csAREA = $_POST['csAREAPDF'];
    $csCOURSE = $_POST['csCOURSEPDF'];
    $csPROCESS = $_POST['csPROCESSPDF'];

    $heightTitleCell = 8;
    $fontSizeTitle = 13;
    $fontSizeSubtitle = 8;

    $width1C = 10;
    $width2C = 25;
    $width3C = 44;
    $width4C = 75;
    $heightTableCell = 8;
    $cellLineWidth = 0.05;
    $fontSizeTableHeader = 9;
    $fontSizeTableBody = 9;

    if ($csAREA != '' && $csCOURSE != '' && $csPROCESS != '') {
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
        $pdf->Cell(0, $heightTitleCell, utf8_decode(strtoupper($csCOURSE)), 0, 1, 'L');
        $pdf->Ln(2);
        $pdf->SetFont('Helvetica', 'B', $fontSizeSubtitle);
        $pdf->Cell(15, $heightTitleCell - 2, utf8_decode('Area: '), 0, 0, 'L');
        $pdf->SetFont('Helvetica', '', $fontSizeSubtitle);
        $pdf->Cell(80, $heightTitleCell - 2, utf8_decode($csAREA), 0, 0, 'L');
        $pdf->SetFont('Helvetica', 'B', $fontSizeSubtitle);
        $pdf->Cell(20, $heightTitleCell - 2, utf8_decode('Proceso: '), 0, 0, 'L');
        $pdf->SetFont('Helvetica', '', $fontSizeSubtitle);
        $pdf->Cell(0, $heightTitleCell - 2, utf8_decode($csPROCESS), 0, 1, 'L');

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
        $pdf->Cell($width2C, $heightTableCell, 'DNI', 1, 0, 'L', 1);
        $pdf->Cell($width2C, $heightTableCell,  utf8_decode('Código'), 1, 0, 'L', 1);
        $pdf->Cell($width3C, $heightTableCell, 'Alumno', 1, 0, 'L', 1);
        $pdf->Cell($width3C, $heightTableCell, 'Escuela', 1, 0, 'L', 1);
        $pdf->Cell($width3C, $heightTableCell, utf8_decode('Recomendación **'), 1, 1, 'L', 1);

        $sql = "CALL spShowStudentsByCourse('" . $csAREA . "', '" . $csCOURSE . "', '" . $csPROCESS . "');";

        $std = $conn->query($sql);
        $num = 1;
        //$response = $conn->query($sql);
        foreach ($std as $row) {
            $pdf->SetTextColor(73, 80, 87);
            $pdf->SetFont('Helvetica', 'B', $fontSizeTableBody);
            $pdf->Cell($width1C, $heightTableCell, $num, 1, 0, 'C');
            $pdf->SetTextColor(33, 37, 41);
            $pdf->SetFont('Helvetica', '', $fontSizeTableBody);
            $pdf->Cell($width2C, $heightTableCell, utf8_decode($row['dni']), 1, 0, 'L');
            $pdf->Cell($width2C, $heightTableCell, utf8_decode($row['code']), 1, 0, 'L');
            $pdf->Cell($width3C, $heightTableCell, utf8_decode($row['lastname'] . ' ' . $row['name']), 1, 0, 'L');
            $pdf->Cell($width3C, $heightTableCell, utf8_decode($row['school']), 1, 0, 'L');
            $pdf->Cell($width3C, $heightTableCell, utf8_decode($row['stat']), 1, 1, 'L');
            $num++;
        }

        $pdf->Ln(5);

        $pdf->SetTextColor(86, 97, 108);
        $pdf->SetFont('Helvetica', '', $fontSizeTableBody - 2);
        $pdf->Cell(0, 4, utf8_decode("**\tLa intervalo de valoración está establecida para cada curso en cada área."), 0, 1, 'L');


        $pdf->Output();
    } else {
        echo 'Error, no se ha especificado el datos para emprimir';
        echo '</br>';
        echo '<a href="http://localhost/nivelation/bystudent.php">Volver</a>';
    }
} else {
    echo 'Error, no se ha especificado el datos.';
    echo '</br>';
    echo '<a href="http://localhost/nivelation/bystudent.php">Volver</a>';
}
