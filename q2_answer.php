<?php
require './sql_connect.php';
$qid = $mysqli->real_escape_string(filter_input(INPUT_GET, 'qid'));
$answer = $mysqli->real_escape_string(filter_input(INPUT_GET, 'answer'));
if($qid == "" || $answer == "") {
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
    $mysqli->query("INSERT INTO `AnswersB` (`session_id`, `qid`, `answer`)
VALUES ('$session_id', '$qid', $answer)");

}
