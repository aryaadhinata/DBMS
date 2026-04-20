<?php
include 'koneksi.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = mysqli_prepare($conn, "DELETE FROM peminjaman WHERE id_peminjaman = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>
                localStorage.setItem('toast', 'Peminjaman berhasil dihapus!');
                window.location='peminjaman.php';
            </script>";
    } else {
        echo "<script>
                localStorage.setItem('toast', 'Gagal menghapus data!');
                window.location='peminjaman.php';
            </script>";
    }
} else {
    echo "<script>
            localStorage.setItem('toast', 'ID tidak ditemukan!');
            window.location='peminjaman.php';
        </script>";
}
?>