<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Pendaftaran Beasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">🎓 Beasiswa 2026</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Pendaftaran</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pendaftar.php">Pendaftar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h2>Daftar Pendaftar Beasiswa</h2>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>Alamat Jalan</th>
                    <th>Provinsi</th>
                    <th>Kota</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="tabel-pendaftar"></tbody>
        </table>
    </div>

    <script>
        $(document).ready(function () {
            $.ajax({
                url: 'get_pendaftar.php',
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    let html = '';
                    let no = 1;

                    // Kalau data kosong
                    if (data.length === 0) {
                        html = `
                <tr>
                    <td colspan="6" class="text-center">Belum ada data pendaftar</td>
                </tr>
                `;
                    } else {
                        // Loop data
                        data.forEach(function (item) {
                            html += `
                    <tr>
                        <td>${no++}</td>
                        <td>${item.nama_lengkap}</td>
                        <td>${item.alamat_jalan}</td>
                        <td>${item.provinsi}</td>
                        <td>${item.kota}</td>
                        <td>
                        <a href="edit_pendaftar.php?id=${item.id}" class="btn btn-warning btn-sm">Edit</a>
                        </td>
                    </tr>
                    `;
                        });
                    }

                    $('#tabel-pendaftar').html(html);
                },
                error: function () {
                    alert('Gagal mengambil data dari server!');
                }
            });
        });
    </script>
</body>

</html>