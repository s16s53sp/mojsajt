<?php
$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
?>

<html>
	<head>
		<title>Apoteka</title>
	</head>
	<body>
		<h1>Online apoteka</h1>
		<h2>Kupljena roba</h2>

<?php

@ $fp = fopen("$DOCUMENT_ROOT/../narudzbina.txt", "rb");
flock($fp, LOCK_SH); // Zakljucaj datoteku radi citanja

if (!$fp) {
	echo "<p><strong>Pokusajte kasnije.</strong></p>";
	exit;
}

while (!feof($fp)) {
	$order = fgets($fp, 999);
	echo $order . "</br>";
}

echo "Poslednja pozicija pokazivaca u fajlu je " . (ftell($fp)) . "</br>";
rewind($fp);
echo "Posle f-je rewind, pozicija je " . (ftell($fp)) . "</br>";
flock($fp, LOCK_UN); // Otkljucaj datoteku
fclose($fp);
?>

</body>
</html>