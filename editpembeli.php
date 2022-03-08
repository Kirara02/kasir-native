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

    $query = mysqli_query($koneksi, "update pembeli set nmpembeli='$nama',jk='$jk',alamat='$alamat',nohp='$nohp' where kdpembeli ='$kode'");
    if (mysqli_affected_rows($koneksi) > 0) {
        echo "<script>alert('Data Berhasil di Edit')</script>";
    } else {
        echo "<script>alert('Data Berhasil di Edit')</script>";
    }
?>
    <script>
        window.location.replace("pembeli.php")
    </script>
<?php
}
$id = $_GET['id'];
$query = mysqli_query($koneksi, "select * from pembeli where kdpembeli='$id'");
$data = mysqli_fetch_array($query); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/editpembeli.style.css">
    <title>Edit <?= $data["nmpembeli"] ?></title>
</head>

<body>
    <div class="container">
        <div class="box">
            <form action="" method="post">
                <label for="kode"> Kode Petugas : </label>
                <input type="text" id="kode" name="kode" value="<?= $data["kdpembeli"] ?>">
                <label for="nama"> Nama Petugas : </label>
                <input type="text" id="nama" name="nama" value="<?= $data["nmpembeli"] ?>">
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
                <input type="radio" name="jk" id="jk" value="L" <?= $l ?>> Laki-laki
                <input type="radio" name="jk" id="jk" value="P" <?= $p ?>> Perempuan
                <label for="alamat"> Alamat : </label>
                <textarea name="alamat" id="alamat"><?= $data["alamat"] ?></textarea>
                <label for="nohp"> No Handphone : </label>
                <input type="text" id="nohp" name="nohp" value="<?= $data['nohp'] ?>">
                <div class="logDiv">
                    <button type="submit" value="Simpan" name="update">
                        Simpan
                    </button>
                </div>
            </form>
            <a href="pembeli.php">
                <button class="prev">
                    Kembali
                </button>
            </a>
        </div>
    </div>
</body>

</html>