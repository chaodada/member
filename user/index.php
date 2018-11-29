<?php

/**
 * 用户主页功能实现
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
    <title>会员管理系统</title>
    <link href="/static/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="container" style="min-height:450px;">
    <?php include 'header.php'; ?>
    <div class="row">
        <div class="col-sm-9" align="center">
            <div class="panel panel-default" style="border-radius: 0">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12" style="text-align: center">
                            <img src="/static/img/noavatar_middle.gif"
                                 style="margin-left:auto;margin-right:auto;border-radius:70px;border:5px solid #1abc9c;">
                            <div style="margin: 30px 0 20px 0;">
                                <span class="h3"><?php echo $username; ?></span>
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-7">
                            <form class="form-horizontal" style="background: none">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">用户名</label>
                                    <div class="col-sm-7">
                                        <input class="form-control" value="<?php echo $username; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">邮&nbsp;&nbsp;&nbsp;箱</label>
                                    <div class="col-sm-7">
                                        <input class="form-control" value="<?php echo $email; ?>">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'right.php'; ?>
    </div>
</div>
</body>
</html>