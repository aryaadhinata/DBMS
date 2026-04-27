<?php
include 'config.php';

// Set response ke JSON
header('Content-Type: application/json');

// Query JOIN tabel pendaftar, provinces, dan cities
$query = "
SELECT 
    p.id,
    p.nama_lengkap,
    p.alamat_jalan,
    prov.name AS provinsi,
    c.name AS kota
FROM pendaftar p
JOIN provinces prov ON p.id_provinsi = prov.ID
JOIN cities c ON p.id_kota = c.ID
ORDER BY p.id DESC
";

// Eksekusi query
$result = mysqli_query($conn, $query);

// Ambil hasil ke array
$data = [];

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
}

// Output JSON
echo json_encode($data);
?>