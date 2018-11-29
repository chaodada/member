<?php
/**
 * 用户模拟消费1积分功能实现
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
 * 定义时间
 */
$ymd = time();

/**
 * 模拟消费逻辑
 */
if (isset($_GET['id'])) {
    $sql = "select id,integral from u_users WHERE 1=1 and id={$_GET['id']} ";
    $res = $pdo->query($sql);
    list($id, $integral) = $res->fetch(PDO::FETCH_NUM);
    if ($integral >= 1) {
        //积分减少
        $integral -= 1;
        $stmt = $pdo->prepare('UPDATE u_users SET integral=? WHERE id=?');
        $stmt->execute(array($integral, $id));
        if ($stmt->rowCount() > 0) {
            //写入消费记录
            $stmt = $pdo->prepare('INSERT INTO u_xiaos ( uid,jf,ymd) VALUES (?,?,?)');
            $stmt->execute(array($_GET['id'], $integral, $ymd));
            echo "<script>alert('消费成功！积分-1');window.location.href = 'index.php';</script>";
        } else {
            echo "<script>alert('消费失败，请稍后重试');window.location.href = 'index.php';</script>";
        }
    } else {
        echo "<script>alert('积分不足，请赚取积分');window.location.href = 'index.php';</script>";
    }
}



