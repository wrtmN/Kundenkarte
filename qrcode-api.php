<?php
/* Aufruf:
<img src='qrcode-api.php?data=text[&size=128&pad=5&ec=4&logo=1]' alt=''>
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

$logo = 0;
$size = 128;
$padding = 5;
$errorCorrection = 'high';

if (isset($_GET['logo']))
{
	$logo = $_GET['logo'];
}
if (isset($_GET['size']))
{
	$size = $_GET['size'];
}
if (isset($_GET['pad']))
{
	$padding = $_GET ['pad'];
}
if (isset($_GET['ec']))
{
	switch ($_GET['ec']) {
		case 3: $errorCorrection = 'quartile';
		break;
		case 2: $errorCorrection = 'medium';
		break;
		case 1: $errorCorrection = 'low';
		break;
		default: $errorCorrection = 'high';
	}
}
$logofile = "data/logo.png";
// Bibliothek endroid/QrCode einbinden
require ("include/QrCode-master/src/QrCode.php");

// Namensraum festlegen, die Klasse QrCode wird sonst nicht gefunden
use Endroid\QrCode\QrCode;

// Instanz der Klasse QrCode erstellen
$qrCode = new QrCode();  

/* Ab hier ergänzen Sie die Schnittstelle */
// Die Funktion(Methode)- der Objektinstanz $qrCode wird mit dem
// Parameter $data aufgerufen
$qrCode->setText($data);
$qrCode->setSize($size);
$qrCode->setErrorCorrection($errorCorrection);
$qrCode->setPadding($padding);

if ($logo == 1) {
	$qrCode->setLogo($logofile);
}

// Der Typ des Images wird festgesetzt
$qrCode->setImageType(QrCode::IMAGE_TYPE_PNG);

// HTML-Ausgabeformat: PNG-Datenstrom
header('Content-Type: '.$qrCode->getContentType());

// Erzeuge den Stream für die Anzeige des QR-Codes
$qrCode->render();
?>