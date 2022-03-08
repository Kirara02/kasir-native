<?php
session_start();
if (!isset($_SESSION['status'])) {
    header("location:index.php");
}

include "koneksi.php";
if (isset($_POST['update'])) {
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];

    $query = mysqli_query($koneksi, "update kategoribarang set nmkategori='$nama' where kdkategori ='$kode'");
    if (mysqli_affected_rows($koneksi) > 0) {
        echo "<script>alert('Data Berhasil di Edit')</script>";
    } else {
        echo "<script>alert('Data Berhasil di Edit')</script>";
    }
?>
    <script>
        window.location.replace("kategori.php")
    </script>
<?php
}
$id = $_GET['id'];
$query = mysqli_query($koneksi, "select * from kategoribarang where kdkategori='$id'");
$data = mysqli_fetch_array($query); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/editkategori.style.css">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="box">
            <form action="" method="post">
                <label for="kode"> Kode Petugas : </label>
                <input type="text" id="kode" name="kode" value="<?= $data["kdkategori"] ?>" readonly>
                <label for="nama"> Nama Petugas : </label>
                <input type="text" id="nama" name="nama" value="<?= $data["nmkategori"] ?>">
                <div class="logDiv">
                    <button type="submit" value="Simpan" name="update">
                    Simpan    
                </button>
                </div>
            </form>
            <br>
            <a href="kategori.php">
                <button class="prev">
                    Kembali
                </button>
            </a>
        </div>
    </div>
</body>

</html>