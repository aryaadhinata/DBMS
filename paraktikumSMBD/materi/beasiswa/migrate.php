<?php
$conn = new mysqli("localhost", "root", ""); 
// Kita belum pilih DB karena DB-nya mau kita buat lewat kode

$conn->query("CREATE DATABASE IF NOT EXISTS db_beasiswa");
$conn->select_db("db_beasiswa");
echo "Database siap!<br>";

$conn->query("SET FOREIGN_KEY_CHECKS = 0");
echo "foreign key matiin bang";

function eksekusi($file, $conn) {
    $query = file_get_contents("C:\laragon\www\paraktikumSMBD\materi\beasiswa\Database/" . $file);
    if ($conn->multi_query($query)) {
        do { if ($res = $conn->store_result()) $res->free(); } 
        while ($conn->next_result());
        echo "File $file beres!<br>";
    }
}

eksekusi("provinces.sql", $conn); //
eksekusi("cities.sql", $conn);    //
eksekusi("districts.sql", $conn); //

$sql = "CREATE TABLE IF NOT EXISTS pendaftar (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nama_lengkap VARCHAR(100),
    alamat_jalan VARCHAR(255),
    id_provinsi INT,
    id_kota INT,
    FOREIGN KEY (id_provinsi) REFERENCES provinces(ID),
    FOREIGN KEY (id_kota) REFERENCES cities(ID)
)";
$conn->query($sql);
echo "Tabel Pendaftar siap! <a href='index.php'>Cek Form</a>";
