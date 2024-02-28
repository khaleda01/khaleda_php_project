<?php
$host = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "php_project";

$con = new mysqli($host, $dbuser, $dbpass, $dbname);
if ($con->connect_error) {
    die("");
}
?>