<?php
$dbh = mysql_connect("localhost", "username", "password") or die('I cannot connect to the database because: ' . mysql_error());
mysql_select_db("yourdb");
mysql_query("SET NAMES 'UTF8'");

function kodlar($text)
{
    $sonuc = str_replace("\"", "&quot;", $text);
    $sonuc = str_replace("'", "&#39;", $sonuc);
    $sonuc = str_replace(">", "&gt;", $sonuc);
    $sonuc = str_replace("<", "&lt;", $sonuc);
    return $sonuc;
}

function terskodlar($text)
{
    $sonuc = str_replace("&quot;", "\"", $text);
    $sonuc = str_replace("&#39;", "'", $sonuc);
    $sonuc = str_replace("&gt;", ">", $sonuc);
    $sonuc = str_replace("&lt;", "<", $sonuc);
    return $sonuc;
}

function seolink($deger)
{
    $turkce = array("ş", "Ş", "ı", "(", ")", "'", "ü", "Ü", "ö", "Ö", "ç", "Ç", " ", "/", "*", "?", "-", "ş", "Ş", "ı", "ğ", "Ğ", "İ", "ö", "Ö", "Ç", "ç", "ü", "Ü");
    $duzgun = array("s", "S", "i", "", "", "", "u", "U", "o", "O", "c", "C", "_", "_", "_", "", "_", "s", "S", "i", "g", "G", "I", "o", "O", "C", "c", "u", "U");
    $deger = str_replace($turkce, $duzgun, $deger);
    $deger = str_replace("@[^A-Za-z0-9\-_]+@i", "", $deger);
    return $deger;
}

error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set("UTC");

$gidecekposta = "post@yourdomain.com";
$gonderecekposta = "smtp@yourdomain.com";
$sunucu = "smtp.yourdomain.com";
$port = "465";
$msifre = "smtppassword";
?>