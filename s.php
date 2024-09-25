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
            max-width: 1200px;
            width: 100%;
            box-sizing: border-box;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        td {
            background-color: #f8f9fa;
        }

        input[type="text"], input[type="email"], input[type="number"] {
            width: 90%;
            padding: 5px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            padding: 10px;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Rehber Listeleme ve Güncelleme</h2>
        <?php if ($message): ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>
        
        <table>
            <tr>
                <th>ID</th>
                <th>Ad</th>
                <th>Mobil</th>
                <th>Ev No</th>
                <th>Email</th>
                <th>Adres</th>
                <th>Güncelle</th>
                <th>Sil</th>
            </tr>
            <?php foreach ($contacts as $contact): ?>
                <tr>
                    <form action="guncelle.php" method="post">
                        <td><input type="number" name="id" value="<?= htmlspecialchars($contact['id']) ?>" readonly></td>
                        <td><input type="text" name="Ad" value="<?= htmlspecialchars($contact['Ad']) ?>"></td>
                        <td><input type="text" name="Mobil" value="<?= htmlspecialchars($contact['Mobil']) ?>"></td>
                        <td><input type="text" name="Evno" value="<?= htmlspecialchars($contact['Evno']) ?>"></td>
                        <td><input type="email" name="Eposta" value="<?= htmlspecialchars($contact['Eposta']) ?>"></td>
                        <td><input type="text" name="Adres" value="<?= htmlspecialchars($contact['Adres']) ?>"></td>
                        <td><input type="submit" value="Güncelle"></td>
                    </form>
                    <td>
                        <form action="silme.php" method="post" onsubmit="return confirm('Bu kişiyi silmek istediğinizden emin misiniz?');">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($contact['id']) ?>">
                            <input type="submit" value="Sil" style="background-color: #dc3545; border: none; color: white; padding: 10px; border-radius: 4px; cursor: pointer;">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html> -->


<!-- 
foreach ($ids as $index => $id) {
    if (in_array($id, $deleteIds)) continue;

    // Önce güncelleme için gereken verileri alıyoruz
    $stmt = $db->prepare("SELECT Ad, Mobil, Evno, Eposta, Adres FROM kisi_bilgisi WHERE id=?");
    $stmt->execute([$id]);
    $existingData = $stmt->fetch(PDO::FETCH_ASSOC);

    // Sadece değişen alanları güncellemek için bir dizi hazırlıyoruz
    $updateFields = [];
    $updateValues = [];

    $newData = [
        'Ad' => $ads[$index],
        'Mobil' => $mobils[$index],
        'Evno' => $evnos[$index],
        'Eposta' => $epostas[$index],
        'Adres' => $adresler[$index],
    ];

    foreach ($newData as $key => $value) {
        if ($existingData[$key] !== $value) {
            $updateFields[] = "$key=?";
            $updateValues[] = $value;
        }
    }

    // Eğer güncellenmesi gereken alanlar varsa, güncelleme sorgusunu çalıştırıyoruz
    if (!empty($updateFields)) {
        $updateValues[] = $id;
        $stmt = $db->prepare("UPDATE kisi_bilgisi SET " . implode(", ", $updateFields) . " WHERE id=?");
        $stmt->execute($updateValues);
    }
}
 -->
