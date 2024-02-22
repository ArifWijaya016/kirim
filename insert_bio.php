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
$tekanan_tangki = $_POST['tekanan_tangki'];
$tekanan_tabung = $_POST['tekanan_tabung'];
$temperature = $_POST['temperature'];
$ph_bio = $_POST['ph_bio'];
$karbon_dioksida = $_POST['karbon_dioksida'];
$karbon_monoksida = $_POST['karbon_monoksida'];


// Menyimpan data ke database dengan prepared statement untuk mencegah SQL injection
$sql = "INSERT INTO $table (tekanan_tangki, tekanan_tabung, temperature, ph_bio, karbon_dioksida, karbon_monoksida, nama) VALUES (?, ?, ?, ?, ?, ?,'Biodigester')";

// Mempersiapkan statement
$stmt = $conn->prepare($sql);

// Mengikat parameter ke statement
// "ss" menunjukkan bahwa kedua nilai adalah string
$stmt->bind_param("ddddddd", $tekanan_tangki, $tekanan_tabung, $temperature, $ph_bio, $karbon_dioksida, $karbon_monoksida);

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
