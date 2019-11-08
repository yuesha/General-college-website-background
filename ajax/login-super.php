<?php
// 引入函数库、类库文件
include "../inc/myfunction.inc";
include "../inc/mysql.class.php";

// 获取变量
$time = date("Y-m-d H:i:s",time());
$name = trim_blank(@$_POST['name']);
$password = @$_POST['password'];
$captcha = trim_blank(@$_POST['captcha']);

// 验证基础变量
if ($name == '') {
	exit_msg("请输入用户名");
}elseif ($password == '') {
	exit_msg("请输入密码");
}elseif ($captcha == '') {
	exit_msg("请输入验证码");
}elseif ($_SESSION['code'] != $captcha) {
	exit_msg("验证码错误");
}

// 实例化类库
$mysql = new mysql();

// 查询用户信息是否正确
$row = $mysql -> find("super","name='{$name}'");
if (!$row) {
	exit_msg("此用户不存在");
}elseif (!check_pw($name,$password,$row['password'])) {
	$info = [];
	$info['user'] = $name;
	$info['created_at'] = $time;
	$info['ip'] = $_SERVER['REMOTE_ADDR'];
	$info['action'] = "登录失败，密码错误";
	$mysql -> insert("super_log",$info);
	exit_msg("密码错误");
}

// 更新信息并记录日志
$data = [];
$data['times'] = ++$row['times'];
$data['last_time'] = $time;
$data['last_ip'] = $_SERVER['REMOTE_ADDR'];
$mysql -> update("super",$data,"id={$row['id']}");

$info = [];
$info['user'] = $name;
$info['created_at'] = $time;
$info['ip'] = $_SERVER['REMOTE_ADDR'];
$info['action'] = "登录成功";
$mysql -> insert("super_log",$info);

// 写入session
$_SESSION['super'] = $row;

exit_msg("登录成功,即将为您跳转","success",0);
?>