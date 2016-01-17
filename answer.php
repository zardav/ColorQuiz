<?php
require './sql_connect.php';
$qid = $mysqli->real_escape_string(filter_input(INPUT_GET, 'qid'));
$answer = $mysqli->real_escape_string(filter_input(INPUT_GET, 'answer'));
session_start();
if(($sid = $mysqli->real_escape_string(session_id())) != '') {
    $q = $mysqli->query("SELECT * FROM `Sessions` WHERE (`php_session`='$sid')");
    print $mysqli->error;
    if(!mysqli_fetch_row($q)) {
        $mysqli->query("INSERT INTO `Sessions` (`php_session`) VALUES ('$sid')");
    }
    print $mysqli->error;
    $mysqli->query("INSERT INTO `AnswersA` (`session_id`, `qid`, `answer`) VALUES ('$sid', $qid, $answer)");
    print $mysqli->error;
}