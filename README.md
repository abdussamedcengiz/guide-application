# Telefon Rehberi (PHP)

Framework kullanmadan, saf PHP ve PDO ile yazilmis telefon rehberi. Kisiler
listeleniyor, ayni sayfadan toplu olarak duzenlenip silinebiliyor ve yeni kisi
eklenebiliyor.

## Ozellikler

- Kisi ekleme, listeleme, guncelleme, silme
- Tek formdan **toplu** guncelleme ve silme; islemler `beginTransaction` ile
  tek bir islem butunu olarak yurutuluyor
- Sorgular `prepare` ile hazirlaniyor (SQL enjeksiyonuna karsi)
- Ekrana basilan degerler `htmlspecialchars` ile kacisliyor

## Dosyalar

| Dosya | Gorevi |
|---|---|
| `config.php` | PDO baglantisi |
| `listele.php` | Kisi listesi + duzenleme formu (ana sayfa) |
| `rehper.php` | Yeni kisi ekleme formu |
| `kaydet.php` | Toplu ekleme/guncelleme/silme islemi |
| `guncelle_form.php`, `guncelle.php` | Tek kisi guncelleme |
| `silme.php` | Tek kisi silme |
| `s.php`, `t.php` | `listele.php`'nin eski kopyalari; tamami yorum satirinda, kullanilmiyor |

## Kurulum

1. `rehper` adinda bir MySQL veritabani olusturun.
2. Tabloyu olusturun:

```sql
CREATE TABLE kisi_bilgisi (
  id     INT AUTO_INCREMENT PRIMARY KEY,
  Ad     VARCHAR(100),
  Mobil  VARCHAR(20),
  Evno   VARCHAR(20),
  Eposta VARCHAR(100),
  Adres  TEXT
);
```

3. `config.local.example.php` dosyasini `config.local.php` olarak kopyalayip
   veritabani bilgilerinizi yazin:

```bash
cp config.local.example.php config.local.php
```

   Ayarlar bilerek `.env` yerine bir PHP dosyasinda tutuluyor: bu projede
   dosyalar dogrudan site kokunden servis edildigi icin koke konan bir `.env`
   tarayicidan duz metin olarak okunabiliyor. PHP dosyasi istendiginde
   calistiriliyor ve disariya hicbir sey yazmiyor.
4. Klasoru bir PHP sunucusunda calistirin:

```bash
php -S localhost:8000
```

Ardindan `http://localhost:8000/listele.php` adresini acin.

## Guvenlik notu

Bu depo 2024'ten 2026'ya kadar veritabani sifresini `config.php` icinde duz
metin olarak tasidi. Sifre koddan cikarildi ama **git gecmisinde duruyor**:
eski commit'ler herkese acik oldugu icin okunmaya devam edebilir. Gecmis
bilerek yeniden yazilmadi (force-push depodaki tum commit kimliklerini
degistirir).

Bu yuzden o sifre **yanmis sayilmalidir**: baska bir yerde kullanildiysa
degistirilmeli, bu projede de yeni bir sifre secilmeli.

## Bilinen eksikler

- `s.php` ve `t.php` olu dosyalar, silinebilir.
- Stil her sayfanin icine `<style>` olarak gomulu; ortak bir CSS dosyasina
  cikarilabilir.
