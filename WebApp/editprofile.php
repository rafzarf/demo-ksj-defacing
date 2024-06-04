<?php
require_once("auth.php");
require_once("connection.php");

$uname = $_SESSION["user"]["username"];

// Fetch user profile data based on the username
$profile = mysqli_query($conn, "SELECT * FROM profile WHERE username='$uname'");
if (!$profile) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}
$row = mysqli_fetch_assoc($profile);

// Process profile update if form is submitted
if (isset($_POST['update'])) {
    $email = $_POST['email'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $born_date = $_POST['born_date'];
    $phone_number = $_POST['phone_number'];

    // Handle profile image upload
    if ($_FILES['profile_image']['name']) {
        $profile_image = $_FILES['profile_image']['name'];
        $target_dir = "./img/";
        $target_file = $target_dir . basename($profile_image);
        move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file);
    } else {
        $profile_image = $row['profile_image'];
    }

    $update = mysqli_query($conn, "UPDATE profile SET 
        email='$email', 
        first_name='$first_name', 
        last_name='$last_name', 
        born_date='$born_date',
        phone_number='$phone_number',
        profile_image='$profile_image'
        WHERE username='$uname'");

    if ($update) {
        // Redirect to profile page after successful update
        header('Location: profile.php');
        exit();
    } else {
        echo "Failed to update profile.";
    }
}

// Process account deletion if 'delete' parameter is present
if (isset($_GET['delete'])) {
    $delete = $_GET['delete'];
    $deleteAccount = mysqli_query($conn, "DELETE FROM account WHERE username='$delete'");
    if ($deleteAccount) {
        // Redirect to index page after successful account deletion
        header('Location: index.html');
        exit();
    } else {
        echo "Failed to delete account.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="dashboard.css" />
    <title>Profil <?php echo $_SESSION["user"]["username"]; ?> | Catatanmu.id</title>
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

    <h2 class="pagemark2">Ubah Profil</h2>
    <div class="tbl">
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="table-profile">
                <tbody>
                    <tr>
                        <td><label for="">Username</label></td>
                        <td><input type="text" name="username" value="<?php echo $row['username']; ?>" readonly><br></td>
                    </tr>
                    <tr>
                        <td><label for="">Email</label></td>
                        <td><input type="text" name="email" value="<?php echo $row['email']; ?>"><br></td>
                    </tr>
                    <tr>
                        <td><label for="">Nama Depan</label></td>
                        <td><input type="text" name="first_name" value="<?php echo $row['first_name']; ?>"><br></td>
                    </tr>
                    <tr>
                        <td><label for="">Nama Belakang</label></td>
                        <td><input type="text" name="last_name" value="<?php echo $row['last_name']; ?>"><br></td>
                    </tr>
                    <tr>
                        <td><label for="">Tanggal Lahir</label></td>
                        <td><input type="date" name="born_date" value="<?php echo $row['born_date']; ?>"><br></td>
                    </tr>
                    <tr>
                        <td><label for="">Nomor Telepon</label></td>
                        <td><input type="text" name="phone_number" value="<?php echo $row['phone_number']; ?>"><br></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label for="profile_image">Upload Profil Gambar:</label><br>
                            <input type="file" name="profile_image" id="profile_image" accept="image/*"><br>
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Save button for the update form -->
            <div class="buttons">
                <button class="simpan" type="submit" name="update">Simpan</button>
                <a class="simpan" href="profile.php">Kembali</a>
                <a class="delacc" href="editprofile.php?delete=<?php echo $row['username']; ?>">Hapus Akun</a>
            </div>
        </form>
    </div>
</body>

</html>