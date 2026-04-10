<?php
include 'connect.php';


// Menangkap ID dari URL
$id = $_GET['id'];
$query_pembalap = mysqli_query($koneksi, "SELECT * FROM pembalap WHERE id_pembalap = '$id'");
$data = mysqli_fetch_assoc($query_pembalap);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pembalap F1</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="header">
        <h1>Sistem Informasi Formula 1</h1>
    </div>

    <div class="container"> 
        <h2>Edit Data Pembalap</h2>
        <form action="proses_edit.php" method="POST">
            <input type="hidden" name="id_pembalap" value="<?= $data['id_pembalap']; ?>">


            <div class="form-group">
                <label for="nama_pembalap">Nama Pembalap:</label>
                <input type="text" id="nama_pembalap" name="nama_pembalap" value="<?= $data['nama_pembalap']; ?>" required>
            </div>


            <div class="form-group">
                <label for="no_mobil">No Mobil:</label>
                <input type="number" id="no_mobil" name="no_mobil" value="<?= $data['no_mobil']; ?>" required>
            </div>


            <div class="form-group">
                <label for="id_tim">Pilih Tim:</label>
                <select id="id_tim" name="id_tim" required>
                    <option value="">-- Pilih Tim --</option>
                    <?php
                    $tim = mysqli_query($koneksi, "SELECT * FROM tim");
                    while($data_tim = mysqli_fetch_assoc($tim)) {
                        $pilih = ($data_tim['id_tim'] == $data['id_tim']) ? 'selected' : '';
                        echo "<option value='{$data_tim['id_tim']}' $pilih>{$data_tim['nama_tim']}</option>";
                    }
                    ?>
                </select>
            </div>


            <button type="submit" class="btn btn-edit" name="simpan">Update Data</button>
            <a href="index.php" class="btn" style="background-color: #95a5a6; margin-left: 10px;">Batal</a>


        </form>
    </div>


</body>
</html>