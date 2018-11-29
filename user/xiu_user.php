<?php
/**
 * 修改用户资料功能实现
 */

/**
 * 开启session
 */
session_start();

/**
 * 开启检查用户是否登陆
 */
if (empty($_SESSION['user']['isUserLogin'])) {
    header("Location:../index.php");
}

/**
 * 引入数据库文件
 */
include '../config/config.inc.php';

/**
 * 查询用户资料
 */
if (isset($_GET['id'])) {
    $sql = "select id,username,password,integral,sex,email from u_users WHERE 1=1 and id={$_GET['id']} ";
    $res = $pdo->query($sql);
    list($id, $username, $password, $integral, $sex, $email) = $res->fetch(PDO::FETCH_NUM);
}

/**
 * 修改用户新资料
 */
if (isset($_POST['btn'])) {
    $stmt = $pdo->prepare('UPDATE u_users SET username=?,password=?,sex=?,email=? WHERE id=?');
    $stmt->execute(array($_POST['username'], $_POST['password'], $_POST['sex'], $_POST['email'], $_POST['id']));
    if ($stmt->rowCount() > 0) {
        echo "<script>alert('修改资料成功！');window.location.href = 'loginout.php';</script>";
    } else {
        echo "<script>alert('修改资料失败')</script>";
    }
}


?>


<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <title>修改资料</title>
    <link href="/static/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>


<div>
    <div class="container">
        <?php include 'header.php'; ?>
        <h1 class="text-center">修改资料</h1>
        <hr/>
        <form method="post" action="xiu_user.php" style="width: 30%;margin-left: 35%;">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label>用户名</label>
                <input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
                <span aria-hidden="true"></span>
            </div>

            <div class="form-group">
                <label>邮箱</label>
                <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
                <span aria-hidden="true"></span>
            </div>


            <div class="form-group">
                <label>密码</label>
                <input type="text" class="form-control" name="password" value="<?php echo $password; ?>">
                <span aria-hidden="true"></span>
            </div>

            <div class="form-group">
                <label>性别</label>
                <select class="form-control" name="sex">
                    <option <?php if ($sex == 1) { ?> selected="selected" <?php } ?> value="1">男</option>
                    <option <?php if ($sex == 0) { ?> selected="selected" <?php } ?> value="0">女</option>
                </select>
            </div>
            <button type="submit" name="btn" class="btn btn-success">确认修改</button>
            <a href="index.php" class="btn">返回</a>
        </form>
    </div>
</div>


</body>
</html>
