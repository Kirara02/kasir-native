<?php
session_start();
if (!isset($_SESSION['status'])) {
    header("location:index.php");
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/home.style.css">
    <link rel="stylesheet" href="assets/boxicons-2.0.9/css/boxicons.css">
    <title>Barang</title>
</head>

<body>
    <h2 style="text-align: center;">Selamat datang <?= $_SESSION['user']['nmpetugas'] ?></h2>
    <div class="konten">
        <div class="insert">
            <a href="barang.php">
                <button>
                    Data Barang
                </button>
            </a>
        </div>
        <div class="insert">
            <a href="kategori.php">
                <button>
                    Data Kategori
                </button>
            </a>
        </div>
        <div class="insert">
            <a href="pembeli.php">
                <button>
                    Data Pembeli
                </button>
            </a>
        </div>
        <div class="insert">
            <a href="petugas.php">
                <button>
                    Data Petugas
                </button>
            </a>
        </div>
        <div class="insert">
            <a href="transaksi.php">
                <button>
                    Data transaksi
                </button>
            </a>
        </div>
    </div>

    <div class="log">
        <a href="logout.php">
            <button class="prev">
                Logout
            </button>
        </a>
    </div>
</body>