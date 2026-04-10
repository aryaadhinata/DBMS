<?php 
include 'connect.php';


if(isset($_POST['simpan'])) {
    // Menangkap data dari form edit
    $id = $_POST['id_pembalap'];
    $nama = $_POST['nama_pembalap'];
    $no_mobil = $_POST['no_mobil'];
    $id_tim = $_POST['id_tim'];


    // Query Update
    $query = "UPDATE pembalap SET
                nama_pembalap = '$nama',
                no_mobil = '$no_mobil',
                id_tim = '$id_tim'
                WHERE id_pembalap = '$id'";

    if(mysqli_query($koneksi, $query)) {
        header("Location: index.php"); // Kembali ke halaman utama jika sukses
    } else {
        echo "Gagal mengupdate data!";
    }
}
?>

