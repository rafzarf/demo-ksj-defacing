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
    <title>Dashboard | Catatanmu.id</title>
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

    <h1 class="greeting">Welcome! <?php echo $_SESSION["user"]["username"] ?></h1>

    <div class="container">
        <div class="row">
            <div class="cardslist">
                <h2>To-do List</h2>
                <img class="illust" src="img/undraw_booked_re_vtod.svg" width="200em" alt="TDL">
                <a class="more" href="tdl.php">More</a>
            </div>

            <div class="cardslist">
                <h2>Wishlist</h2>
                <img class="illust" src="img/undraw_wishlist_re_m7tv.svg" width="210em" alt="WL">
                <a class="more" href="wl.php">More</a>
            </div>

            <div class="cardslist">
                <h2>Refreshing List</h2>
                <img class="illust" src="img/undraw_departing_re_mlq3.svg" width="210em" alt="RL">
                <a class="more" href="rl.php">More</a>
            </div>
        </div>
    </div>
</body>

</html>