<?php
session_start();
if (!isset($_SESSION['status'])) {
    header("location:index.php");
}

include "koneksi.php";
if (isset($_POST['update'])) {
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $jk = $_POST['jk'];
    $alamat = $_POST['alamat'];
    $nohp = $_POST['nohp'];
    $level = $_POST['level'];
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $query = mysqli_query($koneksi, "update petugas set nmpetugas='$nama',jk='$jk',alamat='$alamat',nohp='$nohp',level='$level',username='$user',password='$pass' where kdpetugas ='$kode'");
    if (mysqli_affected_rows($koneksi) > 0) {
        echo "<script>alert('Data Berhasil di Edit')</script>";
    } else {
        echo "<script>alert('Data Berhasil di Edit')</script>";
    }
?>
<script>
window.location.replace("petugas.php")
</script>
<?php
}
$id = $_GET['id'];
$query = mysqli_query($koneksi, "select * from petugas where kdpetugas='$id'");
$data = mysqli_fetch_array($query); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/editpetugas.style.css">
    <title>Edit <?= $data["nmpetugas"] ?></title>
</head>

<body>
    <div class="container">
        <div class="box">
            <form action="" method="post">
                <label for="kode"> Kode Petugas : </label>
                <input type="text" id="kode" name="kode" value="<?= $data["kdpetugas"] ?>">
                <label for="nama"> Nama Petugas : </label>
                <input type="text" id="nama" name="nama" value="<?= $data["nmpetugas"] ?>">
                <?php
                if ($data['jk'] == 'L') {
                    $l = "checked";
                } else {
                    $l = "";
                }
                if ($data['jk'] == 'P') {
                    $p = "checked";
                } else {
                    $p = "";
                }
                ?>
                <label for="jk"> Jenis Kelamin : </label>
                <input type="radio" name="jk" id="jk" value="L" <?= $l ?>>Laki-laki
                <input type="radio" name="jk" id="jk" value="P" <?= $p ?>>Perempuan
                <label for="alamat"> Alamat : </label>
                <textarea name="alamat" id="alamat" cols="21" rows=5"><?= $data['alamat'] ?></textarea>
                <label for="nohp"> No Handphone : </label>
                <input type="text" id="nohp" name="nohp" value="<?= $data["nohp"] ?>">
                <label for="level"> Level : </label>
                <?php
                if ($data['level'] == 'Pemilik') { ?>
                <select name="level" id="">
                    <option value="Pemilik">Pemilik</option>
                    <option value="Pegawai">Pegawai</option>
                </select>
                <?php } else { ?>
                <select name="level" id="">
                    <option value="Pegawai">Pegawai</option>
                    <option value="Pemilik">Pemilik</option>
                </select>
                <?php } ?>
                <label for="username"> Username : </label>
                <input type="text" id="username" name="username" value="<?= $data["username"] ?>">
                <label for="password"> Password : </label>
                <input type="password" id="password" name="password" value="<?= $data["password"] ?>">
                <div class="logDiv">
                    <button type="submit" value="Simpan" name="update">
                        Simpan
                    </button>
                </div>
            </form>
            <a href="petugas.php">
                <button class="prev">
                    Kembali
                </button>
            </a>
        </div>
    </div>
</body>

</html>