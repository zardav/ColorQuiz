<?php
session_start();
require './sql_connect.php';
/*
 *
 */
function createColors($seed) {
    $str = md5($seed);
    $color1 = substr($str, 10, 6);
    $color2 = substr($str, 20, 6);
    return array($color1, $color2);
}
/*
 * generate $amount pairs of colors and return array of pairs
 */
function generateColors($seed, $_amount) {
    $arr = array();
    $next = $seed;
    for($i=0; $i < $_amount; $i++) {
        $next = hexdec(substr(md5($next), 0, 8));
        array_push($arr, createColors($next));
    }
    return $arr;
}
$amount = $mysqli->real_escape_string(filter_input(INPUT_GET, 'amount'));
if($amount == "") {
    exit("Error");
}

$result = $mysqli->query("SELECT v_value FROM globals WHERE v_name='seed'");
$seed = mysqli_fetch_assoc($result)['v_value'];
$new_seed = substr(sha1($seed), 0, 8);
$mysqli->query("UPDATE globals SET v_value='$new_seed' WHERE v_name='seed'");
$arr = generateColors($seed, $amount);
print json_encode($arr);