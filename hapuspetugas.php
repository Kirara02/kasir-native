<?php
session_start();
if(!isset($_SESSION['status'])) {
    header("location:index.php");
}

include "koneksi.php";
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = mysqli_query($koneksi,"delete from petugas where kdpetugas='$id'");
    $query2 = mysqli_query($koneksi,"delete from transaksi where kdpetugas='$id'");
    if(mysqli_affected_rows($koneksi)>0){
        echo "<script>alert('data berhasil dihapus')</script>";
    }else{
        echo "<script>alert('data gagal dihapus')</script>";
    }
}
?>
<script>
window.location.replace("petugas.php")
</script>