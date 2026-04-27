<?php
include 'config.php';

// Validasi basic
if (!isset($_POST['id'])) {
    die("ID tidak ditemukan.");
}

// Ambil data dari form
$id   = $_POST['id'];
$nama = $_POST['nama_lengkap'];

// Composite attribute (address)
$jalan = $_POST['alamat_jalan'];
$prov  = $_POST['id_provinsi'];
$kota  = $_POST['id_kota'];

// Prepared statement UPDATE
$stmt = $conn->prepare("
    UPDATE pendaftar 
    SET 
        nama_lengkap = ?, 
        alamat_jalan = ?, 
        id_provinsi = ?, 
        id_kota = ?
    WHERE id = ?
");

// Bind parameter
$stmt->bind_param("ssiii", $nama, $jalan, $prov, $kota, $id);

// Eksekusi
if ($stmt->execute()) {
    // Redirect setelah berhasil
    header("Location: pendaftar.php");
    exit;
} else {
    echo "Gagal update data: " . $stmt->error;
}
?>