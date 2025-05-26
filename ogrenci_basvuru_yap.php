<?php
session_start();
include 'db.php';

// Oturum kontrolü - sadece öğrenci giriş yapmışsa erişebilir
if (!isset($_SESSION['tip']) || $_SESSION['tip'] !== 'ogrenci') {
    header('Location: login.php');
    exit;
}

$kullanici = $_SESSION['kullanici'] ?? null;
$ogrenci_id = $kullanici['ogrenci_id'] ?? null;
$ogrenci_ad = $kullanici['ad_soyad'] ?? 'Öğrenci';

if (!$ogrenci_id) {
    header("Location: login.php");
    exit;
}

// Başvuru yapma işlemi
$mesaj = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['basvuru_yap'])) {
    $ilan_id = (int)$_POST['ilan_id'];
    $basvuru_tarihi = date('Y-m-d H:i:s');
    $onay_durumu = 'Beklemede';

    // Aynı ilana daha önce başvuru yapılmış mı?
    $kontrol = $conn->query("SELECT * FROM basvurular WHERE ogrenci_id = $ogrenci_id AND ilan_id = $ilan_id");
    if ($kontrol && $kontrol->num_rows > 0) {
        $mesaj = "❗ Bu ilana zaten başvurdunuz.";
    } else {
        $ekle = $conn->query("INSERT INTO basvurular (ogrenci_id, ilan_id, basvuru_tarihi, onay_durumu) 
                              VALUES ($ogrenci_id, $ilan_id, '$basvuru_tarihi', '$onay_durumu')");
        if ($ekle) {
            $mesaj = "✅ Başvurunuz başarıyla alındı.";
        } else {
            $mesaj = "⚠️ Başvuru sırasında bir hata oluştu: " . $conn->error;
        }
    }
}

// Tüm aktif ilanları çek
$ilanlar = $conn->query("SELECT ilan_id, baslik FROM ilanlar WHERE son_basvuru_tarihi >= CURDATE() ORDER BY son_basvuru_tarihi ASC");
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Staj Başvuru</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="giris-sayfa">
    <div class="giris-container">
        <h2>Hoşgeldin, <?= htmlspecialchars($ogrenci_ad) ?></h2>

        <div class="linkler">
            <a href="anasayfa.php">Anasayfa</a> |
            <a href="logout.php">Çıkış Yap</a>
        </div>

        <h3>Staj İlanları</h3>

        <?php if (!empty($mesaj)): ?>
            <p style="color: <?= str_contains($mesaj, '✅') ? 'green' : 'red' ?>;">
                <?= $mesaj ?>
            </p>
        <?php endif; ?>

        <form method="post">
            <label for="ilan_id">Başvuru Yapmak İstediğiniz İlanı Seçin:</label>
            <select name="ilan_id" id="ilan_id" required>
                <option value="">İlan Seçiniz</option>
                <?php foreach ($ilanlar as $ilan): ?>
                    <option value="<?= $ilan['ilan_id'] ?>">
                        <?= htmlspecialchars($ilan['baslik']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit" name="basvuru_yap">Başvuru Yap</button>
        </form>
    </div>
</body>
</html>
