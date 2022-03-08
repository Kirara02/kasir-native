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
    <link rel="stylesheet" href="assets/css/petugas.style.css">
    <title>Petugas</title>
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
                <a href="inputpetugas.php">
                    <button>
                        Tambah Data
                    </button>
                </a>
            </div>
        </div>
        </table>
        <br>
        <table border="1" cellspacing=0>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Petugas</th>
                    <th>Nama Petugas</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th>No HP</th>
                    <th>Level</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th colspan="2">AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "koneksi.php";
                if ($_SESSION['user']['level']=='Pemilik') {
                    if (isset($_POST['cari'])) {
                        $cari = $_POST['txtcari'];
                        $query = mysqli_query($koneksi, "SELECT * FROM petugas WHERE kdpetugas='$cari' OR nmpetugas like'%$cari%'  OR username like'%$cari%'");
                    } else {
                        $query = mysqli_query($koneksi, "SELECT * FROM petugas order by kdpetugas asc");
                    }
                }else{
                    if (isset($_POST['cari'])) {
                        $cari = $_POST['txtcari'];
                        $query = mysqli_query($koneksi, "SELECT * FROM petugas WHERE kdpetugas='$cari' OR nmpetugas like'%$cari%'  OR username like'%$cari%'");
                    } else {
                        $id = $_SESSION['user']['kdpetugas'];
                        $query = mysqli_query($koneksi, "SELECT * FROM petugas where kdpetugas='$id'");
                    }
                }
                $no = 1;
                while ($data = mysqli_fetch_assoc($query)) {
        
          
            ?>
                <tr>
                    <td><?= $no++  ?></td>
                    <td><?= $data['kdpetugas'] ?></td>
                    <td><?= $data['nmpetugas'] ?></td>
                    <td><?= $data['jk'] ?></td>
                    <td><?= $data['alamat'] ?></td>
                    <td><?= $data['nohp'] ?></td>
                    <td><?= $data['level'] ?></td>
                    <td><?= $data['username'] ?></td>
                    <td><?= $data['password'] ?></td>
                    <td>
                        <div class="aksi">
                            <a href="editpetugas.php?id=<?= $data['kdpetugas'] ?>">
                                <button class="edit">
                                    Edit
                                </button>
                            </a>
                            <a href="hapuspetugas.php?id=<?= $data['kdpetugas'] ?>"
                                onclick="return confirm('Hapus Data Petugas Ini?')">
                                <button class="delete">
                                    Hapus
                                </button>
                            </a>
                        </div>
                </tr>
                <?php
                } ?>
            </tbody>
        </table>
        <a href="home.php">
            <button class="prev">
                Kembali
            </button>
        </a>
    </div>
</body>

</html>