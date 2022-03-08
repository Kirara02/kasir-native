<?php
session_start();
if(!isset($_SESSION['status'])) {
    header("location:index.php");
}
include "koneksi.php";
$idd = $_GET['idd'];
$id = $_GET['id'];

$query = mysqli_query($koneksi,"select * from detailtransaksi where iddetail='$idd'");
$data = mysqli_fetch_array($query);
$kd = $data['kdbarang'];
$query1 = mysqli_query($koneksi,"select * from barang where kdbarang='$kd'");
$data1 = mysqli_fetch_array($query1);

$sisa = $data1['stok']+$data['jmlbeli'];

if(isset($_GET['idd'])){
    $update = mysqli_query($koneksi,"update barang set stok='$sisa' where kdbarang = '$kd' ");
    if($update){
        $query2 = mysqli_query($koneksi,"delete from detailtransaksi where iddetail='$idd'");
    }
}
?>
<script>window.location.replace("detailtransaksi.php?id=<?= $id ?>")</script>