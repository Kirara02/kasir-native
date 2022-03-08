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
    <link rel="stylesheet" href="assets/css/barang.style.css">
    <link rel="stylesheet" href="assets/boxicons-2.0.9/css/boxicons.css">
    <title>Barang</title>
</head>

<body>
    <div class="container">
        <div class="nav">
            <div class="search">
                <form id="forms">
                    <i class="bx bx-search"></i>
                    <input type="text" id="keyword" name="keyword">
                </div>
            </form>
            <div class="insert">
                <a href="inputbarang.php">
                <button>
                    Tambah Barang
                </button>
                </a>
            </div>
        </div>
        <table border="1" cellspacing=0>
            <thead>
                <tr>
                    <th>No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Stok</th>
                <th>Harga</th>
                <th>Tanggal Kedaluarsa</th>
                <th>Kode kategori</th>
                <th>Gambar</th>
                <th colspan="2">AKSI</th>
            </tr>
            </thead>
            <tbody id="tbody">
                <?php
            include "koneksi.php";
            $query = mysqli_query($koneksi, "SELECT * FROM barang join kategoribarang as kb on kb.kdkategori=barang.kdkategori order by kdbarang asc");
            $no = 1;
            while ($data = mysqli_fetch_assoc($query)) {
            ?>
                <tr>
                    <td><?= $no++  ?></td>
                    <td><?= $data['kdbarang'] ?></td>
                    <td><?= $data['nmbarang'] ?></td>
                    <td><?= $data['stok'] ?></td>
                    <td><?= $data['harga'] ?></td>
                    <td><?= $data['tglkedaluarsa'] ?></td>
                    <td><?= $data['nmkategori'] ?></td>
                    <td>
                        <img src="img/<?= $data['picture'] ?>" alt="Gambar">
                    </td>
                    <td>
                        <div class="aksi">
                            <a href="editbarang.php?id=<?= $data['kdbarang'] ?>">
                                <button class="edit">
                                Edit
                                </button>
                            </a>
                            <a href="hapusbarang.php?id=<?= $data['kdbarang'] ?>" onclick="return confirm('Hapus Data barang Ini?')">
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
    <script src="assets/js/barang.script.js" defer></script>
</body>
</html>