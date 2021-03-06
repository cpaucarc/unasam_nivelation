<?php
include_once '../../dirs.php';
require_once(DB_PATH . "MySqlConnection.php");
require_once(UTIL_PATH . "fpdf/fpdf.php");


class PDF_Template
{
    public $heightTitleCell = 8;
    public $fontSizeH1 = 18;
    public $fontSizeH2 = 16;
    public $fontSizeH3 = 10;

    public $width1C = 10;
    public $width2C = 20;
    public $width3C = 52;
    public $width4C = 50;
    public $heightTableCell = 8;
    public $cellLineWidth = 0.05;
    public $fontSizeTableHeader = 8;
    public $fontSizeTableBody = 8;

    private $pdf;

    public function __construct($pdf)
    {
        $this->pdf = $pdf;
    }

    function DimensionCourse($dimension, $course)
    {

        $this->pdf->SetFont('Helvetica', 'B', $this->fontSizeH3);
        $this->pdf->Cell(25, $this->fontSizeH3, utf8_decode('Dimensión: '), 0, 0, 'L');
        $this->pdf->SetFont('Helvetica', '', $this->fontSizeH3);
        $this->pdf->Cell(98, $this->fontSizeH3, utf8_decode($dimension), 0, 0, 'L', 0);
        $this->pdf->SetFont('Helvetica', 'B', $this->fontSizeH3);
        $this->pdf->Cell(15, $this->fontSizeH3, utf8_decode('Curso: '), 0, 0, 'L');
        $this->pdf->SetFont('Helvetica', '', $this->fontSizeH3);
        $this->pdf->Cell(0, $this->fontSizeH3, utf8_decode($course), 0, 1, 'L', 0);
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
        $this->pdf->Cell($this->width3C, $this->heightTableCell, utf8_decode('Alumno *'), 1, 0, 'L', 1);
        $this->pdf->Cell($this->width4C, $this->heightTableCell, 'Programa', 1, 0, 'L', 1);
        $this->pdf->Cell(0, $this->heightTableCell, utf8_decode('Recomendación **'), 1, 1, 'L', 1);
    }

    function TableBody($num, $code, $lastname, $name, $program, $status)
    {
        $this->pdf->SetTextColor(73, 80, 87);
        $this->pdf->SetFont('Helvetica', 'B', $this->fontSizeTableBody - 2);
        $this->pdf->Cell($this->width1C, $this->heightTableCell, $num, 1, 0, 'C');
        $this->pdf->SetTextColor(33, 37, 41);
        $this->pdf->SetFont('Helvetica', '', $this->fontSizeTableBody - 1);
        $this->pdf->Cell($this->width2C, $this->heightTableCell, utf8_decode($code), 1, 0, 'L');
        $this->pdf->SetFont('Helvetica', '', $this->fontSizeTableBody - 2);
        $this->pdf->Cell($this->width3C, $this->heightTableCell, utf8_decode($lastname . ' ' . $name), 1, 0, 'L');
        $this->pdf->Cell($this->width4C, $this->heightTableCell, utf8_decode($program), 1, 0, 'L');
        $this->pdf->SetFont('Helvetica', '', $this->fontSizeTableBody - 1);
        $this->pdf->Cell(0, $this->heightTableCell, utf8_decode($status), 1, 1, 'L');
    }
}
