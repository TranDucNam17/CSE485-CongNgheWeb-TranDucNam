<?php
// Kết nối tới MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users"; //

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
