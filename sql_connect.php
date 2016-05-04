<?php
require 'config.php';

// Create connection
$mysqli = new mysqli($mysql_servername, $mysql_username, $mysql_password);
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
} 
$mysqli->select_db($mysql_db_name);