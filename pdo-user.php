<?php
require_once("pdo-connect.php");

if (!isset($_GET['id'])) {
    echo "ERROR";
    exit;
}
$id = $_GET['id'];
$sql = "SELECT users.*,gender.gender as gender FROM users join gender on users.gender_id = gender.id WHERE users.is_deleted = 0 and users.id =?";
$addres_sql = "SELECT addres.* FROM addres join users on addres.user_id = users.id WHERE user_id = ?" ;
$stmt = $db_host->prepare($sql);
$addres_stmt = $db_host->prepare($addres_sql);
try {
    $stmt->execute([$id]);
    $addres_stmt->execute([$id]);
    $row = $stmt->fetch();
    $addres_rows = $addres_stmt->fetch();
} catch (PDOException $e) {
    echo "Error";
    echo $e->getMessage();
    $db_host = null;
    exit;
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user</title>
    <?php include("../css.php"); ?>
</head>

<body>
    <div class="container">
        
        <div class="py-2">
            <a href="pdo-users.php" class="btn btn-primary" title="回到使用者列表"><i class="fa-solid fa-lg fa-left-long"></i></a>
        </div>
        <?php if ($stmt->rowCount() > 0) : ?>
            <h1><?= $row["name"] ?></h1>
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <td><?= $row["id"] ?></td>
                </tr>
                <tr>
                    <th>性別</th>
                    <td><?= $row["gender"] ?></td>
                </tr>
                <tr>
                    <th>E-mail</th>
                    <td><?= $row["email"] ?></td>
                </tr>
                <tr>
                    <th>電話</th>
                    <td><?= $row["phone"] ?></td>
                </tr>
                <tr>
                    <th>生日</th>
                    <td><?= $row["birthday"] ?></td>
                </tr>
                <tr>
                    <th>地址</th>
                    <td><?= $addres_rows["city"],$addres_rows["area"],$addres_rows["street"]?></td>
                </tr>
                <tr>
                    <th>創建時間</th>
                    <td><?= $row["created_at"] ?></td>
                </tr>
            </table>
            <a href="pdo-user-edit.php?id=<?= $row["id"] ?>" class="btn btn-primary"><i class="fa-regular fa-fw fa-pen-to-square"></i></a>
            <hr>
        <?php else: ?>
            <h1>查無此使用者</h1>
        <?php endif; ?>
    </div>


</body>

</html>