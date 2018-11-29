<?php
/**
 * 修改会员
 */

/**
 * 开启session
 */
session_start();

/**
 * 开启判断是否登陆
 */
if (empty($_SESSION['admin']['isLogin'])) {
    header("Location:../admin.php");
}

/**
 * 包含数据库配置
 */
include '../config/config.inc.php';


/**
 * 根据传入的id 查询出将要修改的用户信息
 */
if (isset($_GET['action']) && $_GET['action'] == "xiu") {
    $stmt = $pdo->prepare('SELECT id,username,password,integral,sex,email FROM u_users where id= ?');
    $stmt->execute(array($_GET['id']));
    if ($stmt->rowCount() > 0) {
        list($id, $username, $password, $integral, $sex, $email) = $stmt->fetch(PDO::FETCH_NUM);
    } else {
        echo "<script>alert('数据不存在！');window.location.href = 'index.php';</script>";
    }
}


/**
 * 用户修改操作
 */
if (isset($_POST['btn'])) {
    $stmt = $pdo->prepare('UPDATE u_users SET username= ? ,password= ? ,integral= ? , sex=?, email=? WHERE id=?');
    $stmt->execute(array($_POST['username'], $_POST['password'], $_POST['integral'], $_POST['sex'], $_POST['email'], $_POST['id']));
    if ($stmt->rowCount() > 0) {
        echo "<script>alert('修改会员成功');window.location.href = 'index.php?page=" . $_GET['page'] . "';</script>";
    } else {
        echo "<script>alert('修改会员失败')</script>";
    }
}


?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>修改会员</title>
</head>
<style>
    .inputdiv {
        padding-top: 10px;
    }

    input {
        width: 200px;
        margin-top: 5px;
    }

    select {
        margin-top: 5px;
    }
</style>

<body style="border: 1px solid #000000">

<?php include 'header.php' ?>
<div style="clear: both; padding: 10px;border-bottom: 1px solid;">
    <p>当前位置:---------修改会员</p>
</div>
<div style="padding: 10px">
    <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="inputdiv">
            用户名：<input type="text" name="username" value="<?php echo $username; ?>"><br/>
            密&nbsp;&nbsp;&nbsp;码：<input type="text" name="password" value="<?php echo $password; ?>"><br/>
            邮&nbsp;&nbsp;&nbsp;箱：<input type="text" name="email" value="<?php echo $email; ?>"><br/>
            积&nbsp;&nbsp;&nbsp;分：<input type="text" name="integral" value="<?php echo $integral; ?>"><br/>
            性&nbsp;&nbsp;&nbsp;别：
            <select class="form-control" name="sex">
                <option <?php if ($sex == 1) { ?> selected="selected" <?php } ?> value="1">男</option>
                <option <?php if ($sex == 0) { ?> selected="selected" <?php } ?> value="0">女</option>
            </select>
        </div>
        <div style=" padding-top: 5px;"><input type="submit" name="btn" value="确定修改"></div>
    </form>
</div>
</body>
</html>
