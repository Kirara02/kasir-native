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
    <link rel="stylesheet" href="assets/css/inputpembeli.style.css">
    <title>Input Pmebeli</title>
</head>

<body>
    <div class="container">
        <div class="box">
            <h3>Input Pembeli</h3>
            <form action="" method="post">
                <label for="kode"> Kode Pembeli </label>
                <input type="text" id="kode" name="kode">
                <label for="nama"> Nama Pembeli </label>
                <input type="text" id="nama" name="nama">
                <label for="jk"> Jenis Kelamin </label>
                <input type="radio" id="jk" name="jk" value="L"> Laki Laki
                <input type="radio" id="jk" name="jk" value="P"> Perempuan
                <label for="alamat"> Alamat </label>
                <textarea name="alamat" id="alamat"></textarea>
                <label for="nohp"> No Handphone : </label>
                <input type="text" id="nohp" name="nohp">
                <div class="logDiv">
                    <button type="submit" value="Simpan" name="simpan">
                    Simpan
                    </button>
                </div>
            </form>
            <?php
            include "koneksi.php";
            if (isset($_POST['simpan'])) {
                $kode = $_POST['kode'];
                $nama = $_POST['nama'];
                $jk = $_POST['jk'];
                $alamat = $_POST['alamat'];
                $nohp = $_POST['nohp'];
                $query = mysqli_query($koneksi, "insert into pembeli values ('$kode','$nama','$jk','$alamat','$nohp')");
                if (mysqli_affected_rows($koneksi) > 0) {
                    echo "<script>alert('Data Berhasil Ditambahkan')</script>";
                } else {
                    echo "<script>alert('Data Gagal Ditambahkan')</script>";
                }
            ?>
                <script>
                    window.location.replace("pembeli.php")
                </script>
            <?php
            }
            ?>
            <a href="pembeli.php">
                <button class="prev">
                    Kembali
                </button>
            </a>
        </div>
    </div>
</body>

</html>