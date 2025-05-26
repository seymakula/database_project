<?php
$servername = "localhost";
$username = "root"; // MAMP'ın varsayılan kullanıcı adı 'root'
$password = "root"; // MAMP'ta şifre de 'root' olarak belirlenmiştir
$dbname = "staj_crud"; // Veritabanınızın adı

// Bağlantıyı oluştur
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantı kontrolü
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>


