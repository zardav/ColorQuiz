<?php
$directory = "../style";

require "scss/scss.inc.php";
scss_server::serveFrom($directory);