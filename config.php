<?php
// Veritabani bilgileri kodun icinde duz metin olarak tutulmuyor; ayni
// klasordeki config.local.php dosyasindan okunuyor. Boylece sifre depoya
// girmiyor ve her gelistirici kendi yerel bilgilerini kullanabiliyor.
//
// Neden .env degil de PHP dosyasi? Bu projede dosyalar dogrudan site
// kokunden servis ediliyor; kokteki bir .env tarayicidan duz metin olarak
// okunabiliyor (http://site/.env istegi HTTP 200 ve sifreyi donduruyor).
// config.local.php ise istendiginde calistiriliyor, yalnizca dizi
// donduruyor ve ekrana hicbir sey basmiyor.
$ayarDosyasi = __DIR__ . "/config.local.php";

if (!file_exists($ayarDosyasi)) {
    die(
        "Yapilandirma bulunamadi: config.local.php dosyasi yok. " .
        "config.local.example.php dosyasini config.local.php olarak " .
        "kopyalayip bilgilerinizi yazin."
    );
}

$ayarlar = require $ayarDosyasi;

$host     = $ayarlar["DB_HOST"] ?? "localhost";
$dbname   = $ayarlar["DB_NAME"] ?? "rehper";
$user     = $ayarlar["DB_USER"] ?? "root";
$password = $ayarlar["DB_PASSWORD"] ?? "";

$dsn = "mysql:dbname={$dbname};host={$host};charset=utf8mb4";

try {
    $db = new PDO($dsn, $user, $password, [
        // Hatalar sessizce yutulmasin, istisna olarak firlatilsin
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
} catch (PDOException $e) {
    // Hata metni kullaniciya gosterilmiyor: baglanti mesajlari veritabani
    // adi ve kullanici adi gibi bilgileri sizdirabiliyor.
    error_log("Veritabani baglantisi kurulamadi: " . $e->getMessage());
    die("Veritabani baglantisi kurulamadi.");
}
