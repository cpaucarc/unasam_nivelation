<?php
include_once '../../dirs.php';
require_once(DB_PATH . "MySqlConnection.php");
require_once(UTIL_PATH . "PDF.php");
require_once(REPORT_PATH . "class/PDF_Course.php");

if (isset($_POST['processPdf'])) {

    $areaPdf = $_POST['areaPdf'] ?? '';
    $dimensionPdf = $_POST['dimensionPdf'] ?? '';
    $coursePdf = $_POST['coursePdf'] ?? '';
    $processPdf = $_POST['processPdf'];

    $pdf = new PDF('P', 'mm', 'A4');
    $pdf->AliasNbPages();
    $conn = (new MySqlConnection())->getConnection();
    $pdfCourse = new PDF_Course($pdf);

    //Áreas
    if ($areaPdf != '') {
        $sql = "SELECT * FROM areas WHERE name='$areaPdf';";
    } else {
        $sql = "SELECT * FROM areas";
    }
    $response = $conn->query($sql);

    foreach ($response as $row1) {
        $pdf->AddPage();
        
        //Report header
        $pdf->HeaderReport($pdf->GetY());

        //Proceso:
        $pdf->ProcessHeader(63, "Reporte por cursos", $processPdf);
        $pdf->AreaHeader($row1['name'], $row1['description']);

        //Escuelas
        if ($areaPdf != '' && $dimensionPdf != '') {
            $sql = "SELECT *  FROM dimensions  WHERE name='$dimensionPdf'";
        } else {
            $sql = "SELECT *  FROM dimensions";
        }
        $std = $conn->prepare($sql);
        $std->execute();
        $rst = $std->fetchAll();
        foreach ($rst as $row2) {

            /*  $pdfCourse->programHeader($row2['name']); */

            if ($areaPdf != '' && $dimensionPdf != '') {
                $sql = "SELECT * FROM vcourses WHERE dimension='" . $dimensionPdf . "'";
            } else {
                $sql = "SELECT * FROM vcourses WHERE dimension='" . $row2['name'] . "'";
            }
            if ($areaPdf != '' && $dimensionPdf != '' && $coursePdf != '') {
                $sql = "SELECT * FROM vcourses WHERE dimension='" . $dimensionPdf . "' AND course='" . $coursePdf . "'";
            }
            $result = $conn->prepare($sql);
            $result->execute();
            $rs = $result->fetchAll();

            foreach ($rs as $row3) {
                $pdfCourse->DimensionCourse($row2['name'], $row3['course']);
                //Tabla
                if ($areaPdf != '' && $dimensionPdf != '' && $coursePdf != '') {
                    $sql = "call spShowStudentsByCourse('" . $areaPdf . "','" . $coursePdf . "','" . $processPdf . "');";
                } else {
                    $sql = "call spShowStudentsByCourse('" . $row1['name'] . "','" . $row3['course'] . "','" . $processPdf . "');";
                }
                $consulta = $conn->prepare($sql);
                $consulta->execute();
                $resultado = $consulta->fetchAll();

                //Table Header
                $pdfCourse->tableHeader();
                //Table body            
                if ($consulta->rowCount() > 0) {
                    $num = 1;
                    foreach ($resultado as $row4) {
                        $pdfCourse->tableBody($num, $row4['code'], $row4['lastname'], $row4['name'], $row4['program'], $row4['stat']);
                        $num++;
                    }
                } else {
                    $pdfCourse->tableBody('..', '..', '.', '.', '..', '..');
                }
                $pdf->Ln(5);
            }
        }
        $pdf->Ln(10);
    }

    $pdf->SetTextColor(86, 97, 108);
    $pdf->SetFont('Helvetica', '', $pdfCourse->fontSizeTableBody + 1);
    $pdf->Cell(0, 5, utf8_decode("*\t\t Alumnos por dimensión/curso seleccionada."), 0, 1, 'L');
    $pdf->Cell(0, 5, utf8_decode("**\t Recomendación de alumnos por dimensión/curso seleccionada."), 0, 1, 'L');
    $pdf->Output();
} else {
    header("Location: error");
}
