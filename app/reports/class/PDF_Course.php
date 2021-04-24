<?php
include_once '../../dirs.php';
require_once(DB_PATH . "MySqlConnection.php");
require_once(UTIL_PATH . "fpdf/fpdf.php");

class PDF_Course
{
    public $heightTitleCell = 8;
    public $fontSizeH1 = 18;
    public $fontSizeH2 = 14;
    public $fontSizeH3 = 12;

    public $width1C = 10;
    public $width2C = 23;
    public $width3C = 47;
    public $width4C = 55;
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
        $this->pdf->Cell(87, $this->heightTitleCell, utf8_decode($title), 0, 0, 'L');
        $this->pdf->SetTextColor(155, 155, 155);
        $this->pdf->SetFont('Helvetica', '', $this->fontSizeH2);
        $this->pdf->Cell(20, $this->heightTitleCell + 1, utf8_decode($scPROCESS), 0, 1, 'L');
        $this->pdf->Ln(5);
    }

    function headerReport($y)
    {
        $this->pdf->SetTextColor(33, 37, 41);
        $this->pdf->Image(PUBLIC_PATH . '/unasamheader.png', 10, $y, 65);
        /*  $this->pdf->SetFont('Helvetica', '', 7);
        $this->pdf->Cell(190, 10, utf8_decode($this->pdf->GetPageHeight()), 0, 2, 'C');
        $this->pdf->SetFont('Helvetica', '', 6);
        $this->pdf->Cell(190, 5, utf8_decode($y), 0, 0, 'C');  */
        $this->pdf->Image(PUBLIC_PATH . '/ogculength.png', 137, $y, 65);
        $this->pdf->SetDrawColor(238, 238, 238);
        $this->pdf->Line(10, $y + 20, 200, $y + 20);
        $this->pdf->Ln(30);
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
        $this->pdf->Cell(25, $this->fontSizeH3, utf8_decode('Dimensión: '), 0, 0, 'L');
        $this->pdf->SetFont('Helvetica', '', $this->fontSizeH3);
        $this->pdf->Cell(0, $this->fontSizeH3, utf8_decode($name), 0, 1, 'L', 0);
        $this->pdf->Ln(2);
    }
    function dimensionCourse($dimension, $course)
    {

        $this->pdf->SetFont('Helvetica', 'B', $this->fontSizeH3);
        $this->pdf->Cell(25, $this->fontSizeH3, utf8_decode('Dimensión: '), 0, 0, 'L');
        $this->pdf->SetFont('Helvetica', '', $this->fontSizeH3);
        $this->pdf->Cell(60, $this->fontSizeH3, utf8_decode($dimension), 0, 0, 'L', 0);

        $this->pdf->SetFont('Helvetica', 'B', $this->fontSizeH3);
        $this->pdf->Cell(25, $this->fontSizeH3, utf8_decode('Curso: '), 0, 0, 'L');
        $this->pdf->SetFont('Helvetica', '', $this->fontSizeH3);
        $this->pdf->Cell(80, $this->fontSizeH3, utf8_decode($course), 0, 1, 'L', 0);
        $this->pdf->Ln(2);
    }

    function tableHeader()
    {
        $this->pdf->SetDrawColor(222, 226, 230);
        $this->pdf->SetLineWidth($this->cellLineWidth);
        $this->pdf->SetFillColor(233, 236, 239);
        $this->pdf->SetFont('Helvetica', 'B', $this->fontSizeTableHeader);
        $this->pdf->Cell($this->width1C, $this->heightTableCell, '#', 1, 0, 'C', 1);
        $this->pdf->Cell($this->width2C, $this->heightTableCell, utf8_decode('Código'), 1, 0, 'L', 1);
        $this->pdf->Cell($this->width3C, $this->heightTableCell, utf8_decode('Alumno'), 1, 0, 'L', 1);
        $this->pdf->Cell($this->width4C, $this->heightTableCell, 'Programa', 1, 0, 'L', 1);
        $this->pdf->Cell($this->width4C, $this->heightTableCell, 'Estado **', 1, 1, 'L', 1);
    }
    function tableBody($num, $code, $lastname, $name,$program, $status)
    {
        $this->pdf->SetTextColor(73, 80, 87);
        $this->pdf->SetFont('Helvetica', 'B', $this->fontSizeTableBody);
        $this->pdf->Cell($this->width1C, $this->heightTableCell, $num, 1, 0, 'C');
        $this->pdf->SetTextColor(33, 37, 41);
        $this->pdf->SetFont('Helvetica', '', $this->fontSizeTableBody);
        $this->pdf->Cell($this->width2C, $this->heightTableCell, utf8_decode($code), 1, 0, 'L');
        $this->pdf->Cell($this->width3C, $this->heightTableCell, utf8_decode($lastname . ' ' . $name), 1, 0, 'L');
        $this->pdf->Cell($this->width4C, $this->heightTableCell, utf8_decode($program), 1, 0, 'L');
        $this->pdf->Cell($this->width4C, $this->heightTableCell, utf8_decode($status), 1, 1, 'L');
    }
}
