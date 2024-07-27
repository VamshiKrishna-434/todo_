<?php
$conn = mysqli_connect('localhost', 'root', '', 'to_do_app');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
