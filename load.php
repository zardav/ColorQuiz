<?php
session_start();
require './sql_connect.php';
$amount = $mysqli->real_escape_string(filter_input(INPUT_GET, 'amount'));
$offset = $_SESSION['offset'];
if ($offset == "") {
    $offset = 0;
}
if($amount == "") {
    exit("Error");
}
$_SESSION['offset'] = $amount + $offset;
$session_random = $_SESSION['random'];
if(isset($session_random)) {
    $session_random = intval($session_random);
} else {
    srand(time());
    $session_random = rand(1, 100000);
    $_SESSION['random'] = $session_random;
}

$result = $mysqli->query("select qid, color_a, color_b from QuestionsA order by rand(qid*$session_random) limit $amount offset $offset");
if(!$result) {
    session_destroy();
    pcntl_exec($_, $argv);
}
$arr = array();
while($row = mysqli_fetch_assoc($result)){
    $arr[] = $row;
}
print json_encode($arr);