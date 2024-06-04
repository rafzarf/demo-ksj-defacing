<?php
// koneksi ke database
require("auth.php");
require("connection.php");

$errors = ""; //declare variabel eror

$uname = $_SESSION["user"]["username"];

// ketika dideklarasikan maka akan menambahkan data pada tabel works
if (isset($_POST['wl_submit'])) { // biar submit buttonnya work
    $wl_task = $_POST['wl_task'];
    if (empty($wl_task)) {
        $errors = "Impian tidak boleh kosong"; // kalo kosong bakal eror
    } else {
        $user = $_SESSION["user"]["username"];
        mysqli_query($conn, "INSERT INTO works (username, wish_list_content) VALUES ('$user', '$wl_task')"); // nambah task
    }
}

// ketika dideklarasikan maka akan menghapus data pada tabel works
if (isset($_GET['wl_task_del'])) {
    $works_id = $_GET['wl_task_del'];
    mysqli_query($conn, "DELETE FROM works WHERE works_id=$works_id"); // delete di db nya
    header('location: wl.php');
}

// Variabel untuk membaca data
$profile = mysqli_query($conn, "SELECT * FROM profile WHERE username='$uname'");
if (!$profile) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}

$row = mysqli_fetch_assoc($profile);

// variabel untuk membaca data
$wl_tasks = mysqli_query($conn, "SELECT * FROM works WHERE wish_list_content IS NOT NULL");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="dashboard.css" />
    <title>Wishlist <?php echo $_SESSION["user"]["username"] ?></title>
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

    <h1 class="pagemark">Wishlist</h1>

    <form class="tdlbox" action="" method="POST">
        <input class="tdlinput" type="text" name="wl_task" placeholder="Tambahkan impianmu">
        <button class="add" type="submit" name="wl_submit">+</button>
    </form>

    <div class="error">
        <?php if (isset($errors)) { ?>
            <p><?php echo $errors; ?></p>
        <?php } ?>
    </div>

    <div class="tbl">
        <table id="tabel">
            <thead>
                <tr>
                    <th>N</th>
                    <th>Task</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>

            <tbody>
                <?php $i = 1;
                while ($row = mysqli_fetch_array($wl_tasks)) { ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td class="task"><?php echo $row['wish_list_content']; ?></td>
                        <td width="10%">
                            <a href="wledit.php?works_id=<?php echo $row['works_id'] ?>">
                                <img class="editbtn" src="img/edit.svg" width="20em" href="wledit.php?works_id=<?php echo $row['works_id'] ?>">
                            </a>
                        </td>
                        <td width="10%">
                            <a href="wl.php?wl_task_del=<?php echo $row['works_id'] ?>">
                                <img class="deletebtn" src="img/trash.svg" width="20em" href="wl.php?wl_task_del=<?php echo $row['works_id'] ?>">
                            </a>
                        </td>
                    </tr>

                <?php $i++;
                } ?>
            </tbody>
        </table>
    </div>
</body>

</html>