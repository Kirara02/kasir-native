<?php 
include "koneksi.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/index.style.css">
    <link rel="stylesheet" href="assets/boxicons-2.0.9/css/boxicons.css">
    <title>KASIR</title>
</head>
<body>
    <div class="container">
        <div class="box">
            <div class="title">
                <h1> Selamat Datang! </h1>
            </div>
            <form action="" method="POST">
                <div class="userDiv">
                    <i class="bx bx-user"></i>
                    <input type="text" id="username" placeholder="Username" name="username">
                </div>
                <div class="passDiv">
                    <i class="bx bx-lock"></i>
                    <input type="password" id="password" placeholder="Password" name="password">
                </div>
                <div class="logDiv">
                    <button type="submit" value="LOGIN" name="login"><span>Login</span> <i class="bx bx-log-in"></i></button>
                </div>
            </form>
        </div>
        <!-- <form action="" method="post">
                USERNAME
                <input type="text" name="username" id=""></td>
                PASSWORD
                <input type="password"name="password" id=""></td>
                <input type="submit"value="LOGIN" name="login"></td>
    </form> -->
</div>
</body>
</html>
<?php 
if (isset($_POST['login'])) {
    $user = mysqli_real_escape_string($koneksi,$_POST['username']);
    $pass = $_POST['password'];
    
    $query= mysqli_query($koneksi,"SELECT * FROM petugas WHERE username='$user' AND password='$pass'");
    if(mysqli_num_rows($query) > 0){
        $user = mysqli_fetch_assoc($query);
        header("Location: home.php");
        $_SESSION['status']="berhasil";
        $_SESSION['user']= $user;
    }else{
        echo "<script>alert('username atau password salah')</script>";
    }
}
?>