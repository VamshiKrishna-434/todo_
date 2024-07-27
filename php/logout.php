<?php
session_start();
include 'db.php';

$user_id = $_SESSION['user_id'];
$update_status = "UPDATE users SET online_status = FALSE WHERE id = $user_id";
mysqli_query($conn, $update_status);

session_unset();
session_destroy();

echo "Logged out successfully";
