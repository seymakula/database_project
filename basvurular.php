<?php
session_start();
include 'db.php';

// Giriş kontrolü
if (!isset($_SESSION['tip']) || $_SESSION['tip'] !== 'kurum') {
    header('Location: login.php');
    exit;
}

$kurum_id = $_SESSION['kullanici']['kurum_id'];
$mesaj = ''; // Burada mesajı tanımladık

// Onayla veya Reddet işlemi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['basvuru_id'], $_POST['yeni_durum'])) {
    $basvuru_id = (int)$_POST['basvuru_id'];
    $yeni_durum = $conn->real_escape_string($_POST['yeni_durum']);

    $guncelle = $conn->query("
        UPDATE basvurular 
        SET onay_durumu = '$yeni_durum'
        WHERE basvuru_id = $basvuru_id 
          AND ilan_id IN (SELECT ilan_id FROM ilanlar WHERE kurum_id = $kurum_id)
    ");

    if ($guncelle) {
        $mesaj = "Başvuru durumu \"$yeni_durum\" olarak güncellendi.";
    } else {
        $mesaj = "Hata oluştu: " . $conn->error;
    }
}

// Başvuruları çek
$sql = "
    SELECT 
        b.basvuru_id, b.ogrenci_id, o.ad_soyad,
        b.ilan_id, i.baslik,
        b.onay_durumu, b.basvuru_tarihi
    FROM basvurular b
    INNER JOIN ilanlar i ON b.ilan_id = i.ilan_id
    INNER JOIN ogrenciler o ON b.ogrenci_id = o.ogrenci_id
    WHERE i.kurum_id = $kurum_id
    ORDER BY b.basvuru_tarihi DESC
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Başvurular</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Başvurular</h2>

    <?php if (!empty($mesaj)): ?>
        <p style="color: green; font-weight: bold;"><?= htmlspecialchars($mesaj) ?></p>
    <?php endif; ?>

    <table border="1" cellpadding="5">
        <tr>
            <th>Öğrenci</th>
            <th>İlan Başlığı</th>
            <th>Durum</th>
            <th>Başvuru Tarihi</th>
            <th>İşlemler</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['ad_soyad']) ?></td>
                <td><?= htmlspecialchars($row['baslik']) ?></td>
                <td><?= htmlspecialchars($row['onay_durumu']) ?></td>
                <td><?= htmlspecialchars($row['basvuru_tarihi']) ?></td>
                <td>
                <td>
    <div class="action-buttons">
        <form method="post">
            <input type="hidden" name="basvuru_id" value="<?= $row['basvuru_id'] ?>">
            <input type="hidden" name="yeni_durum" value="Onaylandı">
            <button type="submit" class="btn btn-yes">✅ Onayla</button>
        </form>

        <form method="post">
            <input type="hidden" name="basvuru_id" value="<?= $row['basvuru_id'] ?>">
            <input type="hidden" name="yeni_durum" value="Reddedildi">
            <button type="submit" class="btn btn-no">❌ Reddet</button>
        </form>
    </div>
</td>

                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
