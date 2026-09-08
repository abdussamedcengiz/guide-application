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

3. `.env.example` dosyasini `.env` olarak kopyalayip veritabani bilgilerinizi
   yazin:

```bash
cp .env.example .env
```
4. Klasoru bir PHP sunucusunda calistirin:

```bash
php -S localhost:8000
```

Ardindan `http://localhost:8000/listele.php` adresini acin.

## Bilinen eksikler

- `s.php` ve `t.php` olu dosyalar, silinebilir.
- Stil her sayfanin icine `<style>` olarak gomulu; ortak bir CSS dosyasina
  cikarilabilir.
