<!doctype html>
<html lang="en">

<head>
    <title>create_user</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <?php include("../css.php"); ?>
</head>

<body>
    <div class="container">
        <div class="py-2">
            <a href="pdo-users.php" class="btn btn-primary" title="回到使用者列表"><i class="fa-solid fa-left-long"></i></a>
        </div>
        <h1>新增使用者</h1>
        <form action="doCreateUser.php" method="post">
            <div class="mb-2">
                <label for="" class="form-label">帳號</label>
                <input type="text" class="form-control" name="account" required>
            </div>
            <div class="mb-2">
                <label for="" class="form-label">密碼</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <div class="mb-2">
                <label for="" class="form-label">姓名</label>
                <input type="text" class="form-control" name="name" required>
            </div>
            <div class="px-1 mb-2 mt-1">性別</div>
            <div class="d-flex">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault1" value="1">
                    <label class="form-check-label" for="flexRadioDefault1">
                        男性
                    </label>
                </div>
                <div class="px-5 form-check">
                    <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault2" value="2">
                    <label class="form-check-label" for="flexRadioDefault2">
                        女性
                    </label>
                </div>
            </div>
            <div class="mb-2">
                <label for="" class="form-label">email</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="mb-2">
                <label for="" class="form-label">電話</label>
                <input type="tel" class="form-control" name="phone" required>
            </div>
            <div class="mb-2">
                <label for="" class="form-label">生日</label>
                <input type="date" class="form-control" name="birthday" required>
            </div>
            <label class="form-label">地址</label>
            <div class="d-flax justify-content-between pb-2">

                    <div class="text-nowrap px-2 pt-2">縣市:</div><input type="address" class="px-2 form-control" name="city" value="" required>
                    <div class="text-nowrap px-2 pt-2">區域:</div><input type="address" class="form-control" name="area" value="" required>
                    <div class="text-nowrap px-2 pt-2">街巷:</div><input type="address" class="form-control" name="street" value="" required>

            </div>
            <button class="btn btn-info" type="submit">送出</button>
        </form>
    </div>






</body>

</html>