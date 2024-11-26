<?php
require_once("pdo-connect.php");
include("../css.php");


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

<!doctype html>
<html lang="en">

<head>
    <title>user-edit</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <?php include("../css.php"); ?>
</head>

<body>
    <div class="modal fade modal-sm" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="confirmModalLabel">你真的要刪除嗎!?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    確認刪除嗎?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                    <a class="btn btn-danger" href="pdo-doDelete.php?id=<?= $row["id"] ?>" title="刪除使用者">確認</a>

                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="py-2">

            <a href="pdo-users.php" class="btn btn-primary" title="回到使用者"><i class="fa-solid fa-left-long" style="font-size: 22px;"></i></a>
        </div>
        <?php if ($stmt->rowCount() > 0) : ?>
            <h1><?= $row["name"] ?></h1>
            <form action="pdo-doUpdateUser.php" method="post">
                <table class="table table-bordered">
                    <input type="hidden" name="id" value="<?= $row["id"] ?>">
                    <tr>
                        <th>ID</th>
                        <td><?= $row["id"] ?></td>
                    </tr>
                    <tr>
                        <th>性別</th>
                        <td><?= $row["gender"] ?></td>
                    </tr>
                    <tr>
                        <th>姓名</th>
                        <td><input type="name" class="form-control" name="name" value="<?= $row["name"] ?>" required></td>
                    </tr>
                    <tr>
                        <th>密碼</th>
                        <td><input type="password" class="form-control" name="password" value="<?= $row["password"] ?>" required></td>
                    </tr>
                    <tr>
                        <th>E-mail</th>
                        <td><input type="email" class="form-control" name="email" value="<?= $row["email"] ?>" required></td>
                    </tr>
                    <tr>
                        <th>電話</th>
                        <td><input type="phone" class="form-control" name="phone" value="<?= $row["phone"] ?>" required></td>
                    </tr>
                    <tr>
                        <th>生日</th>
                       
                        <td><input type="date" class="form-control" name="birthday" value="<?= $row["birthday"] ?>" required>
                    </tr>
                    <tr>
                        <th>地址</th>
                        <td class="d-flex text-align-center"><div class="text-nowrap px-2 pt-2">縣市:</div><input type="address" class="px-2 form-control" name="city" value="<?= $addres_rows["city"] ?>"><div class="text-nowrap px-2 pt-2">區域:</div><input type="address" class="form-control" name="area" value="<?= $addres_rows["area"] ?>"><div class="text-nowrap px-2 pt-2">街巷:</div><input type="address" class="form-control" name="street" value="<?= $addres_rows["street"] ?>"></td>
                    </tr>
                    
                    <tr>
                        <th>創建日期</th>
                        <td><?= $row["created_at"] ?></td>
                    </tr>
                </table>

                <div class="d-flex justify-content-between">

                    <div class="">
                        <button class="btn btn-primary" type="submit">確認</button>
                        <a href="pdo-user.php?id=<?= $row["id"] ?>" class="btn btn-primary" title="回到使用者">取消</a>
                    </div>
                    <div class="">
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal">刪除</button>
                    </div>

                </div>

            </form>
        <?php else: ?>
            <h1>查無此使用者</h1>
        <?php endif; ?>
    </div>



    <script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>

</body>

</html>