<?php 
session_start();
if (!isset($_SESSION['status'])) {
    header("location:index.php");
}
require_once "koneksi.php";
$keywords = $_POST["keyword"];
$sql = "SELECT * FROM barang WHERE nmbarang LIKE '%$keywords%' OR kdbarang LIKE '%$keywords%' OR stok LIKE '%$keywords%' OR harga LIKE '%$keywords%' OR tglkedaluarsa LIKE '%$keywords%' OR kdkategori LIKE '%$keywords%'";
$result = mysqli_query($koneksi, $sql);

$output = "";

while ($data = mysqli_fetch_assoc($result)) {
    if ($output != "") $output .= ",";
    $output .= '{ "kdbarang" : "' . $data["kdbarang"] . '",';
    $output .= '"nmbarang" : "' . $data["nmbarang"] . '",';
    $output .= '"stok" : "' . $data["stok"] . '",';
    $output .= '"harga" : "' . $data["harga"] . '",';
    $output .= '"tglkedaluarsa" : "' . $data["tglkedaluarsa"] . '",';
    $output .= '"kdkategori" : "' . $data["kdkategori"] . '",';
    $output .= '"picture" : "' . $data["picture"] . '"}';
}

$output = '{ "data" : [' . $output . ']}';

echo($output);