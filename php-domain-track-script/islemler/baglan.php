<?php
date_default_timezone_set('Europe/Istanbul');

session_start();

$host = "localhost";
$veritabani_ismi = "domaintakip";
$kullanici_adi = "root";
$sifre = "";

try {
	$db = new PDO("mysql:host=$host;dbname=$veritabani_ismi;charset=utf8", $kullanici_adi, $sifre);
} catch (PDOException $e) {
	echo $e->getmessage();
}

$sorgu = $db->prepare("SELECT * FROM ayarlar");
$sorgu->execute();
$ayarcek = $sorgu->fetch(PDO::FETCH_ASSOC);

?>