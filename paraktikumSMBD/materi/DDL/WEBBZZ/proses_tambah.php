<?php
include 'connect.php';


if(isset($_POST['simpan'])) {
    $nama = $_POST['nama_pembalap'];
    $no_mobil = $_POST['no_mobil'];
    $id_tim = $_POST['id_tim'];


    // Query Insert
    $query = "INSERT INTO pembalap (nama_pembalap, no_mobil, id_tim)
            VALUES ('$nama', '$no_mobil', '$id_tim')";

    if(mysqli_query($koneksi, $query)) {
        header("Location: index.php"); // Kembali ke halaman utama jika sukses
    } else {
        echo "Gagal menambah data!";
    }
}
?>
