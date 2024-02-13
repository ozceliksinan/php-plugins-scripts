<?php

session_start();
$sifre = substr(md5(rand(0, 999999999999)), -6);
if ($sifre) {
    $_SESSION["guv"] = $sifre;
    $width = 100;
    $height = 30;
    $resim = ImageCreate($width, $height);
    $beyaz = ImageColorAllocate($resim, 255, 255, 255);
    $rand = ImageColorAllocate($resim, rand(0, 255), rand(0, 255), rand(0, 255));
    ImageFill($resim, 0, 0, $rand);
    ImageString($resim, 5, 24, 7, $_SESSION["guv"], $beyaz);
    ImageLine($resim, 100, 19, 0, 19, $beyaz);
    header("Content,type:image/png");
    ImagePng($resim);
    ImageDestroy($resim);
}

?>