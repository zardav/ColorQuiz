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
    $q = $mysqli->query("SELECT * FROM `Sessions` WHERE (`php_session`='$sid')");
    if(!mysqli_fetch_row($q)) {
        die("Error");
    }
    $mysqli->query("UPDATE `AnswersA`  SET `answer`=$answer
WHERE `session_id`='$sid' AND `color_a`='$color_a' AND `color_b`='$color_b'");

}