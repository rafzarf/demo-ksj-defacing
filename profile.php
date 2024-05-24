<?php
// Menghubungkan dengan database
require_once("auth.php");
require_once("connection.php");

// Variabel username dari auth.php
$uname = $_SESSION["user"]["username"];

// Variabel untuk membaca data
$profile = mysqli_query($conn, "SELECT * FROM profile WHERE username='$uname'");
if (!$profile) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}

$row = mysqli_fetch_assoc($profile);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="dashboard.css" />
    <title>Profil <?php echo $_SESSION["user"]["username"] ?> | Catatanmu.id</title>
</head>

<body>
    <nav>
        <h1 class="catatanmu">Catatanmu.id</h1>
        <ul class="nav_links">
            <li><a class="db_ref" href="dashboard.php">Dashboard</a></li>
            <li>
                <a class="userlogo" href="profile.php">
                    <?php if (isset($row['profile_image'])) : ?>
                        <img class="profilelogo" src="<?php echo 'img/' . $row['profile_image']; ?>" width="50em" height="50em" style="border-radius: 50%;">
                    <?php else : ?>
                        <img class="profilelogo" src="img/Avatar.svg" width="50em" style="border-radius: 50%;">
                    <?php endif; ?>
                </a>
            </li>
        </ul>
    </nav>

    <h2 class="pagemark2">Profile</h2>

    <div class="tbl">
        <table id="tabel">
            <tbody>
                <tr>
                    <td>Username</td>
                    <td><?php echo $_SESSION["user"]["username"] ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?php echo $row['email']; ?></td>
                </tr>
                <tr>
                    <td>Nama Depan</td>
                    <td><?php echo $row['first_name']; ?></td>
                </tr>
                <tr>
                    <td>Nama Belakang</td>
                    <td><?php echo $row['last_name']; ?></td>
                </tr>
                <tr>
                    <td>Tanggal Lahir</td>
                    <td><?php echo $row['born_date']; ?></td>
                </tr>
                <tr>
                    <td>Nomor Telepon</td>
                    <td><?php echo $row['phone_number']; ?></td>
                </tr>
            </tbody>
        </table>

        <a class="simpan" href="editprofile.php?username=<?php echo $_SESSION["user"]["username"]; ?>">Edit</a>
        <a class="logoutbtn" href="logout.php">Logout</a>
    </div>

</body>

</html>