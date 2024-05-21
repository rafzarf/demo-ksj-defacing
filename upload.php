<?php
session_start();


$uname = $_SESSION["user"]["username"];

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["profile_image"])) {
    $file = $_FILES["profile_image"];

    // File upload path
    $targetDir = "./img/";
    $fileName = basename($file["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Allow certain file formats
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
    if (in_array($fileType, $allowTypes)) {
        // Upload file to server
        if (move_uploaded_file($file["tmp_name"], $targetFilePath)) {
            // Update profile picture path in database
            $updateQuery = "UPDATE profile SET profile_image = '$targetFilePath' WHERE username = '$uname'";
            if (mysqli_query($conn, $updateQuery)) {
                // Profile picture updated successfully
                header("Location: profile.php"); // Redirect back to profile page
                exit();
            } else {
                echo "Failed to update profile picture.";
            }
        } else {
            echo "Error uploading file.";
        }
    } else {
        echo "Only JPG, JPEG, PNG, GIF files are allowed.";
    }
}
