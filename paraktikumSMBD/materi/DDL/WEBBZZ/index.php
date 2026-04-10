<?php include 'connect.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pembalap F1</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="header">
        <h1>Sistem Informasi Formula 1</h1>
    </div>

    <div class="container">
        <h2>Daftar Pembalap</h2>
       
        <a href="tambah.php" class="btn btn-tambah">+ Tambah Pembalap</a>


        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pembalap</th>
                    <th>No Mobil</th>
                    <th>Tim</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Query INNER JOIN
                $query = "SELECT pembalap.id_pembalap, pembalap.nama_pembalap, pembalap.no_mobil, tim.nama_tim
                        FROM pembalap
                        INNER JOIN tim ON pembalap.id_tim = tim.id_tim";
                
                $result = mysqli_query($koneksi, $query);
                $no = 1;


                while($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row['nama_pembalap']; ?></td>
                    <td><?= $row['no_mobil']; ?></td>
                    <td><?= $row['nama_tim']; ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row['id_pembalap']; ?>" class="btn btn-edit">Edit</a>
                        <a href="hapus.php?id=<?= $row['id_pembalap']; ?>" class="btn btn-hapus" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</body>
</html>