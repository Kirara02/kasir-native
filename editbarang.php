<?php
session_start();
if (!isset($_SESSION['status'])) {
    header("location:index.php");
}

include "koneksi.php";
if (isset($_POST['update'])) {
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];
    $tgl = $_POST['tgl'];
    $kat = $_POST['kategori'];
    //codingan input img barang
    $directori = "img";
    $newfilename = date('dmYHis') . str_replace(" ", "", basename($_FILES["gambar"]["name"]));
    $upload = $directori . "/" . $newfilename;
    if (is_uploaded_file($_FILES['gambar']['tmp_name'])) {

        move_uploaded_file($_FILES['gambar']['tmp_name'], $upload);

        $query = mysqli_query($koneksi, "update barang set nmbarang='$nama',stok='$stok',harga='$harga',tglkedaluarsa='$tgl',kdkategori='$kat',picture='$newfilename' where kdbarang ='$kode'");
    } else {
        $query = mysqli_query($koneksi, "update barang set nmbarang='$nama',stok='$stok',harga='$harga',tglkedaluarsa='$tgl',kdkategori='$kat' where kdbarang ='$kode'");
    }

    if (mysqli_affected_rows($koneksi) > 0) {
        echo "<script>alert('Data Berhasil di Edit')</script>";
    } else {
        echo "<script>alert('Data Gagal di Edit')</script>";
    }
?>
    <script>
        window.location.replace("barang.php")
    </script>
<?php
}
$id = $_GET['id'];
$query = mysqli_query($koneksi, "select * from barang where kdbarang='$id'");
$data = mysqli_fetch_array($query);
$kategori = $data['kdkategori'];
$gambar = $data['picture']; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/editbarang.style.css">
    <title>Edit <?= $data["nmbarang"] ?></title>
</head>

<body>
    <div class="container">
        <div class="box">
            <form action="" method="post" enctype="multipart/form-data">
            <div class=""></div>
            <label for="kode"> Kode Barang : </label>
                <input type="text" id="kode" name="kode" value="<?= $data['kdbarang'] ?>" readonly>
            <div class=""></div>
                <label for="nama"> Nama Barang : </label>
                <input type="text" id="nama" name="nama" value="<?= $data['nmbarang'] ?>">
            <div class=""></div>
                <label for="stok"> Stok : </label>
                <input type="number" id="stok" name="stok" value="<?= $data['stok'] ?>">
            <div class=""></div>
                <label for="harga"> Harga : </label>
                <input type="text" id="harga" name="harga" value="<?= $data['harga'] ?>">
            <div class=""></div>
                <label for="tgl"> Tanggal Kadaluarsa : </label>
                <input type="date" id="tgl" name="tgl" value="<?= $data['tglkedaluarsa'] ?>">
            <div class=""></div>
                <label for="kategori"> Kode Kategori : </label>
                <select name="kategori" id="kategori">
                    <?php
                    $query = mysqli_query($koneksi, "select * from kategoribarang");
                    while ($data = mysqli_fetch_array($query)) {
                        if ($data['kdkategori'] == $kategori) {
                            $pilih = "selected";
                        } else {
                            $pilih = "";
                        }
                    ?>
                        <option value="<?= $data['kdkategori'] ?>" <?= $pilih ?>><?= $data['nmkategori'] ?></option>
                    <?php
                    }
                    ?>
                </select>
                <label> Gambar : </label>
                <?php
                if (isset($gambar)) {
                ?>
                    <img src="img/<?= $gambar ?>" alt="" width="120px" height="120px">
                <?php
                } ?>
                <label for="gambar"> Edit Gambar : </label>
                <input type="file" id="gambar" name="gambar">
                <div class="logDiv">
                    <button type="submit" value="Simpan" name="update"> Simpan </button>
                </div>
            </form>
            <br>
            <a href="home.php">
            <button class="prev">
                Kembali
            </button>
            </a>
        </div>
    </div>
    <script src="script.js"> </script>
</body>

</html>
<!-- <form action="" method="post" enctype="multipart/form-data">
<table>
    <tr>
        <td>Kode Barang:</td>
        <td>
            <input type="text" name="kode" id="" value="<?= $data['kdbarang'] ?>" readonly>
        </td>
    </tr>
    <tr>
        <td>Nama Barang:</td>
        <td>
            <input type="text" name="nama" value="<?= $data['nmbarang'] ?>" id="">
        </td>
    </tr>
    <tr>
        <td>Stok:</td>
        <td>
            <input type="number" name="stok" id="" value="<?= $data['stok'] ?>">
        </td>
    </tr>
    <tr>
        <td>Harga:</td>
        <td>
            <input type="number" name="harga" id="" value="<?= $data['harga'] ?>">
        </td>
    </tr>
    <tr>
        <td>Tanggal Kedaluarsa:</td>
        <td>
            <input type="date" name="tgl" id="" value="<?= $data['tglkedaluarsa'] ?>">
        </td>
    </tr>
    <tr>
        <td>Kode Kategori:</td>
        <td>
        <select name="kategori" id="">
            <?php
            $query = mysqli_query($koneksi, "select * from kategoribarang");
            while ($data = mysqli_fetch_array($query)) {
                if ($data['kdkategori'] == $kategori) {
                    $pilih = "selected";
                } else {
                    $pilih = "";
                }
            ?>
            <option value="<?= $data['kdkategori'] ?>" <?= $pilih ?>><?= $data['nmkategori'] ?></option>
                <?php
            }
                ?>
        </select>
        </td>
    </tr>
    <tr>
        <td>Gambar:</td>
        <td>
            <?php
            if (isset($gambar)) {
            ?>
            <img src="img/<?= $gambar ?>" alt="" width="120px" height="120px">
            <?php
            } ?>
        </td>    
    <tr>
    <td>Edit Gambar:</td>
        <td>
            <input type="file" name="gambar">
        </td>
    </tr>
    <tr>
        <td colspan="2" align="right">
            <input type="submit" value="Simpan" name="update">
        </td>
    </tr>
</table>
</form>
<br>
<a href="barang.php">Kembali</a> -->