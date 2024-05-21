<?php
// koneksi ke database
require_once("connection.php");

// ketika dideklarasikan maka akan menambahkan data pada tabel account dan profile
if (isset($_POST['register'])) {
    $username = $_POST['username']; // No sanitization
    $password = $_POST["password"]; // No hashing
    mysqli_query($conn, "INSERT INTO account (username, password) VALUES ('$username', '$password')");
    mysqli_query($conn, "INSERT INTO profile (username) VALUES ('$username')");

    header("location: login.php");
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
        <form action="" method="POST" class="box">
            <div class="header">
                <h4>Daftar ke Catatanmu.id</h4>
            </div>
            <div class="login-area">
                <input type="text" class="username" name="username" placeholder="Username">
                <input type="password" class="password" name="password" placeholder="Password">
                <input type="submit" value="Daftar" name="register" class="submit">
            </div>
            <div class="arahan-register">
                <p>Sudah punya akun?</p>
                <a href="Login.php" class="login-daftar">Masuk</a>
            </div>
        </form>
</body>

</html>