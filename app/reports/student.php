<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(DB_PATH . "MySqlConnection.php");
require_once(UTIL_PATH . "PDF.php");

if (isset($_POST['stdIDPDF'])) {

    $stdID = intval($_POST['stdIDPDF']);

    $heightTitleCell = 8;
    $fontSizeTitle = 13;
    $fontSizeSubtitle = 8;

    $width1C = 10;
    $width2C = 60;
    $width3C = 45;
    $width4C = 75;
    $heightTableCell = 8;
    $cellLineWidth = 0.05;
    $fontSizeTableHeader = 9;
    $fontSizeTableBody = 9;

    if ($stdID > 0) {
        $pdf = new PDF('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $conn = (new MySqlConnection())->getConnection();

//Title of document
        $pdf->SetFont('Helvetica', 'B', 15);
        $pdf->Cell(0, 10, 'Reporte Individual del estudiante', 0, 0, 'C', 0);
        $pdf->Ln(20);

        $sql = "SELECT * FROM vstudents WHERE id = " . $stdID;
        $response = $conn->query($sql);
        $student = $response->fetch();

        $pdf->SetTextColor(33, 37, 41);
        $pdf->SetFont('Helvetica', '', $fontSizeTitle);
        $pdf->Cell(0, $heightTitleCell, utf8_decode(strtoupper($student['lastname'] . ' ' . $student['name'])), 0, 1, 'L');
        $pdf->Ln(2);
        $pdf->SetFont('Helvetica', 'B', $fontSizeSubtitle);
        $pdf->Cell(15, $heightTitleCell - 2, utf8_decode('Código: '), 0, 0, 'L');
        $pdf->SetFont('Helvetica', '', $fontSizeSubtitle);
        $pdf->Cell(80, $heightTitleCell - 2, utf8_decode($student['code']), 0, 0, 'L');
        $pdf->SetFont('Helvetica', 'B', $fontSizeSubtitle);
        $pdf->Cell(10, $heightTitleCell - 2, utf8_decode('DNI: '), 0, 0, 'L');
        $pdf->SetFont('Helvetica', '', $fontSizeSubtitle);
        $pdf->Cell(0, $heightTitleCell - 2, utf8_decode($student['dni']), 0, 1, 'L');
        $pdf->SetFont('Helvetica', 'B', $fontSizeSubtitle);
        $pdf->Cell(15, $heightTitleCell - 2, utf8_decode('Escuela: '), 0, 0, 'L');
        $pdf->SetFont('Helvetica', '', $fontSizeSubtitle);
        $pdf->Cell(80, $heightTitleCell - 2, utf8_decode(strtoupper($student['school'])), 0, 0, 'L');
        $pdf->SetFont('Helvetica', 'B', $fontSizeSubtitle);
        $pdf->Cell(32, $heightTitleCell - 2, utf8_decode('Proceso de Admisión: '), 0, 0, 'L');
        $pdf->SetFont('Helvetica', '', $fontSizeSubtitle);
        $pdf->Cell(0, $heightTitleCell - 2, utf8_decode($student['process']), 0, 1, 'L');

        $pdf->Ln(10);
        $pdf->SetFont('Helvetica', '', $fontSizeSubtitle + 2);
        $pdf->Cell(40, $heightTitleCell - 2, utf8_decode('Cursos '), 0, 0, 'L');
        $pdf->Ln(10);

//Table Header
        $pdf->SetDrawColor(222, 226, 230);
        $pdf->SetLineWidth($cellLineWidth);
        $pdf->SetFillColor(233, 236, 239);
        $pdf->SetFont('Helvetica', 'B', $fontSizeTableHeader);
        $pdf->Cell($width1C, $heightTableCell, '#', 1, 0, 'C', 1);
        $pdf->Cell($width2C, $heightTableCell, 'Curso', 1, 0, 'L', 1);
        $pdf->Cell($width3C, $heightTableCell, 'Respuestas Correctas *', 1, 0, 'L', 1);
        $pdf->Cell($width4C, $heightTableCell, utf8_decode('Valoración **'), 1, 1, 'L', 1);

        $sql = "call spShowCourses(" . $stdID . ");";
        $courses = $conn->query($sql);
        $num = 1;
//$response = $conn->query($sql);
        foreach ($courses as $row) {
            $pdf->SetTextColor(73, 80, 87);
            $pdf->SetFont('Helvetica', 'B', $fontSizeTableBody);
            $pdf->Cell($width1C, $heightTableCell, $num, 1, 0, 'C');
            $pdf->SetTextColor(33, 37, 41);
            $pdf->SetFont('Helvetica', '', $fontSizeTableBody);
            $pdf->Cell($width2C, $heightTableCell, utf8_decode($row['course']), 1, 0, 'L');
            $pdf->Cell($width3C, $heightTableCell, $row['percent'] . ' %', 1, 0, 'C');
            $pdf->Cell($width4C, $heightTableCell, utf8_decode($row['stat']), 1, 1, 'L');
            $num++;
        }

        $pdf->Ln(5);

        $pdf->SetTextColor(86, 97, 108);
        $pdf->SetFont('Helvetica', '', $fontSizeTableBody - 2);
        $pdf->Cell(0, 4, utf8_decode("*\t\tRepresenta al porcentaje de respuestas correctas que se tuvo sobre dicho curso durante el desarrollo del examen."), 0, 1, 'L');
        $pdf->Cell(0, 4, utf8_decode("**\tLa intervalo de valoración está establecida para cada curso en cada área."), 0, 1, 'L');


        $pdf->Output();

    } else {
        echo 'Error, no se ha especificado el estudiante';
        echo '</br>';
        echo '<a href="http://localhost/nivelation/bystudent.php">Volver</a>';
    }
} else {
    echo 'Error, no se ha especificado el estudiante.';
    echo '</br>';
    echo '<a href="http://localhost/nivelation/bystudent.php">Volver</a>';
}

?>


