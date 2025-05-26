<?php
session_start();
if (!isset($_SESSION['tip']) || $_SESSION['tip'] !== 'kurum') {
    header('Location: login.php');
    exit;
}

$kurum = $_SESSION['kullanici'];
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kurum Anasayfa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="kurum-anasayfa">
    <div class="container">
        <h2>Hoşgeldin, <span class="isim"><?= htmlspecialchars($kurum['kurum_adi']) ?></span></h2>
        <div class="butonlar">
            <a href="ilanlar.php" class="buton">📄 İlan Ekle / Yönet</a>
            <a href="basvurular.php" class="buton">📋 Başvuruları Görüntüle</a>
            <a href="logout.php" class="buton cikis">🚪 Çıkış Yap</a>
        </div>
    </div>
</body>
</html>

