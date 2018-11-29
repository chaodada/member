<?php
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
 * 编辑数据库配置
 */
if (isset($_POST['btn'])) {
    $username = empty($_POST['username']) ? "" : "&username=" . $_POST['username'] . "";
    $email = empty($_POST['email']) ? "" : "&email=" . $_POST['email'] . "";
    $sex = empty($_POST['sex']) ? "" : "&sex=" . $_POST['sex'] . "";
    header("Location:index.php?action=ser{$username}{$email}{$sex}");


}


?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>查询会员</title>
</head>
<style>
    .inputdiv {
        padding-top: 10px;
    }
</style>

<body style="border: 1px solid #000000">

<?php include 'header.php' ?>
<div style="clear: both; padding: 10px;border-bottom: 1px solid;">
    <p>当前位置: <a href="index.php">订单列表</a>>查询订单</p>
</div>
<div style="padding: 10px">
    <form action="" method="post">
        <div style="width: 400px; height: 450px;padding: 10px; float: left;">
            <div class="inputdiv">
                按照用户名查询：<input type="text" name="username" value=""><br/>
            </div>
            <div class="inputdiv">
                按照邮箱查询：<input type="text" name="email" value=""><br/>
            </div>


            <div class="inputdiv">
                按照用户性别查询：
                <select name="sex">
                    <option value=''>点我选择</option>
                    <option value='0'>女</option>
                    <option value='1'>男</option>
                </select>
            </div>


            <div style=" padding-top: 15px;">
                <input type="submit" name="btn" value="点击查询">
            </div>
        </div>

        <div style="float: left;width: 300px;  text-align: center;">
            <h3>查询须知</h3>
            <p style="text-align:center; ">查询的时候请注意查询条件</p>
            <p style="text-align:center; ">查询的时候请注意查询条件</p>

        </div>

        <div style="clear: both"></div>
    </form>
</div>
</body>
</html>

