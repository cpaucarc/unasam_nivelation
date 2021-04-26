<?php
include_once '../../dirs.php';
require_once(UTIL_PATH . "fpdf/fpdf.php");

class PDF extends FPDF
{

    function Header()
    {
//        $this->SetTextColor(33, 37, 41);
//        $this->Image(PUBLIC_PATH . '/unasamheader.png', 10, 7, 40);
//        $this->SetFont('Helvetica', '', 7);
//        $this->Cell(190, 1, utf8_decode('Universidad Nacional Santiago Antúnez de Mayolo'), 0, 2, 'C');
//        $this->SetFont('Helvetica', '', 6);
//        $this->Cell(190, 7, utf8_decode('Oficina de Calidad Universitaria'), 0, 0, 'C');
//        $this->Image(PUBLIC_PATH . '/ogculength.png', 160, 7, 40);
//        $this->SetDrawColor(238, 238, 238);
//        $this->Line(10, 20, 200, 20);
//        $this->Ln(15);
    }

    function Footer()
    {
        $this->SetTextColor(33, 37, 41);
        $this->SetY(-15);
        $this->SetFont('Helvetica', 'B', 8);
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . ' de {nb}', 0, 0, 'C');
    }
}