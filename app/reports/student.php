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
        //======= ¿El reporte es del ultimo proceso de adminisión?
        $sql = "SELECT * FROM process ORDER BY id ASC LIMIT 1;";
        $response = $conn->query($sql);
        $process = $response->fetch();
        $pdf->ProcessHeader(102,"Reporte Individual del estudiante",$process['name']);


        $sql = "SELECT * FROM vstudents WHERE id = " . $studentPdf;
        $response = $conn->query($sql);
        $student = $response->fetch();

        $pdfStudent->StudenteHeader($student['lastname'], $student['name'], $student['code'], $student['dni'], $student['program'], $student['process'], $student['omg'], $student['omp']);

        $pdfStudent->tableHeader();

        $sql = "call spShowStudentCourses(" . $studentPdf . ");";

        $courses = $conn->query($sql);
        $num = 1;
        //$response = $conn->query($sql);
        foreach ($courses as $row) {
            $pdfStudent->tableBody($num, $row['course'], $row['percent'], $row['num'], $row['stat']);
            $num++;
        }

        $pdf->Ln(5);

        $pdf->SetTextColor(86, 97, 108);
        $pdf->SetFont('Helvetica', '', $pdfStudent->fontSizeTableBody -1);
        $pdf->Cell(0, 4, utf8_decode("*\t\tRepresenta al porcentaje de respuestas correctas que se tuvo sobre dicho curso durante el desarrollo del examen."), 0, 1, 'L');
        $pdf->Cell(0, 4, utf8_decode("**\t\tRepresenta al número de respuestas correctas que se tuvo sobre dicho curso durante el desarrollo del examen."), 0, 1, 'L');
        $pdf->Cell(0, 4, utf8_decode("**\tLa intervalo de valoración está establecida para cada curso en cada área."), 0, 1, 'L');


        $pdf->Output();
    } else {
        header("Location: error");
    }
} else {
    header("Location: error");
}
