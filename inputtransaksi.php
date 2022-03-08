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
    <link rel="stylesheet" href="assets/css/inputtransaksi.style.css">
    <title>Input Transaksi</title>
</head>

<body>
    <div class="container">
        <div class="box">
            <form action="" method="post">
                <label for="nomor"> Nomor Faktur : </label>
                <input type="text" id="nomor" name="nomor">
                <label for="kdpem"> Nama Pembeli : </label>
                <select name="kdpem" id="">
                    <?php
                    include "koneksi.php";
                    $query = mysqli_query($koneksi, "select * from pembeli");
                    while ($data = mysqli_fetch_array($query)) {
                    ?>
                        <option value="<?= $data['kdpembeli'] ?>"><?= $data['nmpembeli'] ?></option>
                    <?php
                    }
                    ?>
                </select>
                <label for="waktu"> Waktu : </label>
                <input type="datetime-local" id="waktu" name="waktu">
                <div class="logDiv">
                    <button type="submit" value="Proses" name="proses">
                        Proses
                    </button>
                </div>
            </form>
            <?php
            if (isset($_POST['proses'])) {
                $nomor = $_POST['nomor'];
                $kdpem = $_POST['kdpem'];
                $kdpet = $_SESSION['user']['kdpetugas'];
                $waktu = $_POST['waktu'];

                $query = mysqli_query($koneksi, "insert into transaksi values ('$nomor','$kdpem','$kdpet','$waktu')");

                $tampil = mysqli_query($koneksi, "select transaksi.nomorfaktur,pembeli.nmpembeli,petugas.nmpetugas,transaksi.waktu
                          from transaksi inner join pembeli on pembeli.kdpembeli=transaksi.kdpembeli join petugas on petugas.kdpetugas=transaksi.kdpetugas where nomorfaktur='$nomor'");
                $data1 = mysqli_fetch_array($tampil);
            ?>
                <div class="aksi">
                    <a href="detailtransaksi.php?id=<?= $data1['nomorfaktur'] ?>">
                    <button class="edit">
                        Detail Belanja
                    </button>
                        </a>
                    <a href="hapustransaksi.php?id=<?= $data1['nomorfaktur'] ?>" onclick="return confirm('Hapus Data Belanja Ini?')">
                    <button class="delete">
                        Hapus Belanja
                    </button>
                        </a>
                </div>
                <table cellspacing=0 border="1">
                    <tr>
                        <th>NomorFaktur</th>
                        <th>Nama Pembeli</th>
                        <th>Nama Petugas</th>
                        <th>waktu</th>
                    </tr>
                    <tr>
                        <td><?= $data1['nomorfaktur'] ?></td>
                        <td><?= $data1['nmpembeli'] ?></td>
                        <td><?= $data1['nmpetugas'] ?></td>
                        <td><?= $data1['waktu'] ?></td>
                    </tr>
                </table>
            <?php
            }
            ?>
            <a href="transaksi.php">
                <button class="prev">
                    Daftar Transaksi
                </button>
            </a>
        </div>
    </div>
</body>

</html>