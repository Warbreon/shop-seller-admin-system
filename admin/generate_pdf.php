<?php
require_once '../libraries/tcpdf/tcpdf.php';

ob_start();
include 'ADMININTERFACE.php';
$adminInterfaceContent = ob_get_clean();

// NAUJAS PDF DOC
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetFont('dejavusans', '', 10);

$pdf->AddPage();

$pdf->writeHTML($adminInterfaceContent, true, false, true, false, '');

$pdf->Output('generatedPDF.pdf', 'I');
?>
