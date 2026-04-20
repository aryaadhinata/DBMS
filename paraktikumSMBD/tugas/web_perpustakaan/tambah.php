<?php
include 'koneksi.php';

// Ambil data kategori
$kategori = mysqli_query($conn, "SELECT * FROM kategori");

$error = "";

if (isset($_POST['submit'])) {
    $id_buku = trim($_POST['id_buku']);
    $judul = trim($_POST['judul_buku']);
    $pengarang = trim($_POST['pengarang']);
    $id_kategori = trim($_POST['id_kategori']);

    if ($id_buku == "" || $judul == "" || $pengarang == "" || $id_kategori == "") {
        $error = "Semua field wajib diisi!";
    } else {

        $stmt = mysqli_prepare($conn, "
            INSERT INTO buku (id_buku, judul_buku, pengarang, id_kategori)
            VALUES (?, ?, ?, ?)
        ");

        mysqli_stmt_bind_param($stmt, "ssss", $id_buku, $judul, $pengarang, $id_kategori);

        if (mysqli_stmt_execute($stmt)) {
            echo "<script>
                localStorage.setItem('toast', 'Data berhasil ditambahkan!');
                window.location='index.php';
            </script>";
            exit;
        } else {
            $error = "Gagal menambahkan data!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Buku</title>
    <link rel="icon" href="logo.png" type="image/png">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <header>
        <h1>Perpustakaan Hogwarts</h1>
        <h2>Tambah Buku Baru</h2>
    </header>

    <main>
        <?php if ($error != "") : ?>
        <p id="errorMsg"><?= $error; ?></p>
        <?php endif; ?>

        <div class="form-container">
            <h3>Tambah Buku</h3>

            <form method="POST" name="formBuku" onsubmit="return validasiForm()">
                <div class="form-group">
                    <label>ID Buku</label>
                    <input type="text" name="id_buku" required>
                </div>

                <div class="form-group">
                    <label>Judul Buku</label>
                    <input type="text" name="judul_buku" value="<?= isset($judul) ? $judul : '' ?>">
                </div>

                <div class="form-group">
                    <label>Pengarang</label>
                    <input type="text" name="pengarang" value="<?= isset($pengarang) ? $pengarang : '' ?>">
                </div>

                <div class="form-group">
                    <label>Kategori</label>
                    <select name="id_kategori">
                        <option value="">-- Pilih Kategori --</option>
                        <?php while ($k = mysqli_fetch_assoc($kategori)) : ?>
                        <option value="<?= $k['id_kategori']; ?>"
                            <?= (isset($id_kategori) && $id_kategori == $k['id_kategori']) ? 'selected' : '' ?>>
                            <?= $k['nama_kategori']; ?>
                        </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="form-actions">
                    <button type="submit" name="submit" class="btn btn-tambah">Simpan</button>
                    <a href="index.php" class="btn btn-hapus">Batal</a>
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
            const judul = document.forms["formBuku"]["judul_buku"].value.trim();
            const pengarang = document.forms["formBuku"]["pengarang"].value.trim();
            const kategori = document.forms["formBuku"]["id_kategori"].value;

            if (!judul) {
                showToast("Judul wajib diisi!");
                return false;
            }

            if (judul.length < 3) {
                showToast("Judul minimal 3 karakter!");
                return false;
            }

            if (!pengarang) {
                showToast("Pengarang wajib diisi!");
                return false;
            }

            if (pengarang.length < 3) {
                showToast("Pengarang minimal 3 karakter!");
                return false;
            }

            if (!kategori) {
                showToast("Pilih kategori!");
                return false;
            }

            return true;
        }

        function showToast(msg) {
            const toast = document.getElementById("toast");
            toast.innerHTML = msg;
            toast.classList.add("show");

            setTimeout(() => {
                toast.classList.remove("show");
            }, 3000);
        }
    </script>

</body>

</html>