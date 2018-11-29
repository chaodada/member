<?php
/**
 * 用户登陆
 */
//开启session
session_start();
//引入数据库链接配置文件
include 'config/config.inc.php';

//登陆逻辑
if (isset($_POST['username'])) {
    //查询 输入的账号密码
    $stmt = $pdo->prepare('select * from u_users where username=? AND password=? ');
    $stmt->execute(array($_POST['username'], $_POST['password']));

    //如果记录数大于0
    if ($stmt->rowCount() > 0) {

        //将用户信息存到session
        $_SESSION['user'] = $stmt->fetch(PDO::FETCH_ASSOC);
        //记录登陆状态
        $_SESSION['user']['isUserLogin'] = 1;
        //获取用户ip
        $ip = $_SERVER["REMOTE_ADDR"];
        //修改用户登陆ip
        $stmt2 = $pdo->prepare('UPDATE  u_users SET ip = ? WHERE  id =? ');
        $stmt2->execute(array($ip, $_SESSION['user']['id']));

        //var_dump($_SESSION);
        //跳转到管理员管理界面
        header("Location:user/index.php");
    } else {
        echo "<script>alert('请检查账号或者密码')</script>";
    }

}
?>


<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title>会员管理系统----用户入口</title>
    <link href="/static/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>


<div>
    <div class="container">
        <h1 class="text-center">用户登陆</h1>
        <hr/>
        <form method="post" action="index.php" style="width: 30%;margin-left: 35%;">
            <div class="form-group">
                <label>用户名</label>
                <input type="text" class="form-control" name="username" placeholder="用户名">
                <span aria-hidden="true"></span>
            </div>

            <div class="form-group">
                <label>密码</label>
                <input type="password" class="form-control" name="password" placeholder="密码">
                <span aria-hidden="true"></span>
            </div>
            <button type="submit" id="submit" class="btn btn-success">登录</button>
            <p>还没有账号？<a href="zhuce.php">点我注册</a></p>
        </form>
    </div>
</div>


</body>
</html>


