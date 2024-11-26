<?php
require_once("pdo-connect.php");

if (!isset($_POST["id"])) {
    die("請正常進入");
}
$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$birthday = $_POST['birthday'];
$password = md5($password);

$city = $_POST['city'];
$area = $_POST['area'];
$street = $_POST['street'];

$sql = "UPDATE users 
SET name = :name, 
    email = :email, 
    phone = :phone, 
    birthday = :birthday
WHERE id = :id";

$sql_address = "UPDATE addres 
SET city = :city, 
    area = :area, 
    street = :street
WHERE user_id = :id";
try {
    $stmt = $db_host->prepare($sql);
    $stmt->execute([
        ":id" => $id,
        ":name" => $name,
        ":email" => $email,
        ":phone" => $phone,
        ":birthday" => $birthday
    ]);
    $stmt_address = $db_host->prepare($sql_address);
    $stmt_address->execute([
        ":id" => $id,
        ":city" => $city,
        ":area" => $area,
        ":street" => $street
    ]);

    echo "更新成功！";
} catch (PDOException $e) {
    echo "預處理陳述式執行失敗！ <br/>";
    echo "Error: " . $e->getMessage() . "<br/>";
    $db_host = NULL;
    exit;
}
header("location: pdo-user-edit.php?id=$id");
