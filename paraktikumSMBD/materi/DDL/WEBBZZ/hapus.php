<?php
include 'connect.php';


// Menangkap ID dari URL
$id = $_GET['id'];


// Query Hapus
$query = "DELETE FROM pembalap WHERE id_pembalap = '$id'";


if(mysqli_query($koneksi, $query)) {
    header("Location: index.php");
} else {
    echo "Gagal menghapus data!";
}
?>

