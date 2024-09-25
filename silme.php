<?php
include "config.php";

$message = "";

if (isset($_POST["id"])) {
    $id = intval($_POST["id"]);

    // Eski kişi bilgilerini çek
    $stmt = $db->prepare("SELECT Ad FROM kisi_bilgisi WHERE id = ?");
    $stmt->execute([$id]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($data) {
        $name = $data['Ad'];

        // Silme işlemini yap
        $stmt = $db->prepare("DELETE FROM kisi_bilgisi WHERE id = ?");
        $result = $stmt->execute([$id]);

        if ($result) {
            $message = "$name adlı kişi başarıyla silindi.";
        } else {
            $message = "Silme sırasında bir hata oluştu.";
        }
    } else {
        $message = "Kayıt bulunamadı.";
    }
} else {
    $message = "ID hatalı veya mevcut değil.";
}

header("Location: listele.php?message=" . urlencode($message));
exit();
?>
