<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    $host = "localhost";
    $user = "root";
    $password = "";
    $db = "quiz_system"; // your database name

    $conn = new mysqli($host, $user, $password, $db);

    if ($conn->connect_errno) {
        throw new Exception("Database connection failed: " . $conn->connect_error);
    }

    $conn->set_charset('utf8mb4');
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    exit;
}
?>
