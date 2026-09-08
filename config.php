<?php
// Veritabani bilgileri kodun icinde duz metin olarak tutulmuyor; ayni
// klasordeki .env dosyasindan okunuyor. Boylece sifre depoya girmiyor ve
// her gelistirici kendi yerel bilgilerini kullanabiliyor.
//
// Ek bir kutuphane (composer paketi) yerine PHP'nin yerlesik
// parse_ini_file fonksiyonu kullanildi: .env dosyasi zaten anahtar=deger
// bicimindeki bir ini dosyasiyla ayni yapida ve bu projenin baska hicbir
// bagimliligi yok.
$envDosyasi = __DIR__ . "/.env";

if (!file_exists($envDosyasi)) {
    die(
        "Yapilandirma bulunamadi: .env dosyasi yok. " .
        ".env.example dosyasini .env olarak kopyalayip bilgilerinizi yazin."
    );
}

$env = parse_ini_file($envDosyasi);

$host     = $env["DB_HOST"] ?? "localhost";
$dbname   = $env["DB_NAME"] ?? "rehper";
$user     = $env["DB_USER"] ?? "root";
$password = $env["DB_PASSWORD"] ?? "";

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
