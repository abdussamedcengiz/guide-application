<!-- <?php
include "config.php";

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST["id"]) ? intval($_POST["id"]) : null;
    $ad = $_POST["Ad"];
    $mobil = $_POST["Mobil"];
    $evno = $_POST["Evno"];
    $eposta = $_POST["Eposta"];
    $adres = $_POST["Adres"];

    if ($id !== null) {
        // Güncelleme işlemini yap
        $stmt = $db->prepare("UPDATE kisi_bilgisi SET Ad = ?, Mobil = ?, Evno = ?, Eposta = ?, Adres = ? WHERE id = ?");
        $result = $stmt->execute([$ad, $mobil, $evno, $eposta, $adres, $id]);

        if ($result) {
            $message = "$ad adlı kişi başarıyla güncellendi.";
        } else {
            $message = "Güncelleme sırasında bir hata oluştu.";
        }
    } else {
        $message = "ID hatalı veya mevcut değil.";
    }

    header("Location: listele.php?message=" . urlencode($message));
    exit();
} else {
    $id = isset($_GET["id"]) ? intval($_GET["id"]) : null;
    $data = null;

    if ($id !== null) {
        $stmt = $db->prepare("SELECT * FROM kisi_bilgisi WHERE id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    if (!$data) {
        $message = "Kayıt bulunamadı.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Telefon Rehberi - Güncelle</title>
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
            const id = form.querySelector('[name="id"]').value;

            const phoneRegex = /^\d{11}$/;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

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
        <h2>Telefon Rehberi - Güncelle</h2>
        <?php if ($message): ?>
            <p><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>
        <?php if ($data): ?>
            <form action="guncelle_form.php" method="post" onsubmit="return validateForm(event)">
                <h3>Güncelle</h3>
                <div class="form-group">
                    <label for="id">ID:</label>
                    <input type="number" id="id" name="id" value="<?php echo htmlspecialchars(isset($data['id'])); ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="ad">Ad:</label>
                    <input type="text" id="ad" name="Ad" value="<?php echo htmlspecialchars( $data['Ad']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="mobil">Cep No:</label>
                    <input type="text" id="mobil" name="Mobil" value="<?php echo htmlspecialchars($data['Mobil']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="evno">Ev No:</label>
                    <input type="text" id="evno" name="Evno" value="<?php echo htmlspecialchars($data['Evno']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="eposta">Email:</label>
                    <input type="email" id="eposta" name="Eposta" value="<?php echo htmlspecialchars($data['Eposta']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="adres">Adres:</label>
                    <input type="text" id="adres" name="Adres" value="<?php echo htmlspecialchars($data['Adres']); ?>" required>
                </div>
                <div class="button-group">
                    <input type="submit" value="Güncelle">
                </div>
            </form>
        <?php else: ?>
            <p>Kayıt bulunamadı.</p>
        <?php endif; ?>
    </div>
</body>
</html> -->
