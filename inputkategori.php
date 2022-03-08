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
    <link rel="stylesheet" href="assets/css/inputbarang.style.css">
    <title>Input Kategori</title>
</head>

<body>
    <div class="container">
        <div class="box">
            <h3>Input Kategori</h3>
            <form action="" method="post">
                <label for="kode"> Kode Kategori : </label>
                <input type="text" id="kode" name="kode">
                <label for="nama"> Nama Kategori : </label>
                <input type="text" id="nama" name="nama">
                <div class="logDiv">
                    <button type="submit" name="simpan" value="simpan">
                        Simpan
                    </button>
                </div>
            </form>
            <?php
            include "koneksi.php";
            if (isset($_POST['simpan'])) {
                $kode = $_POST['kode'];
                $nama = $_POST['nama'];
                $query = mysqli_query($koneksi, "INSERT INTO kategoribarang VALUES ('$kode','$nama')");
                if (mysqli_affected_rows($koneksi) > 0) {
                    echo "<script>alert('Data Berhasil Ditambahkan')</script>";
                } else {
                    echo "<script>alert('Data Berhasil Ditambahkan')</script>";
                }
            ?>
                <script>
                    window.location.replace("kategori.php")
                </script>
            <?php
            }
            ?>
            <br>
            <a href="kategori.php">
                <button class="prev">
                    Lihat semua data
                </button>
            </a>
        </div>
    </div>
</body>

</html>