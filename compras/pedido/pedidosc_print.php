<?php

include '../../librerias/tcpdf/tcpdf.php';
require '../../conexion.php';

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 0, 'Pag. ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }

}

// create new PDF document // CODIFICACION POR DEFECTO ES UTF-8
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Pablo Agüero');
$pdf->SetTitle('REPORTE DE PEDIDOS DE COMPRAS');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
$pdf->setPrintHeader(false);
// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
//set margins POR DEFECTO
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->SetMargins(8,10, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
//set auto page breaks SALTO AUTOMATICO Y MARGEN INFERIOR
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// ---------------------------------------------------------
// TIPO DE LETRA
$pdf->SetFont('times', 'B', 14);
// AGREGAR PAGINA
$pdf->AddPage('L', 'LEGAL');
//celda para titulo
$pdf->Cell(0, 0, "REPORTE DE PEDIDOS DE COMPRAS", 0, 1, 'C');
//SALTO DE LINEA
$pdf->Ln();
//COLOR DE TABLA
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetLineWidth(0.2);
//$pdf->Ln(); //salto
$pdf->SetFont('', '');
$pdf->SetFillColor(255, 255, 255);

    $pedidos = consultas::get_datos("select * from v_compras_pedido where id_pedido=" . $_REQUEST['vidpedido']."");
    if (!empty($pedidos)) {
        foreach ($pedidos as $pedido) {
            $pdf->SetFont('', 'B', 10);
            //columnas
            $pdf->SetFillColor(180, 180, 180);
            $pdf->Cell(20, 5, '#', 0, 0, 'C', 1);
            $pdf->Cell(80, 5, 'FECHA', 0, 0, 'C', 1);
            $pdf->Cell(50, 5, 'USUARIO', 0, 0, 'C', 1);
            $pdf->Cell(50, 5, 'ESTADO', 0, 0, 'C', 1);

            $pdf->Ln();

            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetFont('', '', 10);
            $pdf->Cell(20, 5, $pedido['id_pedido'], 0, 0, 'C', 1);
            $pdf->Cell(80, 5, $pedido['fecha_pedido1'], 0, 0, 'C', 1);
            $pdf->Cell(50, 5, $pedido['usu_nick'], 0, 0, 'C', 1);
            $pdf->Cell(50, 5, $pedido['estado'], 0, 0, 'C', 1);

            $pdf->Ln(); //salto 
            $pdf->Ln();

            $pdf->SetFont('times', 'B', 9);
            $pdf->Cell(0, 3, 'DETALLE DE PEDIDO NRO.:    ' . $pedido['id_pedido'], 0, 0, 'C', 0);
            $pdf->Ln();

            $detalles = consultas::get_datos("select * from v_compras_pedidos_detalle where id_pedido=" . $pedido['id_pedido'] . " order by id_pedido");

            $pdf->SetFont('', 'B', 10);
            $pdf->SetFillColor(188, 188, 188);
            $pdf->Cell(100, 5, 'ARTICULO', 1, 0, 'C', 1);
            $pdf->Cell(100, 5, 'PRECIO UNIT', 1, 0, 'C', 1);
            $pdf->Cell(50, 5, 'CANTIDAD', 1, 0, 'C', 1);
            $pdf->Ln(); //salto

            $pdf->SetFont('', '', 10);
            $pdf->SetFillColor(255, 255, 255);

            foreach ($detalles as $detalle) {
                $pdf->Cell(100, 5, $detalle['pro_descri'], 1, 0, 'C', 1);
                $pdf->Cell(100, 5, number_format($detalle['precio'], 0, ',', '.'), 1, 0, 'C', 1);
                $pdf->Cell(50, 5, $detalle['cantidad'], 1, 0, 'C', 1);
                $pdf->Ln();
            }
            $pdf->Ln();
            $pdf->Cell(350, 0, '----------------------------------------------------------------------------------------------------------------------------------------'
                    . '----------------------------------------------------------------------------', 0, 1, 'L');
            $pdf->Ln();
        }
    } else {
        $pdf->SetFont('times', 'B', '14');
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(255, 0, 0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->Cell(320, 6, 'NO SE ENCUENTRAN DATOS', 0, 0, 'C', 0);
    }
//SALIDA AL NAVEGADOR
$pdf->Output('reporte_pedidos.pdf', 'I');
