<?php
include 'koneksi.php';

$id = $_GET['id'];

// Ambil data buku
$stmt = mysqli_prepare($conn, "SELECT * FROM buku WHERE id_buku = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$b = mysqli_fetch_assoc($result);

// Ambil kategori
$kategori = mysqli_query($conn, "SELECT * FROM kategori");

$error = "";

if (isset($_POST['update'])) {
    $judul = trim($_POST['judul']);
    $pengarang = trim($_POST['pengarang']);
    $id_kategori = $_POST['kategori'];
    $id_buku = $_POST['id'];

    if (empty($judul) || empty($pengarang) || empty($id_kategori)) {
        $error = "Semua field wajib diisi!";
    } elseif (strlen($judul) < 3) {
        $error = "Judul minimal 3 karakter!";
    } elseif (strlen($pengarang) < 3) {
        $error = "Pengarang minimal 3 karakter!";
    } else {

        $stmt = mysqli_prepare($conn, "
            UPDATE buku 
            SET judul_buku=?, pengarang=?, id_kategori=? 
            WHERE id_buku=?
        ");

        mysqli_stmt_bind_param($stmt, "ssss", $judul, $pengarang, $id_kategori, $id_buku);

        if (mysqli_stmt_execute($stmt)) {
            echo "<script>
                localStorage.setItem('toast', 'Data berhasil diupdate!');
                window.location='index.php';
            </script>";
            exit;
        } else {
            $error = "Gagal update data!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Buku</title>
    <link rel="icon" href="logo.png" type="image/png">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <header>
        <h1>Perpustakaan Hogwarts</h1>
        <h2>Edit Data Buku</h2>
    </header>

    <main>
        <?php if ($error != "") : ?>
        <p id="errorMsg"><?= $error; ?></p>
        <?php endif; ?>

        <div class="form-container">
            <h3>Edit Buku</h3>

            <form method="POST" name="formBuku" onsubmit="return validasiForm()">

                <input type="hidden" name="id" value="<?= $b['id_buku']; ?>">

                <div class="form-group">
                    <label>Judul Buku</label>
                    <input type="text" name="judul" value="<?= $b['judul_buku']; ?>">
                </div>

                <div class="form-group">
                    <label>Pengarang</label>
                    <input type="text" name="pengarang" value="<?= $b['pengarang']; ?>">
                </div>

                <div class="form-group">
                    <label>Kategori</label>
                    <select name="kategori">
                        <option value="">-- Pilih Kategori --</option>

                        <?php while ($k = mysqli_fetch_assoc($kategori)) : ?>
                        <option value="<?= $k['id_kategori']; ?>"
                            <?= ($k['id_kategori'] == $b['id_kategori']) ? 'selected' : ''; ?>>
                            <?= $k['nama_kategori']; ?>
                        </option>
                        <?php endwhile; ?>

                    </select>
                </div>

                <div class="form-actions">
                    <button type="submit" name="update" class="btn btn-edit">Update</button>
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
            const judul = document.forms["formBuku"]["judul"].value.trim();
            const pengarang = document.forms["formBuku"]["pengarang"].value.trim();
            const kategori = document.forms["formBuku"]["kategori"].value;

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