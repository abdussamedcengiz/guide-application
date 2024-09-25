<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Telefon Rehberi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e9ecef;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 800px;
            width: 100%;
            box-sizing: border-box;
            text-align: center;
        }

        .profile-pic {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin: 0 auto 20px;
            object-fit: cover;
            border: 3px solid #007bff;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
            font-size: 24px;
        }

        .form-wrapper {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: center;
        }

        .form-wrapper form {
            flex: 1;
            min-width: 280px;
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 1px solid #ccc;
            transition: box-shadow 0.3s ease, border-color 0.3s ease;
            max-width: 350px;
        }

        .form-wrapper form:hover {
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            border-color: #007bff;
        }

        .form-wrapper form h3 {
            margin-top: 0;
            color: #007bff;
            font-size: 18px;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        .form-group input[type="text"], 
        .form-group input[type="email"], 
        .form-group input[type="number"] {
            width: calc(100% - 20px);
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            box-sizing: border-box;
        }

        .form-group input[type="submit"] {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            padding: 10px;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
            box-sizing: border-box;
        }

        .form-group input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .form-group input[type="submit"]:focus {
            outline: none;
        }

        .button-group {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
    </style>
    <script>
        function validateForm(event) {
            const form = event.target;
            const ad = form.querySelector('[name="Ad"]').value;
            const mobil = form.querySelector('[name="Mobil"]').value;
            const evno = form.querySelector('[name="Evno"]').value;
            const eposta = form.querySelector('[name="Eposta"]').value;
            const adres = form.querySelector('[name="Adres"]').value;
            const id = form.querySelector('[name="id"]') ? form.querySelector('[name="id"]').value : null;

            
            const phoneRegex = /^\d{11}$/;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const idRegex = /^\d+$/;

            if (!phoneRegex.test(mobil)) {
                alert('Lütfen geçerli bir cep numarası girin (11 haneli).');
                event.preventDefault();
                return false;
                
            }

            if (evno && !phoneRegex.test(evno)) {
                alert('Lütfen geçerli bir ev numarası girin (11 haneli).');
                event.preventDefault();
                return false;
            }

            if (!emailRegex.test(eposta)) {
                alert('Lütfen geçerli bir email adresi girin.');
                event.preventDefault();
                return false;
            }

            if (id && !idRegex.test(id)) {
                alert('Lütfen geçerli bir ID girin (sadece sayılar).');
                event.preventDefault();
                return false;
            }

            if (!ad || !adres) {
                alert('Lütfen tüm alanları doldurun.');
                event.preventDefault();
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
    <div class="container">
        <img src="path/to/profile-pic.jpg" alt="Kişinin Fotoğrafı" class="profile-pic">
        <h2>Telefon Rehberi</h2>
        <div class="form-wrapper">
            <!-- Kayıt Formu -->
            <form action="kaydet.php" method="post" onsubmit="return validateForm(event)">
                <h3>Yeni Kayıt</h3>
                <div class="form-group">
                    <label for="ad">Ad:</label>
                    <input type="text" id="ad" name="Ad" placeholder="Adınızı girin" required>
                </div>
                <div class="form-group">
                    <label for="mobil">Cep No:</label>
                    <input type="text" id="mobil" name="Mobil" placeholder="Cep numaranızı girin" required>
                </div>
                <div class="form-group">
                    <label for="evno">Ev No:</label>
                    <input type="text" id="evno" name="Evno" placeholder="Ev numaranızı girin" required>
                </div>
                <div class="form-group">
                    <label for="eposta">Email:</label>
                    <input type="email" id="eposta" name="Eposta" placeholder="Email adresinizi girin" required>
                </div>
                <div class="form-group">
                    <label for="adres">Adres:</label>
                    <input type="text" id="adres" name="Adres" placeholder="Adresinizi girin" required>
                </div>
                <div class="button-group">
                    <input type="submit" value="Kaydet">
                </div>
            </form>

            <!-- Güncelleme Formu -->
            <form action="guncelle.php" method="post" onsubmit="return validateForm(event)">
                <h3>Güncelle</h3>
                <div class="form-group">
                    <label for="id">ID:</label>
                    <input type="number" id="id" name="id" placeholder="Kişinin ID'sini girin" required>
                </div>
                <div class="form-group">
                    <label for="ad">Ad:</label>
                    <input type="text" id="ad" name="Ad" placeholder="Adınızı girin" required>
                </div>
                <div class="form-group">
                    <label for="mobil">Cep No:</label>
                    <input type="text" id="mobil" name="Mobil" placeholder="Cep numaranızı girin" required>
                </div>
                <div class="form-group">
                    <label for="evno">Ev No:</label>
                    <input type="text" id="evno" name="Evno" placeholder="Ev numaranızı girin" required>
                </div>
                <div class="form-group">
                    <label for="eposta">Email:</label>
                    <input type="email" id="eposta" name="Eposta" placeholder="Email adresinizi girin" required>
                </div>
                <div class="form-group">
                    <label for="adres">Adres:</label>
                    <input type="text" id="adres" name="Adres" placeholder="Adresinizi girin" required>
                </div>
                <div class="button-group">
                    <input type="submit" value="Güncelle">
                </div>
            </form>

            <!-- Silme Formu -->
            <form action="silme.php" method="post" onsubmit="return validateForm(event)">
                <h3>Sil</h3>
                <div class="form-group">
                    <label for="id">ID:</label>
                    <input type="number" id="id" name="id" placeholder="Silinecek kişinin ID'sini girin" required>
                </div>
                <div class="button-group">
                    <input type="submit" value="Sil">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
