<?php
/**
 * 管理员登陆
 */


//开启session
session_start();
//引入数据库链接配置文件
include 'config/config.inc.php';


//登陆逻辑
if (isset($_POST['username'])) {
    //判断验证码
    if (@strtoupper($_SESSION['code']) == @strtoupper($_POST['code'])) {

        //查询 输入的账号密码
        $stmt = $pdo->prepare('select * from u_admin where username=? AND password=? ');
        $stmt->execute(array($_POST['username'], sha1($_POST['password'])));

        //如果记录数大于0
        if ($stmt->rowCount() > 0) {

            //将用户信息存到session
            $_SESSION['admin'] = $stmt->fetch(PDO::FETCH_ASSOC);
            //记录登陆状态
            $_SESSION['admin']['isLogin'] = 1;
            //获取用户ip
            $ip = $_SERVER["REMOTE_ADDR"];
            //修改用户登陆ip
            $stmt2 = $pdo->prepare('UPDATE  u_admin SET ip = ? WHERE  id =? ');
            $stmt2->execute(array($ip, $_SESSION['admin']['id']));

            //var_dump($_SESSION);
            //跳转到管理员管理界面
            header("Location:admin/index.php");
        } else {
            echo "<script>alert('请检查账号或者密码')</script>";
        }
    } else {
        echo "<script>alert('请输入正确的验证码')</script>";
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
    <title>会员管理系统----管理入口</title>
</head>
<body style='width: 100%;height: 100%;background: url(/static/img/bg.jpg) no-repeat fixed;background-size: 100% 100%;'>
<style>
    * {
        margin: 0;
        padding: 0;
    }

    .body {
        width: 250px;
        height: 400px;
        margin: 0 auto;
        padding-top: 180px;

    }

    .input {
        border: 1px solid #000;
        margin-top: 35px;
        height: 35px;
        width: 250px;
        line-height: 25px;
    }

    .code {
        border: 1px solid #000;
        margin-top: 35px;
        height: 35px;
        width: 160px;
        line-height: 25px;
        float: left;
    }

    .btn {
        width: 50px;
        height: 35px;
        text-align: center;

    }

</style>

<div class="body">
    <h3 style=" text-align: center;">会员管理系统----管理入口</h3>
    <form action="admin.php" method="post">
        <input class="input" type="text" name="username" placeholder="用户名注意错别字"><br/>
        <input class="input" type="password" name="password" placeholder="密码注意全小写"><br/>
        <input class="code" type="text"
               onkeyup="if(this.value!=this.value.toUpperCase())  this.value=this.value.toUpperCase()"
               name="code" placeholder="验证码" value="">
        <img style="float: right; width: 80px; height: 35px; margin-top: 35px;" src="inclode/code.php"
             onclick="this.src='inclode/code.php?'+Math.random()"/>
        <div style="clear: both;height: 20px;"></div>
        <button class="btn" type="submit">登 录</button>
    </form>
</div>


</body>
</html>


