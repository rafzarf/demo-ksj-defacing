<?php
// koneksi ke database
require("auth.php");
require("connection.php");

$uname = $_SESSION["user"]["username"];

// variabel username dari auth.php
$user = $_SESSION["user"]["username"];

// ketika dideklarasikan maka akan menambahkan data movies ke tabel non_works
if (isset($_POST['submit_movie'])) { // submit movie ke non_works
    $movie_id = $_POST['movie_id'];
    mysqli_query($conn, "INSERT INTO non_works (username, fk_movie_id) VALUES ('$user', '$movie_id')"); // nambah task
}

// ketika dideklarasikan maka akan menambahkan data staycation ke tabel non_works
if (isset($_POST['submit_staycation'])) { // submit staycation ke non_works
    $staycation_id = $_POST['staycation_id'];
    mysqli_query($conn, "INSERT INTO non_works (username, fk_staycation_id) VALUES ('$user', '$staycation_id')"); // nambah task
}

// variabel untuk membaca data
$result_movies = mysqli_query($conn, "SELECT * FROM movies");
$result_staycation = mysqli_query($conn, "SELECT * FROM staycation");
$result_rl_movies = mysqli_query($conn, "SELECT non_works.fk_movie_id, movies.title FROM non_works INNER JOIN movies ON non_works.fk_movie_id = movies.movie_id");
$result_rl_staycation = mysqli_query($conn, "SELECT non_works.fk_staycation_id, staycation.staycation_place FROM non_works INNER JOIN staycation ON non_works.fk_staycation_id = staycation.staycation_id");

// ketika dideklarasikan maka akan menghapus data movies dari tabel non_works
if (isset($_GET['movie_del'])) {
    $fk_movie_id = $_GET['movie_del'];
    mysqli_query($conn, "DELETE FROM non_works WHERE fk_movie_id=$fk_movie_id"); // delete di db nya
    header('location: rl.php');
}

// ketika dideklarasikan maka akan menghapus data staycation dari tabel non_works
if (isset($_GET['staycation_del'])) {
    $fk_staycation_id = $_GET['staycation_del'];
    mysqli_query($conn, "DELETE FROM non_works WHERE fk_staycation_id=$fk_staycation_id"); // delete di db nya
    header('location: rl.php');
}

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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="dashboard.css" />
    <title>RL <?php echo $_SESSION["user"]["username"] ?></title>
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

    <h1 class="pagemark">Refreshing List</h1>

    <div class="tdlbox">
        <!-- form submit movie -->
        <form action="" method="POST">
            <label for="">Judul Film - Genre - Rating</label><br>
            <select class="rlinput" name="movie_id">
                <option value="">--Pilih Film--</option>
                <?php while ($row = mysqli_fetch_array($result_movies)) { ?>
                    <option value="<?php echo $row['movie_id']; ?>"><?php echo $row['title'] ?> - <?php echo $row['genre'] ?> - <?php echo $row['imdb_rating'] ?></option>
                <?php } ?>
            </select>

            <button class="add" type="submit" name="submit_movie">+</button>
        </form>

        <form class="kanan" action="" method="POST">
            <label for="">Tempat - Provinsi</label><br>
            <select class="rlinput" name="staycation_id">
                <option value="">--Pilih Tempat Staycation--</option>
                <?php while ($row = mysqli_fetch_array($result_staycation)) { ?>
                    <option value="<?php echo $row['staycation_id']; ?>"><?php echo $row['staycation_place'] ?> - <?php echo $row['province_name'] ?></option>
                <?php } ?>
            </select>

            <button class="add" type="submit" name="submit_staycation">+</button>
        </form>
    </div>

    <div class="tbl2">
        <table id="tabel2">
            <thead>
                <tr>
                    <th>N</th>
                    <th>Kegiatan</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php $i = 1;
                while ($row = mysqli_fetch_array($result_rl_movies)) { ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td class="task">Menonton film <?php echo $row['title']; ?></td>
                        <td width="10%">
                            <a href="rl.php?movie_del=<?php echo $row['fk_movie_id'] ?>">
                                <img class="deletebtn" src="img/trash.svg" width="20em" href="rl.php?movie_del=<?php echo $row['fk_movie_id'] ?>">
                            </a>
                        </td>
                    </tr>
                <?php $i++;
                } ?>

                <?php while ($row = mysqli_fetch_array($result_rl_staycation)) { ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td class="task">Pergi ke <?php echo $row['staycation_place']; ?></td>
                        <td width="10%">
                            <a href="rl.php?staycation_del=<?php echo $row['fk_staycation_id'] ?>">
                                <img class="deletebtn" src="img/trash.svg" width="20em" href="rl.php?staycation_del=<?php echo $row['fk_staycation_id'] ?>">
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