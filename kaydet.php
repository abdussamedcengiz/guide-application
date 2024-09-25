<?php
include "config.php";

$ids = isset($_POST['id']) ? $_POST['id'] : [];
$ads = isset($_POST['Ad']) ? $_POST['Ad'] : [];
$mobils = isset($_POST['Mobil']) ? $_POST['Mobil'] : [];
$evnos = isset($_POST['Evno']) ? $_POST['Evno'] : [];
$epostas = isset($_POST['Eposta']) ? $_POST['Eposta'] : [];
$adresler = isset($_POST['Adres']) ? $_POST['Adres'] : [];
$deleteIds = isset($_POST['delete']) ? $_POST['delete'] : [];
$newAd = isset($_POST['new_Ad']) ? $_POST['new_Ad'] : null;
$newMobil = isset($_POST['new_Mobil']) ? $_POST['new_Mobil'] : null;
$newEvno = isset($_POST['new_Evno']) ? $_POST['new_Evno'] : null;
$newEposta = isset($_POST['new_Eposta']) ? $_POST['new_Eposta'] : null;
$newAdres = isset($_POST['new_Adres']) ? $_POST['new_Adres'] : null;

try {
    $db->beginTransaction();

    
    if (!empty($deleteIds)) {
        $inQuery = implode(',', array_fill(0, count($deleteIds), '?'));
        $stmt = $db->prepare("DELETE FROM kisi_bilgisi WHERE id IN ($inQuery)");
        $stmt->execute($deleteIds);
    }

    
    foreach ($ids as $index => $id) {
        if (in_array($id, $deleteIds)) continue;
    
        
        $stmt = $db->prepare("SELECT Ad, Mobil, Evno, Eposta, Adres FROM kisi_bilgisi WHERE id=?");
        $stmt->execute([$id]);
        $existingData = $stmt->fetch(PDO::FETCH_ASSOC);
    
        
        $updateFields = [];
        $updateValues = [];
    
        if ($existingData['Ad'] !== $ads[$index]) {
            $updateFields[] = "Ad=?";
            $updateValues[] = $ads[$index];
        }
        if ($existingData['Mobil'] !== $mobils[$index]) {
            $updateFields[] = "Mobil=?";
            $updateValues[] = $mobils[$index];
        }
        if ($existingData['Evno'] !== $evnos[$index]) {
            $updateFields[] = "Evno=?";
            $updateValues[] = $evnos[$index];
        }
        if ($existingData['Eposta'] !== $epostas[$index]) {
            $updateFields[] = "Eposta=?";
            $updateValues[] = $epostas[$index];
        } 
        if ($existingData['Adres'] !== $adresler[$index]) {
            $updateFields[] = "Adres=?";
            $updateValues[] = $adresler[$index];
        }
    

        if (!empty($updateFields)) {
            $updateValues[] = $id;
            $stmt = $db->prepare("UPDATE kisi_bilgisi SET " . implode(", ", $updateFields) . " WHERE id=?");
            $stmt->execute($updateValues);
            
        }
    }
    

    
    if ($newAd && $newMobil && $newEvno && $newEposta && $newAdres) {
        $stmt = $db->prepare("INSERT INTO kisi_bilgisi (Ad, Mobil, Evno, Eposta, Adres) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$newAd, $newMobil, $newEvno, $newEposta, $newAdres]);
        
    }

    $db->commit();
    $message = "Değişiklikler başarıyla kaydedildi.";
} catch (Exception $e) {
    $db->rollBack();
    $message = "Bir hata oluştu: " . $e->getMessage();
}

header("Location: listele.php?message=" . urlencode($message));
exit();
?>
