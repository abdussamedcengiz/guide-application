<?php
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
            const ad = form.querySelector('[id="ad"]').value;
            const mobil = form.querySelector('[id="mobil"]').value;
            const evno = form.querySelector('[id="evno"]').value;
            const eposta = form.querySelector('[id="eposta"]').value;
            const new_mobil= form.querySelector('[id="new_mobil"]').value;
            const new_evno = form.querySelector('[id="new_evno"]').value;
            const newAd = form.querySelector('[name="new_Ad"]').value;
            const newMobil = form.querySelector('[id="new_mobil"]').value;
            const newEvno = form.querySelector('[id="new_evno"]').value;
            const newEposta = form.querySelector('[name="new_Eposta"]').value;
            const id = form.querySelector('[id="id"]') ? form.querySelector('[id="id"]').value : null;

            
            const phoneRegex = /^\d{11}$/;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const idRegex = /^\d+$/;

            // if (!phoneRegex.test(mobil)) {
            //     alert('Lütfen geçerli bir cep numarası girin (11 haneli).');
            //     event.preventDefault();
            //     return false;
                
            // }

            // if (evno && !phoneRegex.test(evno)) {
            //     alert('Lütfen geçerli bir ev numarası girin (11 haneli).');
            //     event.preventDefault();
            //     return false;
            // }

            // if (!emailRegex.test(eposta)) {
            //     alert('Lütfen geçerli bir email adresi girin.');
            //     event.preventDefault();
            //     return false;
            // }

            // if (id && !idRegex.test(id)) {
            //     alert('Lütfen geçerli bir ID girin (sadece sayılar).');
            //     event.preventDefault();
            //     return false;
            // }

            // if (!ad || !adres) {
            //     alert('Lütfen tüm alanları doldurun.');
            //     event.preventDefault();
            //     return false;
            // }
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
        
        <form  action="kaydet.php" method="post" onsubmit="return validateForm(event)">
            <table >
                <tr >
                    <th>ID</th>
                    <th>Ad</th>
                    <th>Mobil</th>
                    <th>Ev No</th>
                    <th>Email</th>
                    <th>Adres</th>
                    <th>Sil</th>
                </tr>
                <?php foreach ($contacts as $contact): ?>
                    <tr>
                        <td><input type="number" id="id"  name="id[]" value="<?= htmlspecialchars($contact['id']) ?>" readonly></td>
                        <td><input type="text" id="ad" name="Ad[]" value="<?= htmlspecialchars($contact['Ad']) ?>"></td>
                        <td><input type="text" id="mobil" name="Mobil[]" value="<?= htmlspecialchars($contact['Mobil']) ?>"></td>
                        <td><input type="text" id="evno" name="Evno[]" value="<?= htmlspecialchars($contact['Evno']) ?>"></td>
                        <td><input type="email" id="eposta" name="Eposta[]" value="<?= htmlspecialchars($contact['Eposta']) ?>"></td>
                        <td><input type="text" id="adres" name="Adres[]" value="<?= htmlspecialchars($contact['Adres']) ?>"></td>
                        <td><input type="checkbox" name="delete[]" value="<?= htmlspecialchars($contact['id']) ?>" class="checkbox"></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            
            <table>
                <tr>
                    <td><input type="text"  name="new_Ad" placeholder="Ad"></td>
                    <td><input type="text" id="new_mobil" name="new_Mobil" placeholder="Mobil"></td>
                    <td><input type="text" id="new_evno" name="new_Evno" placeholder="Ev No"></td>
                    <td><input type="email" name="new_Eposta" placeholder="Email"></td>
                    <td><input type="text" name="new_Adres" placeholder="Adres"></td>
                    <td><input type="submit" value="Kaydet"></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
