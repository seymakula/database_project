<?php
include 'db.php';

// Kayıt silme
if (isset($_GET['sil'])) {
    $id = $_GET['sil'];
    $conn->query("DELETE FROM kurumlar WHERE kurum_id = $id");
}

// Kayıt ekleme
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ekle'])) {
    $kurum_adi = $_POST['kurum_adi'];
    $email = $_POST['email'];
    $iletisim = $_POST['iletisim'];
    $sifre = $_POST['sifre'];

    $conn->query("INSERT INTO kurumlar (kurum_adi, email, iletisim, sifre)
                  VALUES ('$kurum_adi', '$email', '$iletisim', '$sifre')");
}

// Kayıt güncelleme
if (isset($_POST['guncelle'])) {
    $id = $_POST['kurum_id'];
    $kurum_adi = $_POST['kurum_adi'];
    $email = $_POST['email'];
    $iletisim = $_POST['iletisim'];
    $sifre = trim($_POST['sifre']);

    if ($sifre !== '') {
        // Şifre girilmişse güncelle
        $conn->query("UPDATE kurumlar SET kurum_adi='$kurum_adi', email='$email', iletisim='$iletisim', sifre='$sifre' WHERE kurum_id=$id");
    } else {
        // Şifre girilmemişse şifreyi güncelleme
        $conn->query("UPDATE kurumlar SET kurum_adi='$kurum_adi', email='$email', iletisim='$iletisim' WHERE kurum_id=$id");
    }
}

$sonuclar = $conn->query("SELECT * FROM kurumlar");
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kurum Yönetimi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Kurum Ekle</h2>
    <form method="post">
        <input type="text" name="kurum_adi" placeholder="Kurum Adı" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="iletisim" placeholder="İletişim" required>
        <input type="password" name="sifre" placeholder="Şifre" required>
        <button type="submit" name="ekle">Ekle</button>
    </form>

    <h2>Kurum Listesi</h2>
    <table>
        <tr>
            <th>Kurum Adı</th>
            <th>Email</th>
            <th>İletişim</th>
            <th>Şifre (Güncellemek için yazınız)</th>
            <th>İşlemler</th>
        </tr>
        <?php while ($row = $sonuclar->fetch_assoc()): ?>
        <tr>
            <form method="post">
                <td><input type="text" name="kurum_adi" value="<?= htmlspecialchars($row['kurum_adi']) ?>"></td>
                <td><input type="email" name="email" value="<?= htmlspecialchars($row['email']) ?>"></td>
                <td><input type="text" name="iletisim" value="<?= htmlspecialchars($row['iletisim']) ?>"></td>
                <td>
                    <input type="password" name="sifre" placeholder="Yeni Şifre">
                </td>
                <td>
                    <input type="hidden" name="kurum_id" value="<?= $row['kurum_id'] ?>">
                    <button type="submit" name="guncelle">Güncelle</button>
                    <a href="?sil=<?= $row['kurum_id'] ?>" onclick="return confirm('Emin misiniz?')">Sil</a>
                </td>
            </form>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
