<?php
/* Anfang: Fehleranzeige */
error_reporting(E_ALL);
ini_set('display_errors', '1');
/* Ende: Fehleranzeige */

/* Anfang: Konstanten und Variablen deklarieren */
$shop_id = 42;
$includefile = '';
$kunde_selected = '';
/* Ende: Konstanten und Variablen deklarieren */


/* Anfang: Menü auswerten */
if (isset($_GET['menu']))
{
	$includefile = './include/' . $_GET['menu'] . '.php';
}
/* Ende: Menü auswerten */
?>
<!doctype html>
<html>
	<head>
		<meta charset='utf-8'>
		<title>Kundenkarte</title>
		<link rel="stylesheet" href="include/kundenkarte.css">
	</head>
	<body>
		<div id="all">
			<div id="header" class='padding'>
				<h1>Kundenkarte</h1>
			</div>
			<div id="wrapper">
				<div id="menu" class="padding">
					<h2>Menü</h2>
					<ul>
						<li><a href="?menu=eingeben">Eingeben</a></li>
						<li><a href="?menu=ausgeben">Ausgeben</a></li>
						<li><a href="?menu=anmelden">Anmelden</a></li>
					</ul>
				</div>
				<div id="content" class="padding">
					<?php
/* Anfang: Include-Code einbinden */
if (is_file($includefile))
{
	include($includefile);
}
/* Ende: Include-Code einbinden */
					?>
				</div>
				<?php
					if ($kunde_selected != '')
					{
						echo '<div id="details">';
						echo "<h2>Details</h2>";
						//echo $kunde_selected;
						//echo "<br>";
						$data = "$shop_id,$kunde_selected";
						// API einbinden
						$img = "<img src='qrcode-api.php?data=$data&ec=4&logo=1' alt=''>";
						echo $img;
						echo "<p><a href='pdf-api.php?data=$data'>Download</a><p>";
						echo "</div>";
					}
				?>
			</div>
			<div id="footer" class="padding">
				<p>Shop-Id: <?php echo $shop_id; ?> :: Moderner Browser erforderlich</p>
			</div>
		</div>
	</body>
</html>
