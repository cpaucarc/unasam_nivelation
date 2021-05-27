<?php
include_once '../../dirs.php';
require_once(DB_PATH . "MySqlConnection.php");
require_once(UTIL_PATH . "fpdf/fpdf.php");

class PDF_Area
{
    public $fontSizeH3 = 10;

    public $width1C = 10;
    public $width2C = 20;
    public $width3C = 55;
    public $heightTableCell = 8;
    public $cellLineWidth = 0.05;
    public $fontSizeTableHeader = 8;
    public $fontSizeTableBody = 6.5;

    private $pdf;

    public function __construct($pdf)
    {
        $this->pdf = $pdf;
    }


    function ProgramHeader($name)
    {
        $this->pdf->SetFont('Helvetica', 'B', $this->fontSizeH3);
        $this->pdf->Cell(22, $this->fontSizeH3, utf8_decode('Programa: '), 0, 0, 'L');
        $this->pdf->SetFont('Helvetica', '', $this->fontSizeH3);
        $this->pdf->Cell(0, $this->fontSizeH3, utf8_decode(strtoupper($name)), 0, 1, 'L', 0);
        $this->pdf->Ln(2);
    }

    function TableHeader()
    {
        $this->pdf->SetDrawColor(222, 226, 230);
        $this->pdf->SetLineWidth($this->cellLineWidth);
        $this->pdf->SetFillColor(233, 236, 239);
        $this->pdf->SetFont('Helvetica', 'B', $this->fontSizeTableHeader);
        $this->pdf->Cell($this->width1C, $this->heightTableCell, utf8_decode('Nº'), 1, 0, 'C', 1);
        $this->pdf->Cell($this->width2C, $this->heightTableCell, utf8_decode('Código'), 1, 0, 'L', 1);
        $this->pdf->Cell($this->width3C, $this->heightTableCell, utf8_decode('Alumno'), 1, 0, 'L', 1);
        $this->pdf->Cell($this->width1C, $this->heightTableCell, 'Pt *', 1, 0, 'L', 1);
        $this->pdf->Cell($this->width3C, $this->heightTableCell, utf8_decode('Programa Académico'), 1, 0, 'L', 1);
        $this->pdf->Cell(0, $this->heightTableCell, utf8_decode('Recomendación'), 1, 1, 'L', 1);
    }

    function TableBody($num, $code, $name, $lastname, $score, $program, $recomendation)
    {
        $this->pdf->SetTextColor(33, 37, 41);
        $this->pdf->SetFont('Helvetica', '', $this->fontSizeTableBody);
        $this->pdf->Cell($this->width1C, $this->heightTableCell, $num, 1, 0, 'C');
        $this->pdf->Cell($this->width2C, $this->heightTableCell, utf8_decode($code), 1, 0, 'L');
        $this->pdf->Cell($this->width3C, $this->heightTableCell, utf8_decode($lastname . ' ' . $name), 1, 0, 'L');
        $this->pdf->Cell($this->width1C, $this->heightTableCell, utf8_decode($score), 1, 0, 'L');
        $this->pdf->SetFont('Helvetica', '', $this->fontSizeTableBody-0.5);
        $this->pdf->Cell($this->width3C, $this->heightTableCell, utf8_decode($program), 1, 0, 'L');
        $this->pdf->Cell(0, $this->heightTableCell, utf8_decode($recomendation), 1, 1, 'L');
    }
}
