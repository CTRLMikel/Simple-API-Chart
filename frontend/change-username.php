<?php
session_start();

if (isset($_SESSION["user_id"])) {
    $mysqli = require __DIR__ . "/database.php";

    $user_id = $_SESSION["user_id"];
    $new_username = $_POST["new_username"];

    $sql = "UPDATE user SET name = '$new_username' WHERE id = $user_id";
    $result = $mysqli->query($sql);

    if ($result) {
        // Username changed successfully
        $_SESSION["name"] = $new_username; // Update session with new username
        header("Location: index.php"); // Redirect to dashboard or profile page
        exit();
    } else {
        // Error handling
        echo "Error: " . $mysqli->error;
    }
} else {
    // Redirect to login page if user is not logged in
    echo "<script>";
    echo "setTimeout(function() {";
    echo "  alert('You need to be logged in to do that!');";
    echo "  window.location.href = 'login.php';";
    echo "}, 2000);"; // Delay of 2 seconds (2000 milliseconds)
    echo "</script>";
    exit();
    exit();
}
?>