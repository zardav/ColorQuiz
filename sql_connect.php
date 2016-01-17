<?php
require 'config.php';

// Create connection
$mysqli = new mysqli($servername, $username, $password);
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
} 
$mysqli->select_db($db_name);