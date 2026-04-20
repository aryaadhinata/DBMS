<?php
include 'koneksi.php';

// Ambil data buku untuk dropdown
$buku = mysqli_query($conn, "SELECT * FROM buku");

$error = "";

if (isset($_POST['submit'])) {
    $nama = trim($_POST['nama_peminjam']);
    $id_buku = $_POST['id_buku'];
    $tgl = $_POST['tgl_pinjam'];

    if ($nama == "" || $id_buku == "" || $tgl == "") {
        $error = "Semua field wajib diisi!";
    } elseif (strlen($nama) < 3) {
        $error = "Nama minimal 3 karakter!";
    } else {
        $stmt = mysqli_prepare($conn, "INSERT INTO peminjaman (nama_peminjam, id_buku, tgl_pinjam) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sss", $nama, $id_buku, $tgl);

        if (mysqli_stmt_execute($stmt)) {
            echo "<script>
                    localStorage.setItem('toast', 'Peminjaman berhasil ditambahkan!');
                    window.location='peminjaman.php';
                </script>";
            exit;
        } else {
            $error = "Terjadi kesalahan!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Peminjaman</title>
    <link rel="icon" href="logo.png" type="image/png">
    <link rel="stylesheet" href="style.css">
</head>

<body>

<header>
    <h1>Perpustakaan Hogwarts</h1>
    <h2>Tambah Data Peminjaman</h2>
</header>

<main>

<?php if ($error != "") : ?>
    <p id="errorMsg"><?= $error; ?></p>
<?php endif; ?>

<div class="form-container">
    <h3>Tambah Peminjaman</h3>

    <form method="POST" name="formPinjam" onsubmit="return validasiForm()">

        <div class="form-group">
            <label>Nama Peminjam</label>
            <input type="text" name="nama_peminjam" value="<?= isset($nama) ? $nama : '' ?>">
        </div>

        <div class="form-group">
            <label>Buku</label>
            <select name="id_buku">
                <option value="">-- Pilih Buku --</option>
                <?php while ($b = mysqli_fetch_assoc($buku)) : ?>
                    <option value="<?= $b['id_buku']; ?>"
                        <?= (isset($id_buku) && $id_buku == $b['id_buku']) ? 'selected' : '' ?>>
                        <?= $b['judul_buku']; ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Tanggal Pinjam</label>
            <input type="date" name="tgl_pinjam" value="<?= isset($tgl) ? $tgl : date('Y-m-d') ?>">
        </div>

        <div class="form-actions">
            <button type="submit" name="submit" class="btn btn-tambah">Simpan</button>
            <a href="peminjaman.php" class="btn btn-hapus">Batal</a>
        </div>

    </form>
</div>

</main>

<footer>
    <p>© 2026 - Dibuat oleh Arya Dhinata</p>
</footer>

<div id="toast" class="toast"></div>

<script>
function validasiForm() {
    const nama = document.forms["formPinjam"]["nama_peminjam"].value.trim();
    const buku = document.forms["formPinjam"]["id_buku"].value;
    const tgl = document.forms["formPinjam"]["tgl_pinjam"].value;

    if (!nama) { showToast("Nama wajib diisi!"); return false; }
    if (nama.length < 3) { showToast("Nama minimal 3 karakter!"); return false; }
    if (!buku) { showToast("Pilih buku!"); return false; }
    if (!tgl) { showToast("Tanggal wajib diisi!"); return false; }

    return true;
}

function showToast(msg) {
    const toast = document.getElementById("toast");
    toast.innerHTML = msg;
    toast.classList.add("show");
    setTimeout(() => { toast.classList.remove("show"); }, 3000);
}
</script>

</body>
</html>
