<?php
$host = "localhost";
$dbname = "queenpac_Track";
$username = "queenpac_queenpac";
$password = "queenpac_queenpac$";

$connection = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
