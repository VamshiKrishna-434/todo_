<?php
include 'db.php';

$task_id = $_POST['task_id'];
$progress = $_POST['progress'];

$query = "UPDATE tasks SET progress = $progress WHERE id = $task_id";
mysqli_query($conn, $query);
