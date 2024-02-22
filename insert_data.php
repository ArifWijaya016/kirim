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

// Menyimpan data ke database dengan kolom 'nama' yang bernilai 'hidroponik'
$sql = "INSERT INTO $table (tds, temp_hidro, nama) 
VALUES ($tds, $temp_hidro, 'hidroponik')";

if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Menutup koneksi
$conn->close();
?>
