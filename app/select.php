<?php
$conn = new mysqli('mysql', 'root', 'secret');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->query('USE test');

$count = 0;

echo 'Processing...' . PHP_EOL;

$time_start = microtime(true);

for ($i=0 ; $i < 100000; $i ++) {
    $select = "SELECT * FROM snapshot_verification_result  WHERE rule_id = ".mt_rand(1,50)." AND trigger_id = ".mt_rand(1,50)." AND answer_set_id = ".mt_rand(1,50)." AND answer_source_type_id = " . mt_rand(1, 50);
    $result = $conn->query($select);
    $result = $result->fetch_assoc();
    $count++;
}

$time_end = microtime(true);
$time = $time_end - $time_start;

echo 'Finish. Selected ' . $count . ' rows' . PHP_EOL;
echo 'Time: ' . $time . PHP_EOL;

