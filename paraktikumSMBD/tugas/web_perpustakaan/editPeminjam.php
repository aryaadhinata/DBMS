<?php
include 'koneksi.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    echo "<script>
        localStorage.setItem('toast', 'ID tidak valid!');
        window.location='peminjaman.php';
    </script>";
    exit;
}

/* AMBIL DATA PEMINJAMAN */
$stmt = mysqli_prepare($conn, "
    SELECT * FROM peminjaman WHERE id_peminjaman = ?
");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$p = mysqli_fetch_assoc($result);

if (!$p) {
    echo "<script>
        localStorage.setItem('toast', 'Data tidak ditemukan!');
        window.location='peminjaman.php';
    </script>";
    exit;
}

/* AMBIL DATA BUKU */
$buku = mysqli_query($conn, "SELECT * FROM buku");

$error = "";

/* UPDATE DATA */
if (isset($_POST['update'])) {
    $id_buku = $_POST['id_buku'];
    $nama = trim($_POST['nama_peminjam']);
    $tgl = $_POST['tgl_pinjam'];

    if ($id_buku == "" || $nama == "" || $tgl == "") {
        $error = "Semua field wajib diisi!";
    } else {

        $update = mysqli_prepare($conn, "
            UPDATE peminjaman 
            SET id_buku=?, nama_peminjam=?, tgl_pinjam=? 
            WHERE id_peminjaman=?
        ");

        mysqli_stmt_bind_param($update, "sssi", $id_buku, $nama, $tgl, $id);

        if (mysqli_stmt_execute($update)) {
            echo "<script>
                localStorage.setItem('toast', 'Data peminjaman berhasil diupdate!');
                window.location='peminjaman.php';
            </script>";
            exit;
        } else {
            $error = "Gagal mengupdate data!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Peminjaman</title>
    <link rel="icon" href="logo.png" type="image/png">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <header>
        <h1>Perpustakaan Hogwarts</h1>
        <h2>Edit Peminjaman</h2>
    </header>

    <main>

        <?php if ($error != ""): ?>
        <p id="errorMsg"><?= $error; ?></p>
        <?php endif; ?>

        <div class="form-container">
            <h3>Edit Data Peminjaman</h3>

            <form method="POST">

                <div class="form-group">
                    <label>Nama Peminjam</label>
                    <input type="text" name="nama_peminjam" value="<?= $p['nama_peminjam']; ?>">
                </div>

                <div class="form-group">
                    <label>Buku</label>
                    <select name="id_buku">
                        <option value="">-- Pilih Buku --</option>
                        <?php while ($b = mysqli_fetch_assoc($buku)) : ?>
                        <option value="<?= $b['id_buku']; ?>"
                            <?= ($b['id_buku'] == $p['id_buku']) ? 'selected' : ''; ?>>
                            <?= $b['judul_buku']; ?>
                        </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Tanggal Pinjam</label>
                    <input type="date" name="tgl_pinjam" value="<?= $p['tgl_pinjam']; ?>">
                </div>

                <div class="form-actions">
                    <button type="submit" name="update" class="btn btn-edit">Update</button>
                    <a href="peminjaman.php" class="btn btn-hapus">Batal</a>
                </div>

            </form>
        </div>

    </main>

    <footer>
        <p>© 2026 - Dibuat oleh Arya Dhinata</p>
    </footer>

    <!-- TOAST GLOBAL -->
    <div id="toast" class="toast"></div>

    <script>
        window.addEventListener('load', function () {
            const msg = localStorage.getItem('toast');

            if (!msg) return;

            const toast = document.getElementById("toast");
            toast.textContent = msg;
            toast.classList.add("show");

            setTimeout(() => {
                toast.classList.remove("show");
            }, 3000);

            localStorage.removeItem('toast');
        });
    </script>

</body>

</html>