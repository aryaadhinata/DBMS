<?php
include 'config.php';

// Pastikan output JSON dikirim kembali ke browser.
header('Content-Type: application/json');

$provinceId = null;
if (isset($_GET['province_id'])) {
    $provinceId = $_GET['province_id'];
} elseif (isset($_POST['province_id'])) {
    $provinceId = $_POST['province_id'];
} elseif (isset($_POST['address']['province_id'])) {
    $provinceId = $_POST['address']['province_id'];
}

if (empty($provinceId) || !ctype_digit((string)$provinceId)) { echo json_encode(['error' => 'Province ID tidak valid.']); exit; }
$checkProvince = $conn->prepare("SELECT ID, name FROM provinces WHERE ID = ?");
$checkProvince->bind_param("i", $provinceId);
$checkProvince->execute();
$provinceResult = $checkProvince->get_result();

if ($provinceResult->num_rows === 0) {
    echo json_encode(['error' => 'Province ID ' . $provinceId . ' tidak ditemukan di database.']);
    exit;
}

$stmt = $conn->prepare("SELECT ID, name FROM cities WHERE province_ID = ? ORDER BY name ASC");
$stmt->bind_param("i", $provinceId);

if (!$stmt->execute()) {
    echo json_encode(['error' => 'Gagal mengeksekusi query.']);
    exit;
}

$result = $stmt->get_result();
$cities = [];
while ($row = $result->fetch_assoc()) {
    $cities[] = $row;
}

echo json_encode($cities);
?>