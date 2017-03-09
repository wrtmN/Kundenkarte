<?php
/* Aufruf:
pdf-api.php?data=data
*/

/* Anfang: Fehleranzeige */
error_reporting(E_ALL);
ini_set('display_errors', '1');
/* Ende: Fehleranzeige */

if (isset($_GET['data']))
{
	$data = $_GET['data'];
}
else
{
	die();
}


// Bibliothek FPDF einbinden
require ("include/fpdf/fpdf.php");

// Instanz $pdf der Klasse FPDF erstellen
$pdf = new FPDF();

$pdf->SetFont("Helvetica");
$pdf->SetTextColor(32,32,255);
$pdf->AddPage();


$data = utf8_decode($data);

$datas = explode(",",$data);

$pdf->setXY(10,20);
$pdf->Cell(40,20,"Shop-ID:	" . $datas[0]);
$pdf->setXY(10,27);
$pdf->Cell(40,20,"Kunden-ID: " . $datas[1]);
$pdf->setXY(10,34);
$pdf->Cell(10,20,"Vorname: " . $datas[2]);
$pdf->setXY(10,41);
$pdf->Cell(10,20,"Nachname: " . $datas[3]);

$url = "http://localhost" . $_SERVER['PHP_SELF'];
$imgStream = dirname($url) . "/qrcode-api.php?data=$data&logo=1&ec=4";



$pdf->Image($imgStream, 90, 20, 40, 40,'PNG');
$pdf->Output("kundenkarte.pdf", "D");

?>
