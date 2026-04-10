<?php
$buku = [
    [
        "id" => "ToSsOV8",
        "judul" => "Transfiguration of Semi-Sentient Objects Vol. VII",
        "penulis" => "Elphias Doge",
        "tahun" => 1963
    ],
    [
        "id" => "ODRfNC",
        "judul" => "Obscure Defensive Runes for Nocturnal Creatures",
        "penulis" => "Cassandra Vablatsky",
        "tahun" => 1892
    ],
    [
        "id" => "PSiUE",
        "judul" => "Potion Stabilization in Uncontrolled Environments",
        "penulis" => "Arsenius Jigger",
        "tahun" => 1931
    ],
    [
        "id" => "WotFFafs",
        "judul" => "Whispers of the Forbidden Forest: A Field Study",
        "penulis" => "Galatea Merrythought",
        "tahun" => 1971
    ],
    [
        "id" => "Bhmc",
        "judul" => "Bazura: Holy Magic Contradiction?",
        "penulis" => "Mary Kasparov",
        "tahun" => 1822
    ],
    [
        "id" => "TAiMTD",
        "judul" => "Temporal Anomalies in Magical Timekeeping Devices",
        "penulis" => "Saul Croaker",
        "tahun" => 1985
    ],
    [
        "id" => "ECfUMA",
        "judul" => "Experimental Charms for Unstable Magical Artifacts",
        "penulis" => "Bridget Wenlock",
        "tahun" => 1968
    ],
    [
        "id" => "IIaHMiWC",
        "judul" => "Invisible Ink and Hidden Messages in Wizard Communication",
        "penulis" => "Ignatia Wildsmith",
        "tahun" => 1875
    ],
    [
        "id" => "MHrpotsh",
        "judul" => "Magical Herbology: Rare Plants of the Scottish Highlands",
        "penulis" => "Pomona Sprout",
        "tahun" => 1982
    ]
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
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
    <h3>Daftar Buku</h3>
    <table>
        <tr>
            <th>No</th>
            <th>ID</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Tahun</th>
        </tr>

        <?php $i = 1;?>
        <?php foreach ($buku as $b): ?>
        <tr>
            <td><?= $i++;?></td>
            <td><?= $b["id"]; ?></td>
            <td><?= $b["judul"]; ?></td>
            <td><?= $b["penulis"]; ?></td>
            <td><?= $b["tahun"]; ?></td>
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