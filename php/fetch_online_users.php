<?php
include 'db.php';

$query = "SELECT email FROM users WHERE online_status = TRUE";
$result = mysqli_query($conn, $query);

$users = [];
while ($user = mysqli_fetch_assoc($result)) {
    $users[] = $user;
}

echo json_encode($users);
