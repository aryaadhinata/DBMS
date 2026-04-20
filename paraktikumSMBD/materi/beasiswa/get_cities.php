<?php
include 'config.php';
$p_id = $_POST['province_id'];

$stmt = $conn->prepare("SELECT ID, name FROM cities WHERE province_ID = ? ORDER BY name ASC");
$stmt->bind_param("i", $p_id);
$stmt->execute();
$result = $stmt->get_result();

$data = [];
while ($row = $result->fetch_assoc()) { $data[] = $row; }
header('Content-Type: application/json');
echo json_encode($data);
