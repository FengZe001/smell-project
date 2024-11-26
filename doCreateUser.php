<?php
require_once("pdo-connect.php");

if (!isset($_POST["account"])) {
    die("請正常進入");
}
$name = $_POST['name'];
$account = $_POST["account"];
$email = $_POST['email'];
$password = $_POST["password"];
$phone = $_POST['phone'];
$gender = $_POST['gender'];
$birthday = $_POST['birthday'];
$now = date('Y-m-d H:i:s');
$password = md5($password);

$city = $_POST['city'];
$area = $_POST['area'];
$street = $_POST['street'];

$sql = "INSERT INTO users (name, account, email, password, phone, gender_id, birthday, created_at, is_deleted) 
        VALUES (:name, :account, :email, :password, :phone, :gender, :birthday, :created_at, 0)";
$stmt = $db_host->prepare($sql);

$addres_sql = "INSERT INTO addres (city, area, street, user_id) VALUES (:city, :area, :street, LAST_INSERT_ID())";
$addres_stmt = $db_host->prepare($addres_sql);
try {
    $stmt->execute([
        ":name" => $name,
        ":account" => $account,
        ":email" => $email,
        ":password" => $password,
        ":phone" => $phone,
        ":gender" => $gender,
        ":birthday" => $birthday,
        ":created_at" => $now,
    ]);

    $addres_stmt->execute([
        ":city" => $city,
        ":area" => $area,
        ":street" => $street,
    ]);

    echo "成功";
} catch (PDOException $e) {
    echo "預處理陳述式執行失敗！ <br/>";
    echo "Error: " . $e->getMessage() . "<br/>";
    $db_host = NULL;
    exit;
}

header("Location:/smell-project/pdo-users.php");
