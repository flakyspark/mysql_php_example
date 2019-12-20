<?php
$conn = new mysqli('mysql', 'root', 'secret');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->query('USE test');
$conn->query('DROP TABLE snapshot_verification_result');

echo 'Table dropped' . PHP_EOL;
