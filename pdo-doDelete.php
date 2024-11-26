<?php

require_once("pdo-connect.php");

$id = $_GET["id"];

$sql = "UPDATE users SET is_deleted=1 WHERE id=?";
$stmt = $db_host->prepare($sql);
try {
    $stmt->execute([$id]);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "預處理陳述式執行失敗！ <br/>";
    echo "Error: " . $e->getMessage() . "<br/>";
    $db_host = NULL;
    exit;
}


$db_host= NULL;

header("location: pdo-users.php");