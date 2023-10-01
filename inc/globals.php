<?php

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$logged_in_user = null;
if (isset($_SESSION['user'])) {
    $logged_in_user = $_SESSION['user'];
}
?>