<?php
include_once '../../dirs.php';
require_once(DB_PATH . "MySqlConnection.php");
require_once(UTIL_PATH . "PDF.php");
require_once(REPORT_PATH . "class/PDF_Student.php");

if (isset($_POST['stdID']) and isset($_POST['dimID'])) {

    $stdtID = intval($_POST['stdID']);
    $dimID = intval($_POST['dimID']);

    $height = 7;
    $width = 60;
    $font = "Helvetica";
    $noDataText = "Aun no se consignan los datos, espere a la finalización del curso de nivelacion.";

    if ($stdtID > 0 and $dimID > 0) {
        $pdf = new PDF('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $conn = (new MySqlConnection())->getConnection();

        //Report header
        $pdf->HeaderReport($pdf->GetY());

        $sql = "SELECT code, process, program, dni, concat(lastname, ' ', name) as student FROM vstudents WHERE id  = " . $stdtID;
        $response = $conn->query($sql);
        $student = $response->fetch(PDO::FETCH_ASSOC);

        $sql = "SELECT IFNULL((SELECT groups_id FROM student_group WHERE student_data_id = $stdtID and groups_id IN (SELECT id FROM groups WHERE areas_id = getAreaIDByStudentID($stdtID) AND dimensions_id = $dimID and process_id = (SELECT process_id FROM student_data WHERE id = $stdtID))), -1) as groupID;";
        $response = $conn->query($sql);
        $groupID = $response->fetchColumn();


        $pdf->SetMargins(30, 0);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont($font, 'B', 16);
        $pdf->Ln(5);
        $pdf->Cell(0, 20, 'CONSTANCIA', 0, 1, 'C', 0);
        $pdf->Ln(10);
        $pdf->SetFont($font, '', 10);

        if (intval($groupID) > 0) {
            $sql_qlf = "SELECT IFNULL((SELECT qualification_final as qualify FROM qualifications WHERE groups_id = $groupID AND student_data_id = $stdtID), -1) as qualify;";
            $response = $conn->query($sql_qlf);
            $qualify = $response->fetchColumn();
            $qualify = intval($qualify);

            $sqlMIN = "SELECT qualification_min FROM process WHERE id = (SELECT process_id FROM student_data WHERE id = $stdtID );";
            $response = $conn->query($sqlMIN);
            $qlfMin = $response->fetchColumn();
            $qlfMin = intval($qlfMin);

            if ($qualify > 0) {
                //Emitir la constancia

                $sql = "SELECT	
                (SELECT concat(lastname, ' ', name) FROM people WHERE id = (SELECT people_id FROM teachers WHERE id = teachers_id)) as teacher,
                (SELECT dni FROM people WHERE id = (SELECT people_id FROM teachers WHERE id = teachers_id)) as dni,
                (SELECT name FROM dimensions WHERE id = dimensions_id) as dimension
            FROM groups WHERE id = $groupID;";
                $response = $conn->query($sql);
                $teacher = $response->fetch(PDO::FETCH_ASSOC);

                $pdf->Ln(5);

                $text = "Usted no aprobó el curso.";
                $exp = "";
                if ($qualify >= $qlfMin) {
                    $text = "Que, la (el) estudiante " . utf8_decode(strtoupper($student['student'])) . ", con Código Universitario " . $student['code'] . " y N° de DNI " . $student['dni'] . "; ha completado el programa de nivelación correspondiente al proceso de admisión " . $student['process'] . " para la dimensión " . utf8_decode(strtoupper($teacher['dimension'])) . " de forma satisfactoria.";
                    $exp = "Se expide la presente a solicitud de la interesada(o).";
                }

                $pdf->MultiCell(0, $height, utf8_decode($text), 0, 'J', 0);
                $pdf->Ln(2);
                $pdf->MultiCell(0, $height, utf8_decode($exp), 0, 'J', 0);
                $pdf->Ln(15);
                $pdf->Cell(0, $height * 1.5, 'Huaraz, ' . date("d/m/Y"), 0, 0, 'R', 0);

                $pdf->Ln(25);

                $pdf->SetDrawColor(218, 218, 218);
                $pdf->SetFont($font, 'B', 9);
                $pdf->Cell($width, $height * 1.5, ' Apellidos y Nombres del docente', 1, 0, 'L', 0);
                $pdf->SetFont($font, '', 9);
                $pdf->Cell((150 - $width), $height * 1.5, " " . utf8_decode(strtoupper($teacher['teacher'])), 1, 1, 'L', 0);
                $pdf->SetFont($font, 'B', 9);
                $pdf->Cell($width, $height * 1.5, ' DNI del docente', 1, 0, 'L', 0);
                $pdf->SetFont($font, '', 9);
                $pdf->Cell((150 - $width), $height * 1.5, " " . $teacher['dni'], 1, 1, 'L', 0);
                $pdf->SetFont($font, 'B', 9);
                $pdf->Cell($width, $height * 1.5, ' Firma del docente', 1, 0, 'L', 0);
                $pdf->SetFont($font, '', 9);
                $pdf->Cell((150 - $width), $height * 1.5, '', 1, 1, 'L', 0);
            } else {
                $pdf->Cell(0, $height, utf8_decode($noDataText), 0, 1, 'C', 0);
            }
        } else {
            $pdf->Cell(0, $height, utf8_decode($noDataText), 0, 1, 'C', 0);
        }
        $pdf->Output();
    } else {
        header("Location: error");
    }
} else {
    header("Location: error");
}
