<?php

include '../../librerias/tcpdf/tcpdf.php';
require '../../conexion.php';

class MYPDF extends TCPDF {

    PUBLIC function Footer() {
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(0, 0, 'Pag. ' . $this->getAliasNumPage() . '/' .
                $this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'R');
    }

}

$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, TRUE, 'UFT-8', FALSE);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Pablo Agüero');
$pdf->SetTitle('REPORTE DE CIUDADES');
$pdf->SetSubject('TECDF TUTORIAL');
$pdf->SetAuthor('Pablo Agüero');
$pdf->SetKeywords('TCPDF, PDF, example');
$pdf->setPrintHeader(FALSE);
$pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
$pdf->setFooterMargin(PDF_MARGIN_FOOTER);

//SE REPITE PORQUE UNO ES EL MARGEN Y EL OTRO SALTO AUTOMÁTICO
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//TIPO DE LETRAS
$pdf->SetFont('times', 'B', 14);

//AGREGAR PAGINA
$pdf->AddPage('L', 'LEGAL');

//FORMATO DE TÍTULO
$pdf->Cell(0, 0, "REPORTE DE CIUDADES", 0, 1, 'C');

//SLATO DE LINEA
$pdf->ln();

//TABLA
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetLineWidth(0.2);
$pdf->SetFillColor(255, 255, 255);

//CONSULTA A LA BASE DE DATOS
$sqls = consultas::get_datos("SELECT * FROM v_ref_ciudad ORDER BY id_ciudad");
foreach ($sqls AS $sql) {
    $pdf->Cell(80, 5, $sql['id_ciudad'], 1, 0, 'C', 1);
    $pdf->Cell(80, 5, $sql['ciu_descri'], 1, 0, 'C', 1);
    $pdf->Cell(80, 5, $sql['pai_descri'], 1, 0, 'C', 1);
    $pdf->ln();
}
//SALIDA AL NAVEGADOR
$pdf->Output('reporte_ciudad.pdf', 'I');
?>

