<?php
session_start();
include 'db.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tip = $_POST['tip'];
    $email = $_POST['email'];
    $sifre = $_POST['sifre'];

    if ($tip === 'ogrenci') {
        $ad_soyad = $_POST['ad_soyad'];
        $bolum = $_POST['bolum'];
        $okul = $_POST['okul'];

        $stmt = $conn->prepare("INSERT INTO ogrenciler (ad_soyad, email, bolum, okul, sifre) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $ad_soyad, $email, $bolum, $okul, $sifre);

        if ($stmt->execute()) {
            $success = "Öğrenci kaydı başarılı. Giriş yapabilirsiniz.";
        } else {
            $error = "Kayıt başarısız: " . $conn->error;
        }

    } elseif ($tip === 'kurum') {
        $kurum_adi = $_POST['kurum_adi'];
        $iletisim = $_POST['iletisim'];

        $stmt = $conn->prepare("INSERT INTO kurumlar (kurum_adi, email, iletisim, sifre) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $kurum_adi, $email, $iletisim, $sifre);

        if ($stmt->execute()) {
            $success = "Kurum kaydı başarılı. Giriş yapabilirsiniz.";
        } else {
            $error = "Kayıt başarısız: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kayıt Ol</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="giris-sayfa">
<div class="giris-container">
    <h2>Kayıt Ol</h2>

    <?php if ($error): ?>
        <p class="hata-mesaji"><?= htmlspecialchars($error) ?></p>
    <?php elseif ($success): ?>
        <p class="basari-mesaji"><?= htmlspecialchars($success) ?></p>
    <?php endif; ?>

    <form method="post">
        <label for="tip">Kullanıcı Tipi:</label>
        <select name="tip" id="tip" onchange="gosterAlanlar()" required>
            <option value="">Seçiniz</option>
            <option value="ogrenci">Öğrenci</option>
            <option value="kurum">Kurum</option>
        </select>

        <div id="ogrenci-alanlari" style="display:none;">
            <input type="text" name="ad_soyad" placeholder="Ad Soyad">
            <input type="text" name="bolum" placeholder="Bölüm">
            <input type="text" name="okul" placeholder="Okul">
        </div>

        <div id="kurum-alanlari" style="display:none;">
            <input type="text" name="kurum_adi" placeholder="Kurum Adı">
            <input type="text" name="iletisim" placeholder="İletişim">
        </div>

        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="sifre" placeholder="Şifre" required>

        <button type="submit">Kayıt Ol</button>
    </form>

    <p>Zaten bir hesabınız var mı? <a href="login.php">Giriş Yap</a></p>
</div>

<script>
function gosterAlanlar() {
    var tip = document.getElementById('tip').value;
    document.getElementById('ogrenci-alanlari').style.display = (tip === 'ogrenci') ? 'block' : 'none';
    document.getElementById('kurum-alanlari').style.display = (tip === 'kurum') ? 'block' : 'none';
}
</script>
</body>
</html>
