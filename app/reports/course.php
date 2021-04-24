<?php
include_once '../../dirs.php';
require_once(DB_PATH . "MySqlConnection.php");
require_once(UTIL_PATH . "PDF.php");
require_once(REPORT_PATH . "class/PDF_Course.php");

if (isset($_POST['processPdf'])) {

    $areaPdf = $_POST['areaPdf'];
    $dimensionPdf = $_POST['dimensionPdf'];
    $coursePdf = $_POST['coursePdf'];
    $processPdf = $_POST['processPdf'];

    $pdf = new PDF('P', 'mm', 'A4');
    $pdf->AliasNbPages();
    $pdf->AddPage();
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

        //Cabercera
        $pdfCourse->headerReport($pdf->GetY());
        //Proceso:
        $pdfCourse->processHeader("Reporte general por Cursos", $processPdf);
        $pdfCourse->areaHeader($row1['name'], $row1['description']);

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
            $result = $conn->prepare($sql);
            $result->execute();
            $rs = $result->fetchAll();

            foreach ($rs as $row3) {
                $pdfCourse->dimensionCourse($row2['name'], $row3['course']);
                //Tabla
                $sql = "call spShowStudentsByCourse('" . $row1['name'] . "','" . $row3['course'] . "','" . $processPdf . "');";
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
    $pdf->SetFont('Helvetica', '', $pdfCourse->fontSizeTableBody);
    $pdf->Cell(0, 4, utf8_decode("**\t Alumnos por:::: escuela seleccionada."), 0, 1, 'L');
    $pdf->Output();
} else {
    header("Location: error");
}
