<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pendaftaran Beasiswa</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
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
    <script src="app.js"></script>
</body>
</html>