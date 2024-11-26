<?php
$servername = "localhost";
$username = "dogadmin";
$password = "helloworld";
$dbname = "dog_db";

try {
    $db_host = new PDO("mysql:host={$servername};dbname={$dbname};charset=utf8", $username, $password);
} catch (PDOException $e) {
    echo "Error";
    echo $e->getMessage();
    exit;
}
// echo 12;
