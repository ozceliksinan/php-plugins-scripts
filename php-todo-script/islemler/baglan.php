<?php
ob_start();
session_start();

$host = "localhost";
$veritabani_ismi = "todo";
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