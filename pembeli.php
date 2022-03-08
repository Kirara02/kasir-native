<?php
session_start();
if (!isset($_SESSION['status'])) {
    header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/boxicons-2.0.9/css/boxicons.css">
    <link rel="stylesheet" href="assets/css/pembeli.style.css">
    <title>Pembeli</title>
</head>

<body>
    <div class="container">
        <div class="nav">
            <div class="search">
                <form action="" method="POST">
                    <i class="bx bx-search"></i>
                    <input type="text" id="keyword" name="keyword">
                    <button type="submit" value="Cari" name="cari">Cari</button>
            </div>
            </form>
            <div class="insert">
                <a href="inputpembeli.php">
                    <button>
                        Tambah Data
                    </button>
                </a>
            </div>
        </div>
        <table border="1" cellspacing=0>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Petugas</th>
                    <th>Nama Petugas</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th>No HP</th>
                    <th colspan="2">AKSI</th>
                </tr>
            </thead>
            <tbody>

                <?php
                include "koneksi.php";
                if (isset($_POST['cari'])) {
                    $cari = $_POST['keyword'];
                    $query = mysqli_query($koneksi, "SELECT * FROM pembeli WHERE kdpembeli like'%$cari%' OR nmpembeli like'%$cari%'");
                } else {
                    $query = mysqli_query($koneksi, "SELECT * FROM pembeli order by kdpembeli asc");
                }
                $no = 1;
                while ($data = mysqli_fetch_assoc($query)) {
                ?>
                    <tr>
                        <td><?= $no++  ?></td>
                        <td><?= $data['kdpembeli'] ?></td>
                        <td><?= $data['nmpembeli'] ?></td>
                        <td><?= $data['jk'] ?></td>
                        <td><?= $data['alamat'] ?></td>
                        <td><?= $data['nohp'] ?></td>
                        <td>
                            <div class="aksi">
                                <a href="editpembeli.php?id=<?= $data['kdpembeli'] ?>">
                                    <button class="edit">
                                        Edit
                                    </button>
                                </a>
                                <a href="hapuspembeli.php?id=<?= $data['kdpembeli'] ?>" onclick="return confirm('Hapus Data Pembeli Ini?')">
                                    <button class="delete">
                                        Hapus
                                    </button>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php
                } ?>
            </tbody>
        </table>
        <a href="home.php">
            <button class="prev">
                Kembali
            </button>
        </a>
    </div>
</body>
<script src="assets/js/barang.script.js" defer></script>
</html>