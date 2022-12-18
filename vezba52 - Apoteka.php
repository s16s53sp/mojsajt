<?php

$kolicina1 = $_POST['kolicina1'];
$kolicina2 = $_POST['kolicina2'];
$kolicina3 = $_POST['kolicina3'];
$adresa = $_POST['adresa'];
$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
?>
<?php
$date = date('H:i jS F');
echo "<p>Roba narucena u " . $date . "</p>";

echo "<p>Kupili ste sledece artikle: </p>";
$ukupno = 0;
$ukupno = $kolicina1 + $kolicina2 + $kolicina3;
echo "Kupljenih proizvoda: " . $ukupno . "</br>";

if ($ukupno == 0) {
	echo "Nista niste kupili!</br>";
}
else {
	if ($kolicina1 > 0)
		echo $kolicina2 . " andol</br>";
	if ($kolicina2 > 0)
		echo $kolicina2 . " aspirin</br>";
	if ($kolicina3 > 0)
		echo $kolicina3 . " vitamin C</br>";
}

$ukupna_cena = 0.00;
define('cena1', 100);
define('cena2', 10);
define('cena3', 4);
$ukupna_cena = $kolicina1 * cena1 + $kolicina2 * cena2 + $kolicina3 * cena3;
$ukupna_cena = number_format($ukupna_cena, 2, '.', ' ');

echo "<p>Racun - suma: " . $ukupna_cena . "</p>";
echo "<p>Adresa za isporuku " . $adresa . "</p>";

$izlaz = $date . "\t" . $kolicina1 . "andol \t" . $kolicina2 . "aspirin\t" . $kolicina3 . 
"vitamin C\t\$" . $ukupna_cena . "\t" . $adresa . "\n\n";

// Otvaranje fajla za upis
@ $fp = fopen("$DOCUMENT_ROOT/../narudzbina.txt", "rb");
flock($fp, LOCK_EX); // Zakljucaj datoteku radi upisivanja
if (!$fp) {
	echo "<p><strong> Vasa porudzbina ne moze biti obradjena trenutno.
	Pokusajte kasnije.</strong></p>";
	exit;
}
fwrite($fp, $izlaz, strlen($izlaz));
flock($fp, LOCK_UN); // Otkljucaj datoteku
fclose($fp);
echo "<p>Upisani podaci u fajl.</p>";
?>
