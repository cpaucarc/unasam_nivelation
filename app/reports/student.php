<?php
include_once '../../dirs.php';
require_once(DB_PATH . "MySqlConnection.php");
require_once(UTIL_PATH . "PDF.php");
require_once(REPORT_PATH . "class/PDF_Student.php");

if (isset($_POST['studentPdf'])) {

    $studentPdf = intval($_POST['studentPdf']);

    if ($studentPdf > 0) {
        $pdf = new PDF('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $conn = (new MySqlConnection())->getConnection();

        $pdfStudent = new PDF_Student($pdf);

        //Report header
        $pdf->HeaderReport($pdf->GetY());
        //Proceso:

        $pdf->ProcessHeader(102, "Reporte Individual del estudiante ", '');


        $sql = "SELECT lastname, name, code, dni, program, process, omg, score FROM vstudents WHERE id = " . $studentPdf;
        $response = $conn->query($sql);
        $student = $response->fetch();

        $pdfStudent->StudenteHeader($student['lastname'], $student['name'], $student['code'], $student['dni'], $student['program'], $student['process'], $student['omg'], $student['score']);

        $pdfStudent->tableHeader();

        $sql = "CALL spShowStudentCourses(" . $studentPdf . ");";

        $courses = $conn->query($sql);
        //$response = $conn->query($sql);
        foreach ($courses as $i => $row) {
            $pdfStudent->tableBody(($i + 1), $row['course'], $row['percent'], $row['amount'], $row['stat']);
        }

        $pdf->Ln(5);

        $pdf->SetTextColor(86, 97, 108);
        $pdf->SetFont('Helvetica', '', $pdfStudent->fontSizeTableBody - 1);
        $pdf->Cell(0, 4, utf8_decode("*\t\tRepresenta al porcentaje de respuestas correctas que se tuvo sobre dicho curso durante el desarrollo del examen."), 0, 1, 'L');
        $pdf->Cell(0, 4, utf8_decode("**\t\tRepresenta al número de respuestas correctas que se tuvo sobre dicho curso durante el desarrollo del examen."), 0, 1, 'L');


        $pdf->Output();
    } else {
        header("Location: error");
    }
} else {
    header("Location: error");
}
