<?php
// koneksi ke database
require_once("connection.php");

// ketika dideklarasikan maka akan membaca data pada tabel account
if (isset($_POST['login'])) {
    // Mengambil input langsung dari pengguna tanpa sanitasi
    $username = $_POST['username'];
    $password = $_POST['password'];
    // Query SQL tanpa prepared statements atau sanitasi
    $query = "SELECT * FROM account WHERE username='$username' AND password='$password'";
    $search = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($search);

    if ($user) {
        session_start();
        $_SESSION["user"] = $user;
        header("location: deface.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catatanmu.id</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <header>
        <header class="login-header">
            <p>Tugas Akhir Mata Kuliah Basis Data</p>
        </header>
        <div>
            <section class="login-content">
                <div class="login-content-top">
                    <img src="img/undraw_notes_re_pxhw.svg" width="500px">
                </div>
            </section>
        </div>
        <div class="overlay"></div>
        <form action="login.php" method="POST" class="box">
            <div class="header">
                <h4>Masuk ke Catatanmu.id</h4>
            </div>
            <div class="login-area">
                <input type="text" class="username" name="username" placeholder="Username">
                <input type="password" class="password" name="password" placeholder="Password">
                <input type="submit" name="login" value="Masuk" class="submit">
                <a href="forgetpass.html">Lupa kata sandi?</a>
            </div>
            <div class="arahan-register">
                <p>Belum punya akun?</p>
                <a href="register.php" class="login-daftar">Daftar</a>
            </div>
        </form>
</body>

</html>