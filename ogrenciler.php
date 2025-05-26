<?php
include 'db.php';

// Kayıt silme
if (isset($_GET['sil'])) {
    $id = $_GET['sil'];
    $conn->query("DELETE FROM ogrenciler WHERE ogrenci_id = $id");
}

// Kayıt ekleme
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ekle'])) {
    $ad_soyad = $_POST['ad_soyad'];
    $email = $_POST['email'];
    $bolum = $_POST['bolum'];
    $okul = $_POST['okul'];
    $sifre = $_POST['sifre'];

    $conn->query("INSERT INTO ogrenciler (ad_soyad, email, bolum, okul, sifre)
                  VALUES ('$ad_soyad', '$email', '$bolum', '$okul', '$sifre')");
}

// Kayıt güncelleme
if (isset($_POST['guncelle'])) {
    $id = $_POST['ogrenci_id'];
    $ad_soyad = $_POST['ad_soyad'];
    $email = $_POST['email'];
    $bolum = $_POST['bolum'];
    $okul = $_POST['okul'];
    $sifre = $_POST['sifre'];

    $conn->query("UPDATE ogrenciler SET ad_soyad='$ad_soyad', email='$email', bolum='$bolum', okul='$okul', sifre='$sifre' WHERE ogrenci_id=$id");
}

$sonuclar = $conn->query("SELECT * FROM ogrenciler");
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Öğrenci Yönetimi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Öğrenci Ekle</h2>
    <form method="post">
        <input type="text" name="ad_soyad" placeholder="Ad Soyad" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="bolum" placeholder="Bölüm" required>
        <input type="text" name="okul" placeholder="Okul" required>
        <input type="password" name="sifre" placeholder="Şifre" required>
        <button type="submit" name="ekle">Ekle</button>
    </form>

    <h2>Öğrenci Listesi</h2>
    <table>
        <tr>
            <th>Ad Soyad</th>
            <th>Email</th>
            <th>Bölüm</th>
            <th>Okul</th>
            <th>İşlemler</th>
        </tr>
        <?php while ($row = $sonuclar->fetch_assoc()): ?>
        <tr>
            <form method="post">
                <td><input type="text" name="ad_soyad" value="<?= $row['ad_soyad'] ?>"readonly></td>
                <td><input type="email" name="email" value="<?= $row['email'] ?>"readonly></td>
                <td><input type="text" name="bolum" value="<?= $row['bolum'] ?>"readonly></td>
                <td><input type="text" name="okul" value="<?= $row['okul'] ?>"readonly></td>
                <td>
                    <input type="hidden" name="ogrenci_id" value="<?= $row['ogrenci_id'] ?>">
                    <input type="password" name="sifre" placeholder="Yeni Şifre">
                    <button type="submit" name="guncelle">Güncelle</button>
                    <a href="?sil=<?= $row['ogrenci_id'] ?>" onclick="return confirm('Emin misiniz?')">Sil</a>
                </td>
            </form>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
