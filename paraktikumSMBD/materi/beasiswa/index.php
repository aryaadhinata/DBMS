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

    <div class="form-container">
        <form action="process.php" method="POST">
            <h2>Pendaftaran Beasiswa</h2>
            <label>Nama Mahasiswa</label>
            <input type="text" name="nama_lengkap" required>

            <fieldset>
                <legend>Alamat Asal (Composite)</legend>
                <label>Jalan</label>
                <input type="text" name="address[street]" required>

                <label>Provinsi</label>
                <select name="address[province_id]" id="provinsi" required>
                    <option value="" selected disabled>-- Pilih Provinsi --</option>
                    <?php
                $res = $conn->query("SELECT ID, name FROM provinces ORDER BY name ASC");
                while($row = $res->fetch_assoc()) {
                    echo "<option value='{$row['ID']}'>{$row['name']}</option>";
                }
                ?>
                </select>

                <label>Kota</label>
                <select name="address[city_id]" id="kota" required disabled>
                    <option value="" selected disabled>-- Pilih Provinsi Dahulu --</option>
                </select>
            </fieldset>
            <button type="submit">Kirim Data</button>
        </form>
    </div>
    <script src="app.js"></script>
</body>

</html>