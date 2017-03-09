<?php
// Variablen vorbelegen
$vorname = '';
$nachname = '';

function writecsvfile($id, $vorname, $nachname)
/* Eine Zeile anhängen
   Falls die Datei noch nicht existiert, wird sie angelegt
*/
{
	$datafile = './data/kundenkarte.csv';
	$fw = fopen($datafile, 'a');
	// Drei Feldern zu einem Zeilen-Array umwandeln
	$zeile = explode(",", "$id,$vorname,$nachname");
	fputcsv ($fw, $zeile);
	fclose ($fw);
}

// Formulardaten lesen
if (isset($_POST['input_submit']))
{
	$id = $_POST['id'];
	$vorname = $_POST['vorname'];
	$nachname = $_POST['nachname'];
	// Formulardaten in CSV-Datei schreiben
	if ($id != '' && $vorname != '' && $nachname != '')
	{
		writecsvfile($id,$vorname,$nachname);
	}
}
?>
<h2>Eingeben</h2>
<form method="post">
	<p><input type="text" placeholder="Kunden-Id" name="id"></p>
	<p><input type="text" placeholder="Vorname" name="vorname"></p>
	<p><input type="text" placeholder="Nachname" name="nachname"></p>
	<p><input type="submit" name="input_submit" value="Ok">
</form>
