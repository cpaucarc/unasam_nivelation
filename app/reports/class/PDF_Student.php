<?php
include_once '../../dirs.php';
require_once(DB_PATH . "MySqlConnection.php");
require_once(UTIL_PATH . "fpdf/fpdf.php");

class PDF_Student
{
    public $heightTitleCell = 8;
    public $fontSizeH1 = 18;
    public $fontSizeH2 = 14;
    public $fontSizeH3 = 12;
    public $fontSizeH4 = 9;

    public $width1C = 10;
    public $width2C = 25;
    public $width3C = 50;
    public $width4C = 80;
    public $heightTableCell = 8;
    public $cellLineWidth = 0.05;
    public $fontSizeTableHeader = 9;
    public $fontSizeTableBody = 9;

    private $pdf;
    public function __construct($pdf)
    {
        $this->pdf = $pdf;
    }

    function processHeader($title, $scPROCESS)
    {
        $this->pdf->SetFont('Helvetica', 'B', $this->fontSizeH1);
        $this->pdf->Cell(103, $this->heightTitleCell, utf8_decode($title), 0, 0, 'L');
        $this->pdf->SetTextColor(155, 155, 155);
        $this->pdf->SetFont('Helvetica', '', $this->fontSizeH2);
        $this->pdf->Cell(20, $this->heightTitleCell + 1, utf8_decode($scPROCESS), 0, 1, 'L');
        $this->pdf->Ln(5);
    }

    function headerReport($y)
    {
        $this->pdf->SetTextColor(33, 37, 41);
        $this->pdf->Image(PUBLIC_PATH . '/unasamheader.png', 10, $y, 65);
        $this->pdf->SetFont('Helvetica', '', 7);
        $this->pdf->Cell(190, 1, utf8_decode('Universidad Nacional Santiago Antúnez de Mayolo'), 0, 2, 'C');
        $this->pdf->SetFont('Helvetica', '', 7);
        $this->pdf->Cell(190, 7, utf8_decode('Oficina de Calidad Universitaria'), 0, 0, 'C');
        $this->pdf->Image(PUBLIC_PATH . '/ogculength.png', 137, $y, 65);
        $this->pdf->SetDrawColor(238, 238, 238);
        $this->pdf->Line(10, $y + 20, 200, $y + 20);
        $this->pdf->Ln(30);
    }

    function studenteHeader($lastname, $name, $code, $dni, $program, $process, $omg, $omp)
    {
        $this->pdf->SetTextColor(33, 37, 41);
        $this->pdf->SetFont('Helvetica', '', $this->fontSizeH2);
        $this->pdf->Cell(0, $this->heightTitleCell, utf8_decode(strtoupper($lastname . ' ' . $name)), 0, 1, 'L');
        $this->pdf->Ln(2);
        $this->pdf->SetFont('Helvetica', 'B', $this->fontSizeH4);
        $this->pdf->Cell(15, $this->heightTitleCell - 2, utf8_decode('Código: '), 0, 0, 'L');
        $this->pdf->SetFont('Helvetica', '', $this->fontSizeH4);
        $this->pdf->Cell(80, $this->heightTitleCell - 2, utf8_decode($code), 0, 0, 'L');
        $this->pdf->SetFont('Helvetica', 'B', $this->fontSizeH4);
        $this->pdf->Cell(10, $this->heightTitleCell - 2, utf8_decode('DNI: '), 0, 0, 'L');
        $this->pdf->SetFont('Helvetica', '', $this->fontSizeH4);
        $this->pdf->Cell(0, $this->heightTitleCell - 2, utf8_decode($dni), 0, 1, 'L');
        $this->pdf->SetFont('Helvetica', 'B', $this->fontSizeH4);
        $this->pdf->Cell(15, $this->heightTitleCell - 2, utf8_decode('Escuela: '), 0, 0, 'L');
        $this->pdf->SetFont('Helvetica', '', $this->fontSizeH4);
        $this->pdf->Cell(80, $this->heightTitleCell - 2, utf8_decode(strtoupper($program)), 0, 0, 'L');
        $this->pdf->SetFont('Helvetica', 'B', $this->fontSizeH4);
        $this->pdf->Cell(35, $this->heightTitleCell - 2, utf8_decode('Proceso de Admisión: '), 0, 0, 'L');
        $this->pdf->SetFont('Helvetica', '', $this->fontSizeH4);
        $this->pdf->Cell(0, $this->heightTitleCell - 2, utf8_decode($process), 0, 1, 'L');
        $this->pdf->Ln(2);
        $this->pdf->SetFont('Helvetica', 'B', $this->fontSizeH4);
        $this->pdf->Cell(15, $this->heightTitleCell - 2, utf8_decode('OMG: '), 0, 0, 'L');
        $this->pdf->SetFont('Helvetica', '', $this->fontSizeH4);
        $this->pdf->Cell(80, $this->heightTitleCell - 2, utf8_decode(strtoupper($omg)), 0, 0, 'L');
        $this->pdf->SetFont('Helvetica', 'B', $this->fontSizeH4);
        $this->pdf->Cell(15, $this->heightTitleCell - 2, utf8_decode('OMP: '), 0, 0, 'L');
        $this->pdf->SetFont('Helvetica', '', $this->fontSizeH4);
        $this->pdf->Cell(0, $this->heightTitleCell - 2, utf8_decode($omp), 0, 1, 'L');
        $this->pdf->Ln(2);
    }
    function areaHeader($name, $description)
    {
        $this->pdf->SetTextColor(33, 37, 41);
        $this->pdf->SetFillColor(200, 220, 255);
        $this->pdf->SetFont('Helvetica', 'B', $this->fontSizeH1);
        $this->pdf->Cell(20, $this->heightTitleCell, utf8_decode('ÁREA '), 0, 0, 'L', 0);
        $this->pdf->SetFont('Helvetica', 'B', $this->fontSizeH1);
        $this->pdf->Cell(10, $this->heightTitleCell, utf8_decode(strtoupper($name) . " : "), 0, 0, 'L', 0);
        $this->pdf->SetFont('Helvetica', '', $this->fontSizeH1);
        $this->pdf->Cell(0, $this->heightTitleCell, utf8_decode($description), 0, 1, 'L', 0);
        $this->pdf->Ln(1);
    }
    function programHeader($name)
    {
        $this->pdf->SetFont('Helvetica', 'B', $this->fontSizeH3);
        $this->pdf->Cell(22, $this->fontSizeH3, utf8_decode('Programa: '), 0, 0, 'L');
        $this->pdf->SetFont('Helvetica', '', $this->fontSizeH3);
        $this->pdf->Cell(0, $this->fontSizeH3, utf8_decode($name), 0, 1, 'L', 0);
        $this->pdf->Ln(2);
    }
    function tableHeader()
    {
        $this->pdf->SetDrawColor(222, 226, 230);
        $this->pdf->SetLineWidth($this->cellLineWidth);
        $this->pdf->SetFillColor(233, 236, 239);
        $this->pdf->SetFont('Helvetica', 'B', $this->fontSizeTableHeader);
        $this->pdf->Cell($this->width1C, $this->heightTableCell, '#', 1, 0, 'C', 1);
        $this->pdf->Cell($this->width3C, $this->heightTableCell, utf8_decode('Curso'), 1, 0, 'L', 1);
        $this->pdf->Cell($this->width2C, $this->heightTableCell, utf8_decode('Porcentaje'), 1, 0, 'L', 1);
        $this->pdf->Cell($this->width2C, $this->heightTableCell, utf8_decode('Correctas *'), 1, 0, 'L', 1);
        $this->pdf->Cell($this->width4C, $this->heightTableCell, utf8_decode('Valoración **'), 1, 1, 'L', 1);
    }
    function tableBody($num, $course, $percent, $right, $status)
    {
        $this->pdf->SetTextColor(73, 80, 87);
        $this->pdf->SetFont('Helvetica', 'B', $this->fontSizeTableBody);
        $this->pdf->Cell($this->width1C, $this->heightTableCell, $num, 1, 0, 'C');
        $this->pdf->SetTextColor(33, 37, 41);
        $this->pdf->SetFont('Helvetica', '', $this->fontSizeTableBody);
        $this->pdf->Cell($this->width3C, $this->heightTableCell, utf8_decode($course), 1, 0, 'L');
        $this->pdf->Cell($this->width2C, $this->heightTableCell, utf8_decode($percent . '% '), 1, 0, 'C');
        $this->pdf->Cell($this->width2C, $this->heightTableCell, utf8_decode($right), 1, 0, 'C');
        $this->pdf->Cell($this->width4C, $this->heightTableCell, utf8_decode($status), 1, 1, 'L');
    }
}
