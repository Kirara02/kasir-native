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
    <link rel="stylesheet" href="assets/css/kategori.style.css">
    <link rel="stylesheet" href="assets/boxicons-2.0.9/css/boxicons.css">
    <title>Kategori barang</title>
</head>

<body>
    <div class="nav">
        <div class="search">
            <form action="" method="POST">
                <i class="bx bx-search"></i>
                <input type="text" id="" name="txtcari">
                <button type="submit" value="Cari" name="cari">
        </div>
        </form>
        <div class="insert">
            <a href="inputkategori.php">
                <button>
                    Tambah Barang
                </button>
            </a>
        </div>
    </div>
    </table>
    <br>
    <table border="1" cellspacing=0>
        <thead>
            <tr>
                <th>No</th>
                <th>KODE KATEGORI</th>
                <th>NAMA KATEGORI</th>
                <th colspan="2">AKSI</th>
            </tr>
        </thead>
        <tbody>

            <?php
            include "koneksi.php";
            if (isset($_POST['cari'])) {
                $cari = $_POST['txtcari'];
                $query = mysqli_query($koneksi, "SELECT * FROM kategoribarang WHERE kdkategori like'%$cari%' OR nmkategori like'%$cari%'");
            } else {
                $query = mysqli_query($koneksi, "SELECT * FROM kategoribarang order by kdkategori asc");
            }
            $no = 1;
            while ($data = mysqli_fetch_array($query)) { ?>
                <tr>
                    <td><?= $no++  ?></td>
                    <td><?= $data['kdkategori'] ?></td>
                    <td><?= $data['nmkategori'] ?></td>
                    <td>
                        <div class="aksi">
                            <a href="editkategori.php?id=<?= $data['kdkategori'] ?>">
                                <button class="edit">
                                    Edit
                                </button>
                            </a>
                            <a href="hapuskategori.php?id=<?= $data["kdkategori"] ?>" onclick="return confirm('Hapus Data barang Ini?')">
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
</body>

</html>