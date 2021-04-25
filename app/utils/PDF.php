<?php
include_once '../../dirs.php';
require_once(UTIL_PATH . "fpdf/fpdf.php");

class PDF extends FPDF
{

    function Header()
    {
        /*  $this->SetTextColor(33, 37, 41);
        $this->Image(PUBLIC_PATH . '/unasamheader.png', 10, 7, 40);
        $this->SetFont('Helvetica', '', 7);
        $this->Cell(190, 1, utf8_decode('Universidad Nacional Santiago Antúnez de Mayolo'), 0, 2, 'C');
        $this->SetFont('Helvetica', '', 6);
        $this->Cell(190, 7, utf8_decode('Oficina de Calidad Universitaria'), 0, 0, 'C');
        $this->Image(PUBLIC_PATH . '/ogculength.png', 160, 7, 40);
        $this->SetDrawColor(238, 238, 238);
        $this->Line(10, 20, 200, 20);
        $this->Ln(15); */
    }

    function HeaderReport($y)
    {
        $this->SetTextColor(33, 37, 41);
        $this->Image(PUBLIC_PATH . '/unasamheader.png', 10, $y, 55);
        $this->SetFont('Helvetica', '', 8);
        $this->Cell(190, 8, utf8_decode('Universidad Nacional Santiago Antúnez de Mayolo'), 0, 2, 'C');
        $this->SetFont('Helvetica', '', 8);
        $this->SetTextColor(155, 155, 155);
        $this->Cell(190, 2, utf8_decode('Oficina de Calidad Universitaria'), 0, 0, 'C');
        $this->Image(PUBLIC_PATH . '/ogculength.png', 145, $y, 55);
        $this->SetDrawColor(238, 238, 238);
        $this->Line(10, $y + 20, 200, $y + 20);
        $this->Ln(20);
    }

    function ProcessHeader($wtitle, $title, $scPROCESS)
    {
        $this->SetTextColor(33, 37, 41);
        $this->SetFont('Helvetica', 'B', 18);
        $this->Cell($wtitle, 8, utf8_decode($title), 0, 0, 'L');
        $this->SetTextColor(155, 155, 155);
        $this->SetFont('Helvetica', '', 16);
        $this->Cell(20, 8 + 1, utf8_decode($scPROCESS), 0, 0, 'L');
        //date and hour
        $this->SetTextColor(33, 37, 41);
        $this->SetFont('Helvetica', '', 8);
        $fecha = new DateTime(null, new DateTimeZone('America/Lima'));
        $hora = $fecha->format("h:i:s");
        //View
        $this->Cell(0, 10, date('d-m-Y') . "  " . $hora, 0, 1, 'R');
        $this->Ln(2);
    }

    function AreaHeader($name, $description)
    {
        $this->SetTextColor(33, 37, 41);
        $this->SetFillColor(200, 220, 255);
        $this->SetFont('Helvetica', '', 16);
        $this->Cell(70, 8, utf8_decode($description), 0, 0, 'L', 0);
        $this->SetFont('Helvetica', 'B', 10);
        $this->Cell(0, 8+3, utf8_decode('ÁREA : ')."  ".strtoupper($name), 0, 1, 'C', 0);
        $this->Ln(-3);
    }

    function Footer()
    {
        $this->SetTextColor(33, 37, 41);
        $this->SetY(-15);
        $this->SetFont('Helvetica', 'B', 8);
        $this->Cell(0, 10, 'P ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}
