<?php
include 'db.php';

// Silme işlemi
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $conn->query("DELETE FROM ilanlar WHERE ilan_id=$id");
}

// Güncelleme işlemi
if (isset($_POST['update'])) {
    $id = (int)$_POST['id'];
    $baslik = $_POST['baslik'];
    $aciklama = $_POST['aciklama'];
    $sektor = $_POST['sektor'];
    $son_basvuru_tarihi = $_POST['son_basvuru_tarihi'];
    $kurum_id = (int)$_POST['kurum_id'];

    $conn->query("UPDATE ilanlar SET 
        baslik='$baslik',
        aciklama='$aciklama',
        sektor='$sektor',
        son_basvuru_tarihi='$son_basvuru_tarihi',
        kurum_id='$kurum_id'
        WHERE ilan_id=$id");
}

// Ekleme işlemi
if (isset($_POST['add'])) {
    $baslik = $_POST['baslik'];
    $aciklama = $_POST['aciklama'];
    $sektor = $_POST['sektor'];
    $son_basvuru_tarihi = $_POST['son_basvuru_tarihi'];
    $kurum_id = (int)$_POST['kurum_id'];

    $conn->query("INSERT INTO ilanlar (baslik, aciklama, sektor, son_basvuru_tarihi, kurum_id)
                  VALUES ('$baslik', '$aciklama', '$sektor', '$son_basvuru_tarihi', '$kurum_id')");
}

$result = $conn->query("SELECT * FROM ilanlar ORDER BY son_basvuru_tarihi ASC");
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>İlan Yönetimi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="giris-sayfa">
    <div class="giris-container">
        <h2>İlan Listesi</h2>

        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>Başlık</th>
                    <th>Açıklama</th>
                    <th>Sektör</th>
                    <th>Son Başvuru Tarihi</th>
                    <th>Kurum ID</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <form method="post">
                        <td style="min-width: 150px;"><input type="text" name="baslik" value="<?= htmlspecialchars($row['baslik']) ?>"></td>
<td style="min-width: 180px;"><input type="text" name="aciklama" value="<?= htmlspecialchars($row['aciklama']) ?>"></td>
<td><input type="text" name="sektor" value="<?= htmlspecialchars($row['sektor']) ?>"></td>
<td><input type="date" name="son_basvuru_tarihi" value="<?= $row['son_basvuru_tarihi'] ?>"></td>
<td><input type="number" name="kurum_id" value="<?= $row['kurum_id'] ?>" style="width: 60px;"></td>

                            <td>
                                <input type="hidden" name="id" value="<?= $row['ilan_id'] ?>">
                                <button type="submit" name="update">Güncelle</button>
                                <a href="?delete=<?= $row['ilan_id'] ?>" onclick="return confirm('Bu ilan silinsin mi?')">Sil</a>
                            </td>
                        </form>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <h2>Yeni İlan Ekle</h2>
        <form method="post" class="ekle-formu">
            <input type="text" name="baslik" placeholder="Başlık" required>
            <input type="text" name="aciklama" placeholder="Açıklama" required>
            <input type="text" name="sektor" placeholder="Sektör" required>
            <input type="date" name="son_basvuru_tarihi" required>
            <input type="number" name="kurum_id" placeholder="Kurum ID" required>
            <button type="submit" name="add">Ekle</button>
        </form>
    </div>
</body>
</html>
