<?php
include 'koneksi.php';

$query = "
SELECT p.id_peminjaman, p.nama_peminjam, b.judul_buku, p.tgl_pinjam
FROM peminjaman p
INNER JOIN buku b ON p.id_buku = b.id_buku
";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="logo.png" type="image/png">
    <title>Perpustakaan Hogwarts - Peminjaman</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <header>
        <h1>Perpustakaan Hogwarts</h1>
        <h2>Halaman Data Peminjaman</h2>
        <nav>
            <ul>
                <li><a href="index.php">Data Buku</a></li>
                <li><a href="peminjaman.php" class="active">Data Peminjaman</a></li>
            </ul>
        </nav>
    </header>

    <main>

        <table>
            <tr>
                <th>No</th>
                <th>ID</th>
                <th>Nama Peminjam</th>
                <th>Judul Buku</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>

            <?php $i = 1; ?>
            <?php while ($p = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= $p["id_peminjaman"]; ?></td>
                <td><?= $p["nama_peminjam"]; ?></td>
                <td><?= $p["judul_buku"]; ?></td>
                <td><?= $p["tgl_pinjam"]; ?></td>
                <td>
                    <a href="editPeminjam.php?id=<?= $p['id_peminjaman']; ?>" class="btn btn-edit">
                        Edit
                    </a>

                    <a href="#" class="btn btn-hapus"
                        onclick="openModal('hapus_peminjaman.php?id=<?= $p['id_peminjaman']; ?>'); return false;">
                        Hapus
                    </a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
        <a href="tambahPeminjam.php" class="btn btn-tambah">+ Tambah Peminjaman</a>
    </main>

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