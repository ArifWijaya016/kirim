<?php
$servername = "localhost";
$username = "admin";  // Ganti dengan username MySQL Anda
$password = "root";      // Ganti dengan password MySQL Anda
$dbname = "server";   // Ganti dengan nama database Anda
$table = "hidroponik"; // Ganti dengan nama tabel Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Mengambil data dari ESP32
$tds = $_POST['tds'];
$temp_hidro = $_POST['temp_hidro'];

// Menyimpan data ke database dengan prepared statement untuk mencegah SQL injection
$sql = "INSERT INTO $table (tds, temp_hidro, nama) VALUES (?, ?, 'hidroponik')";

// Mempersiapkan statement
$stmt = $conn->prepare($sql);

// Mengikat parameter ke statement
// "ss" menunjukkan bahwa kedua nilai adalah string
$stmt->bind_param("ss", $tds, $temp_hidro);

// Menjalankan statement
if ($stmt->execute() === TRUE) {
    echo "Data inserted successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Menutup statement dan koneksi
$stmt->close();
$conn->close();
?>
