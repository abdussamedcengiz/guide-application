<?php
include "config.php"; 

$id = isset($_POST["id"]) ? $_POST["id"] : null;
$Ad = isset($_POST["Ad"]) ? $_POST["Ad"] : null;
$Mobil = isset($_POST["Mobil"]) ? $_POST["Mobil"] : null;
$Evno = isset($_POST["Evno"]) ? $_POST["Evno"] : null;
$Eposta = isset($_POST["Eposta"]) ? $_POST["Eposta"] : null;
$Adres = isset($_POST["Adres"]) ? $_POST["Adres"] : null;


if ($id && $Ad && $Mobil && $Evno && $Eposta && $Adres) {
    
    $str = $db->prepare("UPDATE kisi_bilgisi SET Ad=?, Mobil=?, Evno=?, Eposta=?, Adres=? WHERE id=?");

    
    if ($str->execute([$Ad, $Mobil, $Evno, $Eposta, $Adres, $id])) {
        $message = "$Ad adlı kişi başarıyla güncellendi.";
    } else {
        $message = "Güncelleme başarısız.";
    }
} else {
    $message = "Lütfen tüm alanları doldurduğunuzdan emin olun.";
}


header("Location: listele.php?message=" . urlencode($message) . "&id=" . urlencode($id));
exit();
?>
