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
    <link rel="stylesheet" href="assets/css/transaksi.style.css">
    <title>Transaksi</title>
</head>

<body>
    <div class="container">
        <div class="nav">
            <div class="search">
                <form action="" method="POST">
                    <i class="bx bx-search"></i>
                    <input type="text" id="keyword" name="txtcari">
                    <button type="submit" value="Cari" name="cari">Cari</button>
                </form>
            </div>
            <div class="insert">
                <a href="inputtransaksi.php">
                    <button>
                        Input Transaksi
                    </button>
                </a>
            </div>
        </div>
</body>

</html>
<table border="1" cellspacing=0>
    <tr>
        <th>No</th>
        <th>NOMORFAKTUR</th>
        <th>NAMA PEMBELI</th>
        <th>NAMA PETUGAS</th>
        <th>WAKTU</th>
        <th colspan="2">AKSI</th>
    </tr>
    <?php
    include "koneksi.php";
    if (isset($_POST['cari'])) {
        $cari = $_POST['txtcari'];
        $query = mysqli_query($koneksi, "SELECT * FROM transaksi inner join petugas on petugas.kdpetugas=transaksi.kdpetugas 
        join pembeli on pembeli.kdpembeli=transaksi.kdpembeli WHERE transaksi.nomorfaktur='$cari' OR petugas.nmpetugas like'%$cari%'  OR pembeli.nmpembeli like'%$cari%'");
    } else {
        $query = mysqli_query($koneksi, "select transaksi.nomorfaktur,pembeli.nmpembeli,petugas.nmpetugas,transaksi.waktu
        from transaksi inner join pembeli on pembeli.kdpembeli=transaksi.kdpembeli join petugas on petugas.kdpetugas=transaksi.kdpetugas order by nomorfaktur asc");
    }
    $no = 1;
    while ($data = mysqli_fetch_array($query)) { ?>
        <tr>
            <td><?= $no++  ?></td>
            <td><?= $data['nomorfaktur'] ?></td>
            <td><?= $data['nmpembeli'] ?></td>
            <td><?= $data['nmpetugas'] ?></td>
            <td><?= $data['waktu'] ?></td>
            <td>
                <div class="aksi">
                    <a href="detailtransaksi.php?id=<?= $data['nomorfaktur'] ?>">
                        <button class="edit">
                        Detail Transaksi
                    </button>
                </a>
                <a href="hapustransaksi.php?id=<?= $data['nomorfaktur'] ?>" onclick="return confirm('Hapus Data Transaksi Ini?')">
                    <button class="delete">
                        Hapus Transaksi
                    </button>
                </a>
            </div>
            </td>
        </tr>
    <?php
    } ?>
</table>
<a href="home.php">
    <button class="prev">
        Kembali
    </button>
</a>