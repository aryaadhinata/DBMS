<?php
include 'koneksi.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    echo "<script>
        localStorage.setItem('toast', 'ID buku tidak valid!');

        setTimeout(() => {
            window.location = 'index.php';
        }, 100);
    </script>";
    exit;
}

/* 1. CEK apakah buku sedang dipinjam */
$cek = mysqli_prepare($conn, "SELECT id_buku FROM peminjaman WHERE id_buku = ?");
mysqli_stmt_bind_param($cek, "s", $id);
mysqli_stmt_execute($cek);
$result = mysqli_stmt_get_result($cek);

if (mysqli_num_rows($result) > 0) {
    echo "<script>
        localStorage.setItem('toast', 'Tidak bisa dihapus! Buku sedang dipinjam.');

        setTimeout(() => {
            window.location = 'index.php';
        }, 100);
    </script>";
    exit;
}

/* 2. HAPUS BUKU */
$stmt = mysqli_prepare($conn, "DELETE FROM buku WHERE id_buku = ?");
mysqli_stmt_bind_param($stmt, "s", $id);

if (mysqli_stmt_execute($stmt)) {
    echo "<script>
        localStorage.setItem('toast', 'Buku berhasil dihapus!');

        setTimeout(() => {
            window.location = 'index.php';
        }, 100);
    </script>";
} else {
    echo "<script>
            localStorage.setItem('toast', 'Gagal menghapus buku!');
            window.location='index.php';
        </script>";
}
?>