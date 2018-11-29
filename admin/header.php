<?php
/**
 * 公用头部
 */
?>

<style>
    * {
        font-size: 12px;
    }

    a {
        text-decoration: none;
    }

    .navleft {
        float: left;
        padding: 10px 0px 0px 10px;
    }

    .navright {
        padding: 10px 10px 0px 10px;
        float: right;
    }


</style>


<div class="navleft">
    <a href="ser.php">查询会员</a>
</div>

<div class="navright">
    <a href="#">当前人员:<span style="color: red;"><?php echo $_SESSION['admin']['username']; ?><span></a>
    <a href="loginout.php">退出登录</a>
</div>


