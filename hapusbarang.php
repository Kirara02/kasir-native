<?php
session_start();
if(!isset($_SESSION['status'])) {
    header("location:index.php");
}

include "koneksi.php";
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $queri = mysqli_query($koneksi,"select * from detailtransaksi where kdbarang='$id'");
    if(mysqli_num_rows($queri)>0){
        echo "<script>alert('Maap, data tidak bisa dihapus')</script>";
    }else{
        $query = mysqli_query($koneksi, "delete from barang where kdbarang='$id'");
        if (mysqli_affected_rows($koneksi)>0) {
            echo "<script>alert('data berhasil dihapus')</script>";
        } else {
            echo "<script>alert('data gagal dihapus')</script>";
        }
    }
}
?>
<script>
window.location.replace("barang.php")
</script>