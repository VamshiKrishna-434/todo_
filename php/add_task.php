<?php
include 'db.php';

$title = $_POST['title'];
$description = $_POST['description'];
$due_date = $_POST['due_date'];
$due_time = $_POST['due_time'];
$priority = $_POST['priority'];
$is_personal = $_POST['personal'];
$assigned_to = $_POST['assigned_to'];
$created_by = $_SESSION['user_id'];

$query = "INSERT INTO tasks (title, description, due_date, due_time, priority, assigned_to, is_personal, created_by)
          VALUES ('$title', '$description', '$due_date', '$due_time', '$priority', '$assigned_to', '$is_personal', '$created_by')";
mysqli_query($conn, $query);

// Notify the assigned user via email/SMS
$user_query = "SELECT email, mobile FROM users WHERE id = $assigned_to";
$user_result = mysqli_query($conn, $user_query);
$user = mysqli_fetch_assoc($user_result);

$email = $user['email'];
$mobile = $user['mobile'];
$subject = "New Task Assigned";
$message = "Task Title: $title\nDue Date: $due_date\nDue Time: $due_time\nPlease login to check the details.";
mail($email, $subject, $message);

// Use a service like Twilio to send SMS
