<?php
$servername = "localhost";
$username = "admin";  // Ganti dengan username MySQL Anda
$password = "root";      // Ganti dengan password MySQL Anda
$dbname = "server";   // Ganti dengan nama database Anda
$table = "biodigester"; // Ganti dengan nama tabel Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Mengambil data dari ESP32
$tekanan_tangki = isset($_POST['tekanan_tangki']) ? (float) $_POST['tekanan_tangki'] : 0;
$tekanan_tabung = isset($_POST['tekanan_tabung']) ? (float) $_POST['tekanan_tabung'] : 0;
$temperature = isset($_POST['temperature']) ? (float) $_POST['temperature'] : 0;
$ph_bio = isset($_POST['ph_bio']) ? (float) $_POST['ph_bio'] : 0;
$karbon_dioksida = isset($_POST['karbon_dioksida']) ? (float) $_POST['karbon_dioksida'] : 0;
$karbon_monoksida = isset($_POST['karbon_monoksida']) ? (float) $_POST['karbon_monoksida'] : 0;

// Menyimpan data ke database dengan prepared statement untuk mencegah SQL injection
$sql = "INSERT INTO $table (tekanan_tangki, tekanan_tabung, temperature, ph_bio, karbon_dioksida, karbon_monoksida, nama) VALUES (?, ?, ?, ?, ?, ?, 'Biodigester')";

// Mempersiapkan statement
$stmt = $conn->prepare($sql);

// Mengikat parameter ke statement dengan tipe data yang sesuai
$stmt->bind_param("dddddds", $tekanan_tangki, $tekanan_tabung, $temperature, $ph_bio, $karbon_dioksida, $karbon_monoksida);

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
