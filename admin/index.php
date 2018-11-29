<?php
/**
 * 会员管理
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
 * 定义空查询语句
 */
$code = '';


/**
 * 接受查询条件参参数  无条件 则忽略
 */
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'ser') {
        $code = empty($_GET['username']) ? "" : "  and username='{$_GET['username']}'";
        $code .= empty($_GET['email']) ? "" : "  and email='{$_GET['email']}'";
        $code .= empty($_GET['sex']) ? "" : "  and sex='{$_GET['sex']}'";
    }
}


/**
 * 删除操作
 */
if (isset($_GET['action'])) {
    if ($_GET['action'] == "del") {

        if (!empty($_POST['id'])) {
            //多选删除
            $sql = "delete from u_users where id in (" . implode(',', $_POST['id']) . ") ";
            $row = $pdo->exec($sql);
            if ($row && $row > 0) {
                $sql = "delete from u_crows where uid in (" . implode(',', $_POST['id']) . ") ";
                $row = $pdo->exec($sql);
                echo "<script>alert('删除数据成功');window.location.href = 'index.php';</script>";
            } else {
                echo "<script>alert('删除数据失败');window.location.href = 'index.php';</script>";
            }
        } elseif (empty($_POST['id']) && !empty($_GET['id'])) {
            //单个删除
            $sql = "delete from u_users where id='{$_GET['id']}' ";
            $row = $pdo->exec($sql);
            if ($row && $row > 0) {
                $sql = "delete from u_crows where uid='{$_GET['id']}' ";
                $row = $pdo->exec($sql);
                echo "<script>alert('删除数据成功');window.location.href = 'index.php?page=" . $_GET['page'] . "';</script>";
            } else {
                echo "<script>alert('删除数据失败');window.location.href = 'index.php?page=" . $_GET['page'] . "';</script>";
            }
        } else {
            echo "<script>alert('系统判定误操作');window.location.href = 'index.php?page=" . $_GET['page'] . "';</script>";
        }

    }
}

/**
 * 查询会员总数
 */
$sqll = "select * from u_users WHERE 1=1 {$code}";
$zong = $pdo->query($sqll)->rowCount();


/**
 * 定义每页显示多少条
 */
$num = 5;


/**
 * 引入完美分页类
 */
include "../inclode/page.class.php";

/**
 * 构建分页对象
 */
$page = new Page($zong, $num);

/**
 *查询数据
 */
$sql = "select 	id,username,integral,zc_time,sex from u_users WHERE 1=1 $code ORDER BY id DESC {$page->limit} ";

/**
 *获取数据
 */
$res = $pdo->query($sql);
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>会员管理</title>
</head>
<body style="border: 1px solid #000000">

<style>
    .am-fr {
        float: right;
        margin-right: 40px;
    }

    .am-fr ul {
        text-align: right;
        padding: 0;
        margin: 0;

    }

    .am-fr ul li {
        list-style: none;
        float: left;
        line-height: 25px;
        padding: 0 5px;

    }

    .am-fr ul .am-active a {
        color: red;
    }
</style>

<?php include 'header.php' ?>
<div style="clear: both; padding: 10px;">
    <p>当前位置:---------会员管理</p>
</div>
<div class="body">

    <form action="?action=del&page=<?php echo $page->page; ?>" method="post">
        <table style="text-align: center;width: 100%;" border="1">

            <tr>
                <th>选择</th>
                <th>用户名</th>
                <th>注册时间</th>
                <th>积分</th>
                <th>性别</th>
                <th>操作</th>
            </tr>


            <?php
            while (list($id, $username, $integral, $zc_time, $sex) = $res->fetch(PDO::FETCH_NUM)) {
                $sex = ($sex == 0) ? '女' : '男';

                $zc_time = date('Y-m-d', $zc_time);
                echo '<tr>';
                echo "<td><input type = 'checkbox' name = 'id[]' value = '$id' ></td >";
                echo "<td>$username </td >";
                echo "<td>$zc_time</td >";
                echo "<td>$integral</td >";
                echo "<td>$sex</td >";
                echo "<td> ";
                echo "<a href='xiu.php?action=xiu&id=$id&page=$page->page'> 修改</a>---";
                echo "<a href='cha.php?action=cha&id=$id&page=$page->page'>查看</a>---";
                echo "<a onclick='return confirm(\"确认删除这条数据吗？\")' href='index.php?action=del&id=$id&page=$page->page'>删除</a>";
                echo "</td >";
                echo "</tr>";
            }
            ?>


            <tr>
                <td><input onclick='return confirm("确认删除这些数据吗？")' type='submit' name='dosubmit' value='删除 '></td>
                <td colspan='17' align='center'> <?php echo $page->fpage(0, 1, 2, 3, 4, 5, 6); ?></td>
            </tr>
        </table>
    </form>

    <div class="cent" style="width: 100px; height: 200px; display: none; background: red;"></div>

    <script>


    </script>


</div>


</body>
</html>
