<?php
include_once '../../dirs.php';
require_once(DB_PATH . "MySqlConnection.php");
require_once(UTIL_PATH . "fpdf/fpdf.php");

class PDF_Student
{
    public $heightTitleCell = 8;
    public $fontSizeH1 = 18;
    public $fontSizeH2 = 14;
    public $fontSizeH3 = 10;
    public $fontSizeH4 = 9;

    public $width1C = 10;
    public $width2C = 25;
    public $width3C = 50;
    public $width4C = 80;
    public $heightTableCell = 8;
    public $cellLineWidth = 0.05;
    public $fontSizeTableHeader = 8;
    public $fontSizeTableBody = 8;

    private $pdf;
    public function __construct($pdf)
    {
        $this->pdf = $pdf;
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
        $this->pdf->Ln(2);
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
        $this->pdf->Ln(5);
    }
    function TableHeader()
    {
        $this->pdf->SetDrawColor(222, 226, 230);
        $this->pdf->SetLineWidth($this->cellLineWidth);
        $this->pdf->SetFillColor(233, 236, 239);
        $this->pdf->SetFont('Helvetica', 'B', $this->fontSizeTableHeader);
        $this->pdf->Cell($this->width1C, $this->heightTableCell, utf8_decode('Nº'), 1, 0, 'C', 1);
        $this->pdf->Cell($this->width3C, $this->heightTableCell, utf8_decode('Curso'), 1, 0, 'L', 1);
        $this->pdf->Cell($this->width2C, $this->heightTableCell, utf8_decode('Porcentaje *'), 1, 0, 'L', 1);
        $this->pdf->Cell($this->width2C, $this->heightTableCell, utf8_decode('Correctas **'), 1, 0, 'L', 1);
        $this->pdf->Cell(0, $this->heightTableCell, utf8_decode('Valoración ***'), 1, 1, 'L', 1);
    }
    function TableBody($num, $course, $percent, $right, $status)
    {
        $this->pdf->SetTextColor(73, 80, 87);
        $this->pdf->SetFont('Helvetica', 'B', $this->fontSizeTableBody);
        $this->pdf->Cell($this->width1C, $this->heightTableCell, $num, 1, 0, 'C');
        $this->pdf->SetTextColor(33, 37, 41);
        $this->pdf->SetFont('Helvetica', '', $this->fontSizeTableBody);
        $this->pdf->Cell($this->width3C, $this->heightTableCell, utf8_decode($course), 1, 0, 'L');
        $this->pdf->Cell($this->width2C, $this->heightTableCell, utf8_decode($percent . '% '), 1, 0, 'C');
        $this->pdf->Cell($this->width2C, $this->heightTableCell, utf8_decode($right), 1, 0, 'C');
        $this->pdf->Cell(0, $this->heightTableCell, utf8_decode($status), 1, 1, 'L');
    }
}
