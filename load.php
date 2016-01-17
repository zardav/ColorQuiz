<?php
require './sql_connect.php';
$amount = filter_input(INPUT_GET, 'amount');
$result = $mysqli->query("select qid, color_a, color_b from QuestionsA order by rand() limit $amount");
$arr = array();
while($row = mysqli_fetch_assoc( $result)){
    $arr[] = $row;
}
print json_encode($arr);