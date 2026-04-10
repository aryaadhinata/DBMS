<?php
$peminjaman = [
    [
        "id_peminjaman" => 301,
        "nama_peminjam" => "Padma Patil",
        "judul_buku" => "Temporal Anomalies in Magical Timekeeping Devices",
        "tanggal_pinjam" => "2026-03-28"
    ],
    [
        "id_peminjaman" => 302,
        "nama_peminjam" => "Blaise Zabini",
        "judul_buku" => "Obscure Defensive Runes for Nocturnal Creatures",
        "tanggal_pinjam" => "2026-03-30"
    ],
    [
        "id_peminjaman" => 303,
        "nama_peminjam" => "Terry Boot",
        "judul_buku" => "Transfiguration of Semi-Sentient Objects Vol. VII",
        "tanggal_pinjam" => "2026-04-01"
    ],
    [
        "id_peminjaman" => 304,
        "nama_peminjam" => "Susan Bones",
        "judul_buku" => "Whispers of the Forbidden Forest: A Field Study",
        "tanggal_pinjam" => "2026-04-02"
    ],
    [
        "id_peminjaman" => 305,
        "nama_peminjam" => "Anthony Goldstein",
        "judul_buku" => "Potion Stabilization in Uncontrolled Environments",
        "tanggal_pinjam" => "2026-04-03"
    ],
    [
        "id_peminjaman" => 306,
        "nama_peminjam" => "Cho Chang",
        "judul_buku" => "Invisible Ink and Hidden Messages in Wizard Communication",
        "tanggal_pinjam" => "2026-04-06"
    ],
    [
        "id_peminjaman" => 307,
        "nama_peminjam" => "Neville Longbottom",
        "judul_buku" => "Magical Herbology: Rare Plants of the Scottish Highlands",
        "tanggal_pinjam" => "2026-04-07"
    ]
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Perpustakaan Hogwarts - Peminjaman</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- HEADER -->
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

<!-- CONTENT -->
<main>
    <h3>Data Peminjaman Buku</h3>
    <table>
        <tr>
            <th>No</th>
            <th>ID</th>
            <th>Nama Peminjam</th>
            <th>Judul Buku</th>
            <th>Tanggal</th>
        </tr>

        <?php $i = 1;?>
        <?php foreach ($peminjaman as $p): ?>
        <tr>
            <td><?= $i++;?></td>
            <td><?= $p["id_peminjaman"]; ?></td>
            <td><?= $p["nama_peminjam"]; ?></td>
            <td><?= $p["judul_buku"]; ?></td>
            <td><?= $p["tanggal_pinjam"]; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</main>

<!-- FOOTER -->
<footer>
    <p>© 2026 - Dibuat oleh Arya Dhinata</p>
</footer>

</body>
</html>