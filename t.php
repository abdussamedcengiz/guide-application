<!-- <?php
include "config.php";
$message = isset($_GET['message']) ? htmlspecialchars($_GET['message']) : "";

// Veritabanından tüm kişileri çekin
$str = $db->prepare("SELECT id, Ad, Mobil, Evno, Eposta, Adres FROM kisi_bilgisi");
$str->execute();
$contacts = $str->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rehber Listeleme</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #ffffff;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: rgba(255, 255, 255, 0.85);
            border-radius: 20px;
            padding: 40px;
            max-width: 1200px;
            width: 100%;
            box-sizing: border-box;
            text-align: center;
            backdrop-filter: blur(10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            transition: transform 0.4s ease, box-shadow 0.4s ease;
        }

        .container:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
        }

        h2 {
            color: #333;
            font-size: 34px;
            margin-bottom: 30px;
            font-weight: 800;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            font-size: 16px;
            border-radius: 12px;
            overflow: hidden;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #ff6b81;
            color: white;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        td {
            background-color: rgba(255, 255, 255, 0.85);
            transition: background-color 0.4s ease, transform 0.2s ease;
            border-left: 3px solid transparent;
        }

        td:hover {
            background-color: #f1f3f5;
            border-left: 3px solid #ff6b81;
            transform: translateX(5px);
        }

        input[type="text"], input[type="email"], input[type="number"] {
            width: 100%;
            padding: 12px;
            font-size: 14px;
            border: 1px solid #ced4da;
            border-radius: 8px;
            box-sizing: border-box;
            margin-bottom: 10px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease, transform 0.2s ease;
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(5px);
        }

        input[type="text"]:focus, input[type="email"]:focus, input[type="number"]:focus {
            border-color: #ff6b81;
            box-shadow: 0 0 8px rgba(255, 107, 129, 0.25);
            transform: translateY(-2px);
            background: rgba(255, 255, 255, 1);
        }

        input[type="submit"] {
            background: linear-gradient(135deg, #ff6b81, #ff9a9e);
            color: #ffffff;
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 8px 15px rgba(255, 107, 129, 0.3);
        }

        input[type="submit"]:hover {
            background: linear-gradient(135deg, #ff9a9e, #ff6b81);
            transform: translateY(-4px);
            box-shadow: 0 10px 20px rgba(255, 107, 129, 0.4);
        }

        .checkbox {
            width: 20px;
            height: 20px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .checkbox:hover {
            transform: scale(1.1);
        }

        table tr:last-child td {
            border: none;
        }

        .message {
            color: #28a745;
            font-size: 18px;
            margin-bottom: 20px;
            font-weight: 500;
        }
    </style>
    <script>
       function validateForm(event) {
    const form = event.target;
    const adElements = form.querySelectorAll('[id="ad"]');
    const mobilElements = form.querySelectorAll('[id="mobil"]');
    const evnoElements = form.querySelectorAll('[id="evno"]');
    const epostaElements = form.querySelectorAll('[id="eposta"]');
    const idElements = form.querySelectorAll('[id="id"]');
    const newAd = form.querySelector('[name="new_Ad"]').value;
    const newMobil = form.querySelector('[id="new_mobil"]').value;
    const newEvno = form.querySelector('[id="new_evno"]').value;
    const newEposta = form.querySelector('[name="new_Eposta"]').value;

    const phoneRegex = /^\d{11}$/;
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const idRegex = /^\d+$/;

    // Mevcut (güncellenen) kişiler için doğrulama
    for (let i = 0; i < idElements.length; i++) {
        const ad = adElements[i].value;
        const mobil = mobilElements[i].value;
        const evno = evnoElements[i].value;
        const eposta = epostaElements[i].value;
        const id = idElements[i].value;

        if (mobil && !phoneRegex.test(mobil)) {
            alert('Lütfen geçerli bir cep numarası girin (11 haneli).');
            event.preventDefault();
            return false;
        }

        if (evno && !phoneRegex.test(evno)) {
            alert('Lütfen geçerli bir ev numarası girin (11 haneli).');
            event.preventDefault();
            return false;
        }

        if (eposta && !emailRegex.test(eposta)) {
            alert('Lütfen geçerli bir email adresi girin.');
            event.preventDefault();
            return false;
        }

        if (id && !idRegex.test(id)) {
            alert('Lütfen geçerli bir ID girin (sadece sayılar).');
            event.preventDefault();
            return false;
        }

        if (!ad) {
            alert('Lütfen tüm alanları doldurun.');
            event.preventDefault();
            return false;
        }
    }

    // Yeni eklenen kişi için doğrulama (Boş geçilebilir)
    if (newMobil && !phoneRegex.test(newMobil)) {
        alert('Lütfen geçerli bir cep numarası girin (11 haneli).');
        event.preventDefault();
        return false;
    }

    if (newEvno && !phoneRegex.test(newEvno)) {
        alert('Lütfen geçerli bir ev numarası girin (11 haneli).');
        event.preventDefault();
        return false;
    }

    if (newEposta && !emailRegex.test(newEposta)) {
        alert('Lütfen geçerli bir email adresi girin.');
        event.preventDefault();
        return false;
    }

    // Tüm kontroller geçildi
    return true;
}

    </script>
</head>
<body>
    <div class="container">
        <h2>Rehber Listeleme ve Güncelleme</h2>
        <?php if ($message): ?>
            <p class="message"><?php echo $message; ?></p>
        <?php endif; ?>
        
        <form action="kaydet.php" method="post" onsubmit="return validateForm(event)">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Ad</th>
                    <th>Mobil</th>
                    <th>Ev No</th>
                    <th>Eposta</th>
                    <th>Adres</th>
                    <th>Sil</th>
                </tr>
                <?php foreach ($contacts as $contact): ?>
                    <tr>
                        <td><input type="text" id="id" name="id[]" value="<?php echo htmlspecialchars($contact['id']); ?>" readonly></td>
                        <td><input type="text" id="ad" name="ad[]" value="<?php echo htmlspecialchars($contact['Ad']); ?>"></td>
                        <td><input type="number" id="mobil" name="mobil[]" value="<?php echo htmlspecialchars($contact['Mobil']); ?>"></td>
                        <td><input type="number" id="evno" name="evno[]" value="<?php echo htmlspecialchars($contact['Evno']); ?>"></td>
                        <td><input type="email" id="eposta" name="eposta[]" value="<?php echo htmlspecialchars($contact['Eposta']); ?>"></td>
                        <td><input type="text" id="adres" name="adres[]" value="<?php echo htmlspecialchars($contact['Adres']); ?>"></td>
                        <td><input type="checkbox" class="checkbox" name="delete[]" value="<?php echo $contact['id']; ?>"></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td><input type="text" id="new_id" name="new_id" placeholder="Yeni ID" readonly></td>
                    <td><input type="text" id="new_ad" name="new_Ad" placeholder="Yeni Ad"></td>
                    <td><input type="number" id="new_mobil" name="new_Mobil" placeholder="Yeni Mobil"></td>
                    <td><input type="number" id="new_evno" name="new_Evno" placeholder="Yeni Ev No"></td>
                    <td><input type="email" id="new_eposta" name="new_Eposta" placeholder="Yeni Eposta"></td>
                    <td><input type="text" id="new_adres" name="new_Adres" placeholder="Yeni Adres"></td>
                    <td></td>
                </tr>
            </table>
            <input type="submit" value="Kaydet">
        </form>
    </div>
</body>
</html> -->
