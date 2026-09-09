<?php
// Bu dosyayi config.local.php olarak kopyalayip kendi bilgilerinizi yazin.
// config.local.php .gitignore'da; depoya gonderilmez.
//
// Ayarlar neden .env yerine PHP dosyasinda tutuluyor?
// Bu proje bir cerceve kullanmiyor, dosyalar dogrudan site kokunden servis
// ediliyor. Kokteki bir .env dosyasi tarayicidan duz metin olarak
// okunabiliyor (http://site/.env -> HTTP 200 ve sifre ekranda). PHP dosyasi
// ise istendiginde calistiriliyor, sadece dizi donduruyor ve disariya hicbir
// sey yazmiyor -- yani sunucu ayari yapmadan da guvenli.
return [
    "DB_HOST"     => "localhost",
    "DB_NAME"     => "rehper",
    "DB_USER"     => "root",
    "DB_PASSWORD" => "",
];
