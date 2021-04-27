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

    //Areas
    if ($areaPdf != '') {
        $sql = "SELECT * FROM areas WHERE name='$areaPdf';";
    } else {
        $sql = "SELECT * FROM areas";
    }
    $response = $conn->query($sql);

    foreach ($response as $row1) {
        //Programs
        if ($areaPdf != '' && $programPdf != '') {
            $sql = "SELECT * FROM programs WHERE name='$programPdf'";
        } else {
            $sql = "SELECT * FROM programs WHERE areas_id=(SELECT id FROM areas WHERE name='" . $row1['name'] . "')";
        }
        $std = $conn->query($sql);

        //Report header
        $pdf->HeaderReport($pdf->GetY());

        //Proceso:
        $pdf->ProcessHeader(73,"Reporte por programas", $processPdf);
        $pdf->AreaHeader($row1['name'], $row1['description']);

        if (!$std->rowCount() > 0) {
            $pdfSchool->ProgramHeader('Aún no se asignaron programas');
        }

        foreach ($std as $row2) {
            $pdfSchool->ProgramHeader($row2['name']);

            /* $sql = "SELECT id, dni, name, lastname, code  FROM vstudents  WHERE  process ='" . $processPdf . "' and  program ='" . $row2['name'] . "'  ORDER BY lastname;"; */

            $sql = "SELECT id, dni, name, lastname, code, omg, omp FROM vstudents WHERE process = '" . $processPdf . "' and program = '" . $row2['name'] . "' ORDER BY omp;";


            

            $result = $conn->query($sql);
            //Table Header
            $pdfSchool->TableHeader();
            //Table body            
            if ($result->rowCount() > 0) {
                $num = 1;
                foreach ($result as $row3) {
                    $pdfSchool->TableBody($num, $row3['omg'],$row3['omp'], $row3['dni'], $row3['code'], $row3['lastname'], $row3['name']);
                    $num++;
                }
            } else {
                $pdfSchool->TableBody('..','..','..', '..', '..', '.', '.');
            }
            $pdf->Ln(5);
        }
        $pdf->Ln(10);
    }

    $pdf->SetTextColor(86, 97, 108);
    $pdf->SetFont('Helvetica', '', $pdfSchool->fontSizeTableBody+1);
    $pdf->Cell(0, 5, utf8_decode("*\t\t\t OMG: Orden de Mérito General."), 0, 1, 'L');
    $pdf->Cell(0, 5, utf8_decode("**\t\t OMP: Orden de Mérito por Programa Académico."), 0, 1, 'L');  
    $pdf->Cell(0, 5, utf8_decode("***\t Alumnos por Programa Académico seleccionada."), 0, 1, 'L');
    $pdf->Output();
} else {
    header("Location: error");
}
