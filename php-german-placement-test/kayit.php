<?php include "../config.php"; ?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>İngilizce Seviye Tespit Sınavı</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Sinan Özçelik">
    <link href="images/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="images/bootstrap-responsive.css" rel="stylesheet" media="screen">
    <script src="images/jquery-1.9.1.js"></script>
    <link href="images/style.css" rel="stylesheet" media="screen">
</head>

<body>
    <?php
    error_reporting(E_ALL ^ E_NOTICE);
    ini_set('error_reporting', E_ALL ^ E_NOTICE);

    session_start();
    header('Content-type: text/html; charset=utf8');

    if (isset($_POST['guvenlikKodu']) && $_POST['guvenlikKodu']) {
        $guvenlikKontrol = false;
        if ($_POST['guvenlikKodu'] == $_SESSION['guvenlikKodu']) {
            $guvenlikKontrol = true;
        }

        if ($guvenlikKontrol) {
            $sayi = 0;

            if ($_POST['soru1'] == "c") {
                $sayi++;
            }
            if ($_POST['soru2'] == "d") {
                $sayi++;
            }
            if ($_POST['soru3'] == "a") {
                $sayi++;
            }
            if ($_POST['soru4'] == "b") {
                $sayi++;
            }
            if ($_POST['soru5'] == "d") {
                $sayi++;
            }
            if ($_POST['soru6'] == "c") {
                $sayi++;
            }
            if ($_POST['soru7'] == "a") {
                $sayi++;
            }
            if ($_POST['soru8'] == "b") {
                $sayi++;
            }
            if ($_POST['soru9'] == "c") {
                $sayi++;
            }
            if ($_POST['soru10'] == "c") {
                $sayi++;
            }

            if ($_POST['soru11'] == "a") {
                $sayi++;
            }
            if ($_POST['soru12'] == "b") {
                $sayi++;
            }
            if ($_POST['soru13'] == "b") {
                $sayi++;
            }
            if ($_POST['soru14'] == "a") {
                $sayi++;
            }
            if ($_POST['soru15'] == "c") {
                $sayi++;
            }
            if ($_POST['soru16'] == "a") {
                $sayi++;
            }
            if ($_POST['soru17'] == "c") {
                $sayi++;
            }
            if ($_POST['soru18'] == "a") {
                $sayi++;
            }
            if ($_POST['soru19'] == "b") {
                $sayi++;
            }
            if ($_POST['soru20'] == "d") {
                $sayi++;
            }

            if ($_POST['soru21'] == "a") {
                $sayi++;
            }
            if ($_POST['soru22'] == "b") {
                $sayi++;
            }
            if ($_POST['soru23'] == "c") {
                $sayi++;
            }
            if ($_POST['soru24'] == "a") {
                $sayi++;
            }
            if ($_POST['soru25'] == "d") {
                $sayi++;
            }
            if ($_POST['soru26'] == "b") {
                $sayi++;
            }
            if ($_POST['soru27'] == "a") {
                $sayi++;
            }
            if ($_POST['soru28'] == "c") {
                $sayi++;
            }
            if ($_POST['soru29'] == "d") {
                $sayi++;
            }
            if ($_POST['soru30'] == "b") {
                $sayi++;
            }

            if ($_POST['soru31'] == "c") {
                $sayi++;
            }
            if ($_POST['soru32'] == "c") {
                $sayi++;
            }

            if ($sayi >= 8 and $sayi < 11) {
                $sonuc = "A1 testini geçti. Seviyesi A2.";
            } else if ($sayi >= 16 and $sayi < 21) {
                $sonuc = "A2 testini geçtiniz. Seviyeniz B1.";
            } else if ($sayi >= 24 and $sayi < 31) {
                $sonuc = "B1 testini geçtiniz. Seviyeniz B2.";
            } else if ($sayi >= 32 and $sayi < 41) {
                $sonuc = "B2 testini geçtiniz. Seviyeniz C1.";
            } else if ($sayi >= 40 and $sayi < 51) {
                $sonuc = "C1 testini geçtiniz. Seviyeniz C2.";
            } else if ($sayi >= 48 and $sayi < 61) {
                $sonuc = "C2 testini geçtiniz.";
            } else {
                $sonuc = "A1 testini geçemediniz.";
            }
            ?>
            <?php
            $body = "Testi Dolduranın;
<table width=\"512\" border=\"0\"  cellpadding=\"2\" cellspacing=\"3\">
                               <tr>
                                <td width=\"157\" height=\"30px\"><strong>Ad Soyad:</strong> " . $_POST['isim'] . "</td></tr>
			<tr>
                                <td height=\"30\"><strong>E-mail :</strong> " . $_POST['mail'] . "</td></tr>
			<tr>
                                <td height=\"30\"><strong>Telefon:</strong> " . $_POST['telefon'] . "</td></tr>
			<tr>
                                <td height=\"30\"><strong>Oturduğu İlçe:</strong> " . $_POST['ilce'] . "</td></tr>
			<tr>
                                <td height=\"30\"><strong>İlgilendiği Kurs Dönemi:</strong> " . $_POST['donem'] . "</td></tr>
			<tr>
                                <td height=\"30\"><strong>İlgilendiği Kurs Zamanı:</strong> " . $_POST['zaman'] . "</td></tr>
			
			<tr>
                                <td ><strong>Seviyesi : " . $sonuc . "</strong></td></tr></table>
						   
						   ";

            require_once 'class.phpmailer.php';

            $mail = new PHPMailer();
            $mail->From = $gonderecekposta;
            ;
            $mail->FromName = 'Firma Adı Yabancı Dil Kursu';
            $mail->AddAddress($gidecekposta, 'Firma Adı');
            $mail->Subject = "Firma Adı - Almanca Seviye Tespit Sınavı - " . $_POST['mail'] . "";
            $mail->Body = "$body";
            $mail->IsHTML(true);
            $mail->SetLanguage("tr", "phpmailer/language");
            $mail->CharSet = "utf-8";
            $mail->SMTPDebug = 1;
            $mail->SMTPSecure = 'ssl';

            $mail->Host = $sunucu;
            $mail->Port = $port;
            $mail->SMTPAuth = true;
            $mail->Username = $gonderecekposta;
            $mail->Password = $msifre;

            if (!$mail->Send()) {
                echo " <div class=\"container-fluid\" style=\"margin-top: 50px !important;\">
			<div class=\"alert alert-danger\"><strong>Form gönderilirken bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.
			</strong></div></div>
			";
                header("refresh:8;url=index.html");
            } else {

                echo " <div class=\"container-fluid\" style=\"margin-top: 50px !important;\">
		<div class=\"alert alert-success\">
 <h4>Test sonucunuz başarıyla e-posta adresinize gönderilmiştir.</h4>
  <span>En kısa sürede sizinle iletişime geçilecektir.</span>
  </div></div>";
                header("refresh:8;url=index.html");

            }

            ?>
            <?php
        }
    } else {
        echo "
		 <div class=\"container-fluid\" style=\"margin-top: 50px !important;\">
		 <div class=\"alert alert-danger\"><h4>Doğrulama kodunu yanlış girdiniz... </h4>
			<p>Lütfen tekrar deneyin. Form doğrulama yapma sebebimiz robotları veya kötü amaçlı kullanıcıları engellemek içindir.</p></div>
			</div>
			";
        header("refresh:8;url=index.html");
    }
    ?>
</body>

</html>