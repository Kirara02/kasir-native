<?php
session_start();
if (!isset($_SESSION['status'])) {
    header("location:index.php");
}

include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/inputbarang.style.css">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="box">
            <h3>FORM INPUT BARANG</h3>
            <form action="" method="post" enctype="multipart/form-data">
                <label for="kode"> Kode Barang : </label>
                <input type="text" id="kode" name="kode">
                <label for="nama"> Nama Barang : </label>
                <input type="text" id="nama" name="nama">
                <label for="stok"> Stok : </label>
                <input type="number" id="stok" name="stok">
                <label for="harga"> Harga : </label>
                <input type="number" id="harga" name="harga">
                <label for="tgl"> Tanggal Kadaluarsa : </label>
                <input type="date" id="tgl" name="tgl">
                <label for="kategori"> Nama Kategori : </label>
                <select name="kategori" id="kategori">
                    <?php
                    $query = mysqli_query($koneksi, "select * from kategoribarang");
                    while ($data = mysqli_fetch_array($query)) {
                    ?>
                        <option value="<?= $data['kdkategori'] ?>"><?= $data['nmkategori'] ?></option>
                    <?php
                    }
                    ?>
                </select>
                <label for="gambar"> Gambar : </label>
                <input type="file" id="gambar" name="gambar">
                <div class="logDiv">
                    <button type="submit" value="Simpan" name="simpan"> Simpan </button>
                </div>
            </form>
            <?php
            if (isset($_POST['simpan'])) {
                $kode = $_POST['kode'];
                $nama = $_POST['nama'];
                $stok = $_POST['stok'];
                $harga = $_POST['harga'];
                $tgl = $_POST['tgl'];
                $kat = $_POST['kategori'];
                //codingan input gambar
                $directori = "img";
                $newfilename = date('dmYHis') . str_replace(" ", "", basename($_FILES["gambar"]["name"]));
                $upload = $directori . "/" . $newfilename;
                if (is_uploaded_file($_FILES['gambar']['tmp_name'])) {

                    move_uploaded_file($_FILES['gambar']['tmp_name'], $upload);

                    $query = mysqli_query($koneksi, "insert into barang values ('$kode','$nama','$stok','$harga','$tgl','$kat','$newfilename')");
                } else {
                    $query = mysqli_query($koneksi, "insert into barang values ('$kode','$nama','$stok','$harga','$tgl','$kat");
                }
                if (mysqli_affected_rows($koneksi) > 0) {
                    echo "data berhasil disimpan";
                } else {
                    echo "data gagal disimpan";
                }
            ?>
                <script>
                    window.location.replace("barang.php")
                </script>
            <?php
            }
            ?>
            <br>
            <a href="home.php">
            <button class="prev">
                Kembali
            </button>
            </a>
        </div>
    </div>
</body>

</html>