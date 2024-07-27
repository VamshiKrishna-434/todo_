<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        echo "Prepare failed: (" . $conn->errorCode() . ") " . $conn->errorInfo();
    }
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errorCode() . ") " . $stmt->errorInfo();
    }

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        if (password_verify($password, $result['password'])) {
            session_start();
            $_SESSION['user_id'] = $result['id'];
            echo "Login successful";
        } else {
            echo "Invalid password";
        }
    } else {
        echo "User not found";
    }
}
$conn = null;
