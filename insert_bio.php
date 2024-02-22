<?php
print_r($_POST);
$servername = "localhost";
$username = "root";  // Ganti dengan username MySQL Anda
$password = "";      // Ganti dengan password MySQL Anda
$dbname = "server";   // Ganti dengan nama database Anda
$table = "biodigester"; // Ganti dengan nama tabel Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Extract data from the POST request
$tekanan_tangki = $_POST['tekanan_tangki'];
$tekanan_tabung = $_POST['tekanan_tabung'];
$temperature = $_POST['temperature'];
$ph_bio = $_POST['ph_bio'];
$karbon_dioksida = $_POST['karbon_dioksida'];
$karbon_monoksida = $_POST['karbon_monoksida'];

// Perhatikan penambahan tanda kutip pada Biodigester untuk nilai kolom 'nama'
$sql = "INSERT INTO $table (tekanan_tangki, tekanan_tabung, temperature, ph_bio, karbon_dioksida, karbon_monoksida, nama)
        VALUES ('$tekanan_tangki', '$tekanan_tabung', '$temperature', '$ph_bio', '$karbon_dioksida', '$karbon_monoksida', 'Biodigester 1')";

if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
