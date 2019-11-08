<?php
// 引入函数库、类库文件
include "../inc/myfunction.inc";
include "../inc/mysql.class.php";

// 获取变量
$time = date("Y-m-d H:i:s",time());
$old_pw = @$_POST['old_pw'];
$new_pw = @$_POST['new_pw'];
$new_pw2 = @$_POST['new_pw2'];
$remark = trim_blank(@$_POST['remark']);
// 验证基础变量
if ($old_pw == '') {
	exit_msg("请输入原密码");
}elseif ($new_pw == '') {
	exit_msg("请输入新密码");
}elseif ($new_pw2 == '') {
	exit_msg("请输入重复密码");
}elseif ($new_pw2 != $new_pw) {
	exit_msg("密码与重复密码不相同");
}

// 实例化类库
$mysql = new mysql();

// 查询用户信息是否正确
$password = pw_md5($_SESSION['super']['name'],$old_pw);
if ($password != $_SESSION['super']['password']) {
	exit_msg("原密码错误");
}

// 修改管理员密码并记录日志
$data = [];
$data['password'] = pw_md5($_SESSION['super']['name'],$new_pw);
$data['remark'] = $remark;
$mysql -> update("super",$data,"id={$_SESSION['super']['id']}");

$info = [];
$info['user'] = $_SESSION['super']['name'];
$info['created_at'] = $time;
$info['ip'] = $_SERVER['REMOTE_ADDR'];
$info['action'] = "修改".$_SESSION['super']['name']."管理员密码:成功";
$info['sql_cont'] = str_replace('"', "'", $mysql -> getLastSql());
$mysql -> insert("super_log",$info);

$super = $_SESSION['super'];

$info = [];
$info['user'] = $super['name'];
$info['created_at'] = date("Y-m-d H:i:s",time());
$info['ip'] = $_SERVER['REMOTE_ADDR'];
$info['action'] = "注销成功";
$mysql -> insert("super_log",$info);

$_SESSION['super'] = null;

exit_msg("修改".$super['name']."管理员密码:成功","success",0);
?>