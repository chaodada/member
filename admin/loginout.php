<?php
/**
 * 退出登陆
 */


/**
 * 开启session
 */
session_start();

/**
 * 开启取出用户名
 */
$username = $_SESSION['admin']['username'];

/**
 * 清空session
 */
$_SESSION['admin'] = array();


//if (isset($_COOKIE[session_name()])) {
//    setcookie(session_name(), '', time() - 42000, '/');
//}
//
//session_destroy();

/**
 * 判断是否登陆 无session 跳转到登陆 并做退出标记
 */
if (empty($_SESSION['user']['isUserLogin'])) {
    header("Location:../admin.php?action=out");
}

