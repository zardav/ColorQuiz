<?php
session_start();
require './sql_connect.php';

$amount = $mysqli->real_escape_string(filter_input(INPUT_GET, 'amount'));
if($amount == "" or $amount > 200) {
    exit("Error");
}


function resultToArray($result) {
    $results_array = array();
    while ($row = $result->fetch_array()) {
        $results_array[] = $row;
    }
    return $results_array;
}


$counter = $mysqli->query("SELECT COUNT(*) AS counter FROM `QuestionsB`");
$count = mysqli_fetch_array($counter)['counter'];

$result = $mysqli->query("SELECT v_value FROM globals WHERE v_name='q2_offset'");
$offset = mysqli_fetch_assoc($result)['v_value'];

if($offset + $amount > $count)
    $offset = 0;
$new_offset = $offset + $amount;
$mysqli->query("UPDATE globals SET v_value='$new_offset' WHERE v_name='q2_offset'");
$result = $mysqli->query("SELECT * FROM `QuestionsB` LIMIT $offset, $amount");
$arr = resultToArray($result);
print json_encode($arr);
