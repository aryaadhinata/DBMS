<?php include 'connect.php'; ?>

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

    <<div class="container">
        <h2>Tambah Pembalap Baru</h2>
       
        <form action="proses_tambah.php" method="POST">
           
            <div class="form-group">
                <label for="nama_pembalap">Nama Pembalap:</label>
                <input type="text" id="nama_pembalap" name="nama_pembalap" placeholder="Masukkan nama pembalap" required>
            </div>


            <div class="form-group">
                <label for="no_mobil">No Mobil:</label>
                <input type="number" id="no_mobil" name="no_mobil" placeholder="Contoh: 1, 44, 16" required>
            </div>


            <div class="form-group">
                <label for="id_tim">Pilih Tim:</label>
                <select id="id_tim" name="id_tim" required>
                    <option value="">-- Pilih Tim --</option>
                    <?php
                    // Looping dari database untuk dropdown
                    $tim = mysqli_query($koneksi, "SELECT * FROM tim");
                    while($data_tim = mysqli_fetch_assoc($tim)) {
                        echo "<option value='{$data_tim['id_tim']}'>{$data_tim['nama_tim']}</option>";
                    }
                    ?>
                </select>
            </div>


            <button type="submit" class="btn" name="simpan">Simpan Data</button>
            <a href="index.php" class="btn" style="background-color: #95a5a6; margin-left: 10px;">Batal</a>


        </form>
    </div>



</body>
</html>