<?php
session_start();
include 'db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tip = $_POST['tip']; // 'ogrenci' veya 'kurum'
    $email = $_POST['email'];
    $sifre = $_POST['sifre'];

    if ($tip === 'ogrenci') {
        $result = $conn->query("SELECT * FROM ogrenciler WHERE email='$email' AND sifre='$sifre'");
        if ($result->num_rows == 1) {
            $ogrenci = $result->fetch_assoc();
            $_SESSION['tip'] = 'ogrenci';
            $_SESSION['kullanici'] = $ogrenci;
            $_SESSION['kullanici_adi'] = $ogrenci['ad']; // 👈 ADI BURADAN ÇEKİYORUZ
            header('Location: ogrenci_anasayfa.php');
            exit;
        } else {
            $error = "Öğrenci bilgileri yanlış.";
        }
    } elseif ($tip === 'kurum') {
        $result = $conn->query("SELECT * FROM kurumlar WHERE email='$email' AND sifre='$sifre'");
        if ($result->num_rows == 1) {
            $kurum = $result->fetch_assoc();
            $_SESSION['tip'] = 'kurum';
            $_SESSION['kullanici'] = $kurum;
            $_SESSION['kullanici_adi'] = $kurum['ad']; // 👈 KURUM ADI (varsa)
            header('Location: kurum_anasayfa.php');
            exit;
        } else {
            $error = "Kurum bilgileri yanlış.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Giriş Yap</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="giris-sayfa">
    <div class="giris-container">
        <h2>Giriş Yap</h2>

        <?php if (!empty($error)): ?>
            <p class="hata-mesaji"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form method="post">
            <label for="tip">Kullanıcı Tipi:</label>
            <select name="tip" id="tip" required>
                <option value="">Seçiniz</option>
                <option value="ogrenci">Öğrenci</option>
                <option value="kurum">Kurum</option>
            </select>

            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="sifre" placeholder="Şifre" required>

            <button type="submit">Giriş Yap</button>
        </form>
    </div>
</body>
</html>
