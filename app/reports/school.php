<?php
include_once '../../dirs.php';
require_once(DB_PATH . "MySqlConnection.php");
require_once(UTIL_PATH . "PDF.php");
require_once(REPORT_PATH . "class/PDF_School.php");

if (isset($_POST['processPdf'])) {

    $areaPdf = $_POST['areaPdf'];
    $programPdf = $_POST['programPdf'];
    $processPdf = $_POST['processPdf'];

    $pdf = new PDF('P', 'mm', 'A4');
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $conn = (new MySqlConnection())->getConnection();
    $pdfSchool = new PDF_School($pdf);

    //Áreas
    if ($areaPdf != '') {
        $sql = "SELECT * FROM areas WHERE name='$areaPdf';";
    } else {
        $sql = "SELECT * FROM areas";
    }
    $response = $conn->query($sql);

    foreach ($response as $row1) {
        //Escuelas
        if ($areaPdf != '' && $programPdf != '') {
            $sql = "SELECT * FROM programs WHERE name='$programPdf'";
        } else {
            $sql = "SELECT * FROM programs WHERE areas_id=(SELECT id FROM areas WHERE name='" . $row1['name'] . "')";
        }

        $std = $conn->query($sql);
        //Cabercera
        $pdfSchool->headerReport($pdf->GetY());
        //Proceso:
        $pdfSchool->processHeader("Reporte general por programa", $processPdf);
        $pdfSchool->areaHeader($row1['name'], $row1['description']);

        if (!$std->rowCount() > 0) {
            $pdfSchool->programHeader('Aún no se asignaron programas');
        }

        foreach ($std as $row2) {

            $pdfSchool->programHeader($row2['name']);

            $sql = "SELECT id, dni, name, lastname, code  FROM vstudents  WHERE  process ='" . $processPdf . "'   and  program ='" . $row2['name'] . "'  ORDER BY lastname;";

            $result = $conn->query($sql);
            //Table Header
            $pdfSchool->tableHeader();
            //Table body            
            if ($result->rowCount() > 0) {
                $num = 1;
                foreach ($result as $row3) {
                    $pdfSchool->tableBody($num, $row3['dni'], $row3['code'], $row3['lastname'], $row3['name']);
                    $num++;
                }
            } else {
                $pdfSchool->tableBody('..', '..', '..', '.', '.');
            }
            $pdf->Ln(5);
        }
        $pdf->Ln(10);
    }

    $pdf->SetTextColor(86, 97, 108);
    $pdf->SetFont('Helvetica', '', $pdfSchool->fontSizeTableBody);
    $pdf->Cell(0, 4, utf8_decode("**\t Alumnos por escuela seleccionada."), 0, 1, 'L');
    $pdf->Output();
} else {
    header("Location: error");
}
