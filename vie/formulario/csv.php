<?php
$csv = [];
$csv[0] = ["agustin", "Christian Agustin", "abc123"];
$csv[1] = ["kenneth", "Kenneth Agustin", "abcdef"];
$csv[2] = ["angel", "Angel Agustin", "123456"];

header('Content-Type: text/csv');
header("Content-disposition: attachment; filename=\"archivo.csv\"");

$outputBuffer = fopen("php://output", 'w');
foreach ($csv as $val) {
    fputcsv($outputBuffer, $val);
}

fclose($outputBuffer);
?>
