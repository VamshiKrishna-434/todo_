<?php
session_start();
include 'db.php';

$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];

$query = ($role === 'admin') ?
    "SELECT * FROM tasks WHERE created_by = $user_id" :
    "SELECT * FROM tasks WHERE assigned_to = $user_id OR is_personal = 1";

$result = mysqli_query($conn, $query);

$tasks = [];
while ($task = mysqli_fetch_assoc($result)) {
    $tasks[] = $task;
}

echo json_encode($tasks);
