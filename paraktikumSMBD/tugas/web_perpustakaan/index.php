<?php
include 'koneksi.php';

$query = "
SELECT b.id_buku, b.judul_buku, b.pengarang, k.nama_kategori
FROM buku b
INNER JOIN kategori k ON b.id_kategori = k.id_kategori
";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="logo.png" type="image/png">
    <title>Perpustakaan Hogwarts - Buku</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <!-- HEADER -->
    <header>
        <h1>Perpustakaan Hogwarts</h1>
        <h2>Halaman Data Buku</h2>
        <nav>
            <ul>
                <li><a href="index.php" class="active">Data Buku</a></li>
                <li><a href="peminjaman.php">Data Peminjaman</a></li>
            </ul>
        </nav>
    </header>

    <!-- CONTENT -->
    <main>
        <table>
            <tr>
                <th>No</th>
                <th>ID Buku</th>
                <th>Judul Buku</th>
                <th>Pengarang</th>
                <th>Kategori</th>
                <th>Aksi</th>
            </tr>

            <?php $i = 1; ?>
            <?php while ($b = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= $b["id_buku"]; ?></td>
                <td><?= $b["judul_buku"]; ?></td>
                <td><?= $b["pengarang"]; ?></td>
                <td><?= $b["nama_kategori"]; ?></td>
                <td>
                    <a href="edit.php?id=<?= $b['id_buku']; ?>" class="btn btn-edit">Edit</a>
                    <a href="#" class="btn btn-hapus"
                        onclick="openModal('hapus.php?id=<?= $b['id_buku']; ?>'); return false;">
                        Hapus
                    </a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
        <a href="tambah.php" class="btn btn-tambah">+ Tambah Buku</a>
    </main>

    <!-- FOOTER -->
    <footer>
        <p>© 2026 - Dibuat oleh Arya Dhinata</p>
    </footer>

    <div id="modalConfirm" class="modal">
        <div class="modal-box">
            <h3>Konfirmasi Hapus</h3>
            <p>Apakah kamu yakin ingin menghapus data ini?</p>

            <div class="modal-actions">
                <button onclick="closeModal()" class="btn">Batal</button>
                <a id="confirmDelete" class="btn btn-danger">Hapus</a>
            </div>
        </div>
    </div>

    <div id="toast" class="toast"></div>

    <script>
        function openModal(url) {
            document.getElementById("modalConfirm").style.display = "flex";
            document.getElementById("confirmDelete").href = url;
        }

        function closeModal() {
            document.getElementById("modalConfirm").style.display = "none";
        }

        window.addEventListener('load', function () {
            const msg = localStorage.getItem('toast');

            if (!msg) return;

            const toast = document.getElementById("toast");
            if (!toast) return;

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