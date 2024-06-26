<?php
session_start();

if (isset($_SESSION["user_id"])) {
    $mysqli = require __DIR__ . "/database.php";

    $user_id = $_SESSION["user_id"];

    $sql = "DELETE FROM user WHERE id = $user_id";
    $result = $mysqli->query($sql);

    if ($result) {
        // User deleted successfully, log out the user
        session_unset();
        session_destroy();
        header("Location: account-deleted.html"); // Redirect to login page after deletion
        exit();
    } else {
        // Error occurred while deleting user
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
}
?>
