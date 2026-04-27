<?php
include 'config.php';

// Validasi ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID tidak ditemukan.");
}

$id = (int) $_GET['id']; // amankan

// Ambil data pendaftar
$query = "
SELECT * FROM pendaftar WHERE id = $id
";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    die("Data tidak ditemukan.");
}

// Ambil semua provinsi
$provinsi = $conn->query("SELECT ID, name FROM provinces ORDER BY name ASC");

// Ambil kota sesuai provinsi lama
$kota = $conn->query("SELECT ID, name FROM cities WHERE province_ID = {$data['id_provinsi']} ORDER BY name ASC");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Pendaftar</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card shadow">
                    <div class="card-body">

                        <h4 class="mb-4">Edit Pendaftar</h4>

                        <form action="update_pendaftar.php" method="POST">

                            <!-- ID hidden -->
                            <input type="hidden" name="id" value="<?= $data['id'] ?>">

                            <!-- Nama -->
                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" class="form-control"
                                    value="<?= $data['nama_lengkap'] ?>" required>
                            </div>

                            <!-- Alamat -->
                            <div class="border rounded p-3">

                                <div class="bg-primary text-white px-3 py-1 rounded mb-3 d-inline-block">
                                    Alamat Asal
                                </div>

                                <!-- Jalan -->
                                <div class="mb-3">
                                    <label class="form-label">Jalan</label>
                                    <input type="text" name="alamat_jalan" class="form-control"
                                        value="<?= $data['alamat_jalan'] ?>" required>
                                </div>

                                <!-- Provinsi -->
                                <div class="mb-3">
                                    <label class="form-label">Provinsi</label>
                                    <select name="id_provinsi" id="provinsi" class="form-select" required>
                                        <?php while($row = $provinsi->fetch_assoc()): ?>
                                        <option value="<?= $row['ID'] ?>"
                                            <?= $row['ID'] == $data['id_provinsi'] ? 'selected' : '' ?>>
                                            <?= $row['name'] ?>
                                        </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>

                                <!-- Kota -->
                                <div class="mb-3">
                                    <label class="form-label">Kota</label>
                                    <select name="id_kota" id="kota" class="form-select" required>
                                        <?php while($row = $kota->fetch_assoc()): ?>
                                        <option value="<?= $row['ID'] ?>"
                                            <?= $row['ID'] == $data['id_kota'] ? 'selected' : '' ?>>
                                            <?= $row['name'] ?>
                                        </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>

                            </div>

                            <button type="submit" class="btn btn-warning w-100 mt-4">
                                Update Data
                            </button>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#provinsi').on('change', function () {

                var id_terpilih = $(this).val();
                var $kota = $('#kota');

                $kota.prop('disabled', true)
                    .html('<option>Loading...</option>');

                $.ajax({
                    url: 'get_cities.php',
                    type: 'POST',
                    data: {
                        province_id: id_terpilih
                    },
                    dataType: 'json',

                    success: function (response) {
                        let html = '<option disabled selected>-- Pilih Kota --</option>';

                        response.forEach(function (item) {
                            html +=
                                `<option value="${item.ID}">${item.name}</option>`;
                        });

                        $kota.html(html).prop('disabled', false);
                    }
                });
            });
        });
    </script>
</body>