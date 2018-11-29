<?php
/**
 * 用户注册文件
 * 主要就是让用户输入资料进行注册
 * 可以增加表单验证 或者修改处理逻辑   比如注册发送邮件等
 */


//引入数据库链接配置文件
include 'config/config.inc.php';


//注册逻辑
if (isset($_POST['username'])) {
    //查询 输入的账号密码
    $stmt = $pdo->prepare('select * from u_users where username=?  ');
    $stmt->execute(array($_POST['username']));
    //如果用户名不存在  进行注册
    if (($stmt->rowCount() == 0)) {
        $time = time();
        $stmt = $pdo->prepare('INSERT INTO u_users (username,password, sex,email,zc_time) VALUES (?,?,?,?,?)');
        $stmt->execute(array($_POST['username'], $_POST['password'], $_POST['sex'], $_POST['email'], $time));
        if ($stmt->rowCount() > 0) {
            echo "<script>alert('注册成功');window.location.href = 'index.php';</script>";
        } else {
            echo "<script>alert('注册失败')</script>";
        }
    } else {
        echo "<script>alert('账号已经存在')</script>";
    }

}
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit"><!--告诉360用极速模式-->
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title>会员管理系统----用户注册</title>
    <link href="/static/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div>
    <div class="container">
        <h1 class="text-center">用户注册</h1>
        <h3 class="text-center">请将以下参数填写完整</h3>
        <hr/>
        <form method="post" action="zhuce.php" style="width: 30%;margin-left: 35%;">
            <div class="form-group">
                <label>用户名</label>
                <input type="text" class="form-control" name="username" placeholder="用户名">
                <span aria-hidden="true"></span>
            </div>
            <div class="form-group">
                <label>邮箱</label>
                <input type="text" class="form-control" name="email" placeholder="邮箱">
                <span aria-hidden="true"></span>
            </div>
            <div class="form-group">
                <label>密码</label>
                <input type="password" class="form-control" name="password" placeholder="密码">
                <span aria-hidden="true"></span>
            </div>
            <div class="form-group">
                <label>性别</label>
                <label><input name="sex" checked="checked" type="radio" value="1"/>男 </label>
                <label><input name="sex" type="radio" value="0"/>女 </label>
            </div>
            <button type="submit" id="submit" class="btn btn-success">注册</button>
        </form>
    </div>
</div>
</body>
</html>


