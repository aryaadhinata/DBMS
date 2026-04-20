<?php
include 'config.php';
$nama = $_POST['nama_lengkap'];
$addr = $_POST['address']; // Ini isinya array [street, province_id, city_id]

$jalan = $addr['street'];
$prov  = $addr['province_id'];
$kota  = $addr['city_id'];

$stmt = $conn->prepare("INSERT INTO pendaftar (nama_lengkap, alamat_jalan, id_provinsi, id_kota) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssii", $nama, $jalan, $prov, $kota);

if ($stmt->execute()) {
    echo "<script>alert('Mantap! Data kesimpan.'); window.location.href='index.php';</script>";
}
