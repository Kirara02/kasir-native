<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/detail.style.css">
    <link rel="stylesheet" href="assets/boxicons-2.0.9/css/boxicons.css">
    <title>Barang</title>
</head>
<div class="konten">
    <div class="nav">
        <div class="search">
            <form id="forms" method="post">
                <i class="bx bx-search"></i>
                <input type="text" id="keyword" name="keyword">
                <button type="submit" value="Cari" name="cari">Cari</button>
        </div>
        </form>
    </div>
    <div class="list-barang">
        <?php 
use UI\Controls\Form;
session_start();
if(!isset($_SESSION['status'])) {
    header("location:index.php");
}
include "koneksi.php";

if(isset($_POST['cari'])){
    $cari = $_POST['keyword'];
    $query = mysqli_query($koneksi,"select * from barang where nmbarang like '%$cari%'");
}else{
$query = mysqli_query($koneksi,"select * from barang");
}
$id = $_GET['id'];

while($data = mysqli_fetch_array($query)){  
    if($data['stok']==0){
        $habis = "Stok habis";
    }else{
        $habis= "";
    }
    ?>
        <div class="beli">
            <form action="detailtransaksi.php?id=<?= $id ?>& kd=<?= $data['kdbarang']?>" method="post"
                enctype="multipart/form-data">
                <div>
                    <img src="img/<?= $data['picture'] ?>" alt="picture" width="180" height="150">
                </div>
                <div
                    style="width: 200px; text-align: center;position: absolute; margin-top: -80px; font-size: 35px; color: red; font-family: Georgia, 'Times New Roman', Times, serif;">
                    <?=$habis?>
                </div>
                <div class="info-produk">
                    <label for="">Produk : <?= $data['nmbarang']?></label><br>
                    <label for="">Harga : <?= $data['harga']?></label>
                </div>
                <div class="box-beli">
                    <div style="position: absolute;" class="jml-beli">
                        <input type="number" name="jml" id="">
                    </div>
                    <div style="position: relative; margin-left: 175px;" class="btn-beli">
                        <button type="submit" name="beli" class="prev">
                            Beli
                        </button>
                        </a>
                    </div>
                </div>
            </form>
        </div>
        <?php
}
?>
    </div>
</div>
<?php
$id = $_GET['id'];
    $query1 = mysqli_query($koneksi, "select * from transaksi join pembeli on pembeli.kdpembeli=transaksi.kdpembeli where nomorfaktur='$id'");
    $data1 = mysqli_fetch_array($query1);
?>
<div class="info-cos">
    <table>
        <tr>
            <td>NomorFaktu:</td>
            <td><?= $data1['nomorfaktur']?></td>
        </tr>
        <tr>
            <td>Nama Pembeli:</td>
            <td><?=$data1['nmpembeli'] ?></td>
        </tr>
        <tr>
            <td>Waktu:</td>
            <td><?= $data1['waktu'] ?></td>
        </tr>
    </table>
</div>
<div class="daftar">
    <table border="1" cellspacing="0" cellpadding="10" width=500>
        <tr>
            <th>No</th>
            <th width="100px">Nama barang</th>
            <th width="100px">Jumlah beli</th>
            <th width="100px">Harga</th>
            <th width="150px">Sub Total</th>
            <th width="50px">Aksi</th>
        </tr>
        <?php 
            if (isset($_POST['beli'])) {
                $nofak= $_GET['id'];
                $jml= $_POST['jml'];
                $kode = $_GET['kd'];
                if ($jml>=1) {
                    $detail = mysqli_query($koneksi, "select * from barang where kdbarang='$kode'");
                    $dd = mysqli_fetch_array($detail);
                    $harga = $dd['harga'];
                    $stok = $dd['stok'];

                    $sisa = $stok-$jml;
                    if ($stok < $jml) {
                        echo "<script>alert('Oops! Jumlah pengeluaran lebih besar dari stok ...')</script>";
                        "<script>document.location=detailtransaksi.php</script>";
                    } else {
                        $query2 = mysqli_query($koneksi, "insert into detailtransaksi values ('','$nofak','$kode','$jml','$harga')");
                        if ($query2) {
                            //update stok
                            $upstok= mysqli_query($koneksi, "UPDATE barang SET stok='$sisa' WHERE kdbarang='$kode'");
                        }
                    }
                } else {
                    echo "<script>window.location.replace('detailtransaksi.php?id='<?= $id ?>.')</script>";
        }
        }

        $query3 = mysqli_query($koneksi, "select *, detailtransaksi.harga as harga_dulu,barang.nmbarang as
        afterdelete from detailtransaksi join barang on barang.kdbarang=detailtransaksi.kdbarang where nomorfaktur='$id'
        order by iddetail asc");

        $no =1;
        $total = 0;
        while ($data3 = mysqli_fetch_array($query3)) {
        $harga = $data3['harga_dulu'];
        $jmlbl = $data3['jmlbeli'];
        $sub = $jmlbl*$harga;
        $total += $sub; ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $data3['afterdelete'] ?></td>
            <td><?= $data3['jmlbeli'] ?></td>
            <td><?= "Rp.".$data3['harga_dulu'] ?></td>
            <td><?= "Rp.".$sub ?></td>
            <td><a href="hapusdetail.php?idd=<?= $data3['iddetail']?>&id=<?= $id?>"
                    onclick="return confirm('Hapus Data Pembeli Ini?')">Cancel</a></td>
        </tr>
        <?php
                }
             ?>
        <tr>
            <td colspan="4">
                <center>Total</center>
            </td>
            <td colspan="2"><?= "Rp.".$total ?></td>
        </tr>
        <tr>
            <form action="" method="post">
                <td colspan="4">
                    <center>Masukan Uang</center>
                </td>
                <td colspan="1"><input type="number" name="uang" id="" style="width: 100%; border: none; height: 24px;"
                        placeholder="Masukan Uang"></td>
                <td>
                    <button type="submit" name="bayar" class="bayar">
                        Bayar
                    </button>
                </td>
            </form>
        </tr>
        <?php
        if (isset($_POST['bayar'])) {
                $uang = $_POST['uang'];
                $kembalian = $uang-$total;
                if($uang < $total){
                    $kembalian = $kembalian*-1;
                    $sisauang = "Uang kurang";
                    echo "<script>alert('Upps! Uang anda kurang $kembalian')</script>";
                }else{
                    $sisauang = "Kembalian";
                    $kembalian = $uang-$total;
                }    
                 ?>
        <tr>
            <td colspan="4">
                <center>Uang</center>
            </td>
            <td colspan="2">Rp.<?= $uang?></td>
        </tr>
        <tr>
            <td colspan=4>
                <center><?= $sisauang?></center>
            </td>
            <td colspan=2>Rp.<?= $kembalian ?></td>
        </tr>
        <?php
            }           
            ?>
    </table>
    <div class="log">
        <a href="inputtransaksi.php">
            <button class="prev">
                Keluar
            </button>
        </a>
    </div>
</div>