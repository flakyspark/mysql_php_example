<?php
$conn = new mysqli('mysql', 'root', 'secret');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->query('USE test');

$count = 0;
echo 'Processing...' . PHP_EOL;

$time_start = microtime(true);

for ($ruleId=1 ; $ruleId < 100; $ruleId ++) {
    for ($triggerId=1 ; $triggerId < 100; $triggerId ++) {
        for ($answerSetId=1 ; $answerSetId < 10; $answerSetId ++) {
            $insert = "INSERT INTO `snapshot_verification_result` (`rule_id`, `trigger_id`, `answer_set_id`, `answer_source_type_id`, `result`, `created_date`, `trigger_hash`, `client_id`) VALUES" .
                "($ruleId, $triggerId, $answerSetId,". mt_rand(1, 50) . "," . mt_rand(0,1) . ",'" .  date("Y-m-d H:i:s") . "','" .  md5(mt_rand()) . "'," . mt_rand(1, 30000) .")";
            $conn->query($insert);
            $count++;
        }
    }
}

$time_end = microtime(true);
$time = $time_end - $time_start;

echo 'Finish. Inserted ' . $count . ' rows' . PHP_EOL;
echo 'Time: ' . $time . PHP_EOL;


