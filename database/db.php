<?php
// defining variables
define('HOSTNAME','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','root');
define('DB_NAME', 'phpmysqltest');

//global $con;
$mysqli = new mysqli(HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_NAME) or die ("error");

// Check connection
if($mysqli->connect_errno)	echo "Failed to connect MySQL: " .mysqli_connect_error();

// change character set to utf8
if (!$mysqli->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $mysqli->error);
    exit();
} else {
    printf("Current character set: %s\n", $mysqli->character_set_name());
}
?>
