<?php
function readcsvfile()
/* Inhalt der CSV-Datei lesen und als Array zurückgeben */
/* Struktur der CSV-Datei:
KundenId, Vorname, Nachname
KundenId, Vorname, Nachname
KundenId, Vorname, Nachname
*/
{
	$datafile = './data/kundenkarte.csv';
	$zeilen = array();
	$fr = fopen($datafile, 'r');
	if ($fr !== false)
	{
		while (($csv_array = fgetcsv($fr)) !== false)
		{
			// Felder einer Zeile als String zusammenfassen
			// Feldtrenner ist ein Komma
			$zeile = implode(",",$csv_array);
			// Zeile an das Array $zeilen anhängen
			array_push($zeilen, $zeile);
		}
	}
	fclose($fr);
	// Array $zeilen ausgeben
	return $zeilen;
}

// In der Liste gewählten Kunden ermitteln
// Feld vorbelegen, falls kein Kunde gewählt
$kunde_selected = "";
// $kunde aus der Auswahlliste (Formularfeld 'liste') ermitteln
if (isset($_POST['liste']))
{
	$kunde_selected = $_POST['liste'];
}

?>
<h2>Ausgeben</h2>
<form method="post">
<select name="liste" size="5">
<?php
	// Kunden aus CSV-Datei lesen
	$alle_kunden = readcsvfile();
	foreach ($alle_kunden as $kunde) {
		if ($kunde != '') {
			$select = '';
			if ($kunde == $kunde_selected) {
				$select = ' selected';
			}
			echo "<option value='$kunde' $select>$kunde</option>\n";
		}
	}
?>
</select>
<br>
<input type="submit" name="details" value="Details">
</form>
