<?php
// array buat data dummy
$matkul = [
    ["nama" => "Software Engineering & Project Management", "kode" => "MK001", "sks" => 4],
    ["nama" => "Web & Mobile Programming", "kode" => "MK002", "sks" => 4],
    ["nama" => "Artificial Intelligence", "kode" => "MK003", "sks" => 4],
    ["nama" => "Database Management System", "kode" => "MK004", "sks" => 4],
];

// inisialisasi variabel
$judul    = "Daftar Mata Kuliah";
$semester = "Genap 2026/2027";
$total_sks    = 16;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <div class="header">
        <h2>Sistem Informasi Akademik Ilmu Komputer</h2>
        <p>Selamat Datang di website kami</p>
    </div>

    <!-- container/ content -->
    <div class="container">
        <h1><?php echo $judul; ?></h1>
        <p>Semester: <?php echo $semester; ?></p>


        <!-- table -->
        <table class="table">
            <tr>
                <!-- header table -->
                <th>Kode</th>
                <th>Nama Mata Kuliah</th>
                <th>SKS</th>
            </tr>

            <!-- nampilin semua data di array $matkul -->
            <?php
                foreach ($matkul as $m) {
                    echo "<tr>";
                    echo "<td>" . $m["kode"] . "</td>"; // echo kode
                    echo "<td>" . $m["nama"] . "</td>"; // echo nama
                    echo "<td>" . $m["sks"] . "</td>"; // echo sks
                    echo "</tr>";
                }
            ?>
        </table>
        <!-- echo total sks dari variabel -->
        <p class="total">Total SKS: <?php echo $total_sks; ?></p>
        </div>

        <!-- footer -->
        <div class="footer">
            <p>&copy;2026 Computer Science</p>
        </div>
</body>
</html>