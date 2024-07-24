<?php
function oturumkontrol()
{
	if (!isset($_SESSION['kul_mail']) or !isset($_SESSION['kul_isim']) or !isset($_SESSION['kul_id'])) {
		session_destroy();
		header("location:login.php");
		exit;
	}
}

?>