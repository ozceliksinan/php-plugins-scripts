<?php
$host = "localhost";
$veritabani_ismi = "projetakip";
$kullanici_adi = "root";
$sifre = "";
try {
	$db = new PDO("mysql:host=$host;dbname=$veritabani_ismi;charset=utf8", $kullanici_adi, $sifre);
	//echo "veritabanı bağlantısı başarılı";
} catch (PDOExpception $e) {
	echo $e->getMessage();
}
$api_key = "";
?>