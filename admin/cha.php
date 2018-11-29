<?php
/**
 * 查看会员
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
 * 查寻传入的用户数据
 */
if (isset($_GET['action']) && $_GET['action'] == "cha") {
    $stmt = $pdo->prepare('SELECT id,username,password,integral,sex,email,	ip,zc_time FROM u_users where id= ?');
    $stmt->execute(array($_GET['id']));
    if ($stmt->rowCount() > 0) {
        list($id, $username, $password, $integral, $sex, $email, $ip, $zc_time) = $stmt->fetch(PDO::FETCH_NUM);
        //格式化注册时间
        $zc_time = date('Y-m-d', $zc_time);
    } else {
        echo "<script>alert('数据不存在！');window.location.href = 'index.php?page=" . $_GET['page'] . "';</script>";
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
    <title>查看会员</title>
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
    <p>当前位置:---------查看会员</p>
</div>
<div style="padding: 10px">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <div class="inputdiv">
        用 户 名：<input type="text" value="<?php echo $username; ?>"><br/>
        密&nbsp;&nbsp;&nbsp;码：<input type="text" value="<?php echo $password; ?>"><br/>
        邮&nbsp;&nbsp;&nbsp;箱：<input type="text" value="<?php echo $email; ?>"><br/>
        积&nbsp;&nbsp;&nbsp;分：<input type="text" value="<?php echo $integral; ?>"><br/>
        性&nbsp;&nbsp;&nbsp;别：
        <select class="form-control">
            <option <?php if ($sex == 1) { ?> selected="selected" <?php } ?> value="1">男</option>
            <option <?php if ($sex == 0) { ?> selected="selected" <?php } ?> value="0">女</option>
        </select>
        <br/>
        注册时间：<input type="text" name="password" value="<?php echo $zc_time; ?>"><br/>
        登陆ip：<input type="text" name="email" value="<?php echo $ip; ?>"><br/>
    </div>

    <div style=" padding-top: 5px;">
        <input type="button" onclick="window.location.href = 'index.php?page=<?php echo $_GET['page']; ?>'"
               value="返回列表">
    </div>


</div>
</body>
</html>
