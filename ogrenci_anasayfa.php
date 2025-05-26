<?php
session_start();
if (!isset($_SESSION['tip']) || $_SESSION['tip'] !== 'ogrenci') {
    header('Location: login.php');
    exit;
}

$ogrenci = $_SESSION['kullanici'];
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Öğrenci Anasayfa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="ogrenci-anasayfa">
    <div class="container">
        <h2>Hoşgeldin, <span class="isim"><?= htmlspecialchars($ogrenci['ad_soyad']) ?></span></h2>
        <div class="butonlar">
            <a href="ogrenci_basvuru_yap.php" class="buton">📝 Başvuru Yap</a>
            <a href="logout.php" class="buton cikis">🚪 Çıkış Yap</a>
        </div>
    </div>
</body>
</html>
