<?php
$conn = new mysqli('mysql', 'root', 'secret');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE DATABASE test";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully" . PHP_EOL;
} else {
    echo "Error creating database: " . $conn->error . PHP_EOL;
}

$conn->query('USE test');

$sql = <<<SQL
CREATE TABLE IF NOT EXISTS `snapshot_verification_result` (
  `rule_id` int(10) unsigned NOT NULL COMMENT 'Rule ID. Primary key part',
  `trigger_id` int(10) unsigned NOT NULL COMMENT 'Trigger ID. Primary key part',
  `answer_set_id` int(10) unsigned NOT NULL COMMENT 'Answer Set ID. Primary key part',
  `answer_source_type_id` int(10) unsigned NOT NULL COMMENT 'Foreign key to snapshot_answer_source_type.',
  `result` tinyint(1) NOT NULL COMMENT 'Verification Result',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date record vas created.(DC2Type:datetime_immutable)',
  `trigger_hash` varchar(32) NOT NULL COMMENT 'Trigger hash',
  `client_id` int(11) unsigned DEFAULT NULL COMMENT 'Client id',
  PRIMARY KEY (`rule_id`,`trigger_id`,`answer_set_id`,`answer_source_type_id`),
  KEY `idx_answer_source_type_id` (`answer_source_type_id`),
  KEY `idx_created_date` (`created_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table for trigger verification results';
SQL;

if ($conn->query($sql) === TRUE) {
    echo "Table created successfully" . PHP_EOL;
} else {
    echo "Error creating table: " . $conn->error . PHP_EOL;
}

