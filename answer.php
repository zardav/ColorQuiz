<?php
require './sql_connect.php';
$color_a = $mysqli->real_escape_string(filter_input(INPUT_GET, 'color_a'));
$color_b = $mysqli->real_escape_string(filter_input(INPUT_GET, 'color_b'));
$answer = $mysqli->real_escape_string(filter_input(INPUT_GET, 'answer'));
if($color_a == "" || $answer == "" || $color_b == "") {
    die("Error");
}
session_start();
if(($sid = $mysqli->real_escape_string(session_id())) != '') {
    $session_id = -1;
    $q = $mysqli->query("SELECT * FROM `Sessions` WHERE (`php_session`='$sid')");
    $row = $q->fetch_assoc();
    if(!$row) {
        $mysqli->query("INSERT INTO `Sessions` (`php_session`) VALUES ('$sid')");
        $session_id = $mysqli->insert_id;
    }
    else {
        $session_id = $row['session_id'];
    }
    $mysqli->query("INSERT INTO `AnswersA` (`session_id`, `color_a`, `color_b`, `answer`)
VALUES ('$session_id', '$color_a', '$color_b', $answer)");

}