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
    <link rel="stylesheet" href="assets/css/inputpetugas.style.css">
    <title>Input Petugas</title>
</head>

<body>
    <div class="container">
        <div class="box">
            <form action="" method="post" enctype="multipart/form-data">
                <label for="kode"> Kode Petugas : </label>
                <input type="text" id="kode" name="kode">
                <label for="nama"> Nama Petugas : </label>
                <input type="text" id="nama" name="nama">
                <label for="jk"> Jenis Kelamin : </label>
                <input type="radio" name="jk" id="jk" value="L"> Laki-laki
                <input type="radio" name="jk" id="jk" value="P"> Perempuan
                <label for="alamat"> Alamat : </label>
                <textarea name="alamat" id="alamat"></textarea>
                <label for="nohp"> No Handphone : </label>
                <input type="text" id="nohp" name="nohp">
                <label for="level"> Level </label>
                <select name="level" id="level">
                    <option value="Pemilik">Pemilik</option>
                    <option value="Pegawai">Pegawai</option>
                </select>
                <label for="user"> Username : </label>
                <input type="text" id="user" name="user">
                <label for="password"> Password : </label>
                <input type="password" name="password">
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
                $level = $_POST['level'];
                $user = $_POST['username'];
                $pass = $_POST['password'];

                $query = mysqli_query($koneksi, "insert into petugas values ('$kode','$nama','$jk','$alamat','$nohp','$level','$user','$pass')");
                if (mysqli_affected_rows($koneksi) > 0) {
                    echo "<script>alert('Data Berhasil Ditambahkan')</script>";
                } else {
                    echo "<script>alert('Data Gagal Ditambahkan')</script>";
                }
            ?>
            <script>
            window.location.replace("petugas.php")
            </script>
            <?php
            }
            ?>
            <br>
            <a href="petugas.php">
                <button class="prev">
                    Kembali
                </button>
            </a>
        </div>
    </div>
</body>

</html>